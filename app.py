from fastapi import FastAPI, Request
from fastapi.responses import StreamingResponse, PlainTextResponse, Response
from urllib.parse import urlparse, urljoin, quote, unquote
import httpx
import re
import keepalive  # bu dosya ile arka planda uygulamayı sıcak tut

app = FastAPI()
keepalive.keep_alive()  # Bu satır uygulamayı sıcak tutar

def detect_m3u_type(content: str):
    if "#EXTM3U" in content and "#EXTINF" in content:
        return "m3u8"
    return "m3u"

def extract_headers_from_query(request: Request):
    return {
        unquote(k[2:]).replace("_", "-"): unquote(v)
        for k, v in request.query_params.items()
        if k.lower().startswith("h_")
    }

def replace_key_uri(line: str, headers_query: str):
    match = re.search(r'URI="([^"]+)"', line)
    if match:
        key_url = match.group(1)
        proxied = f"/proxy/key?url={quote(key_url)}&{headers_query}"
        return line.replace(key_url, proxied)
    return line

@app.get("/proxy/m3u")
async def proxy_m3u(request: Request, url: str):
    headers = extract_headers_from_query(request)
    headers = {k: v for k, v in headers.items() if v}

    try:
        async with httpx.AsyncClient(timeout=20.0, verify=False) as client:
            r = await client.get(url, headers=headers, follow_redirects=True)
            r.raise_for_status()
            content = r.text
            file_type = detect_m3u_type(content)

            segment_lines = [l for l in content.splitlines() if l.strip() and not l.startswith("#")]
            # Eğer segmentler özel formatta ise direkt döndür
            if file_type == "m3u8" and all(".tsmmt" in l for l in segment_lines):
                return PlainTextResponse(content, media_type="application/x-mpegURL")

            parsed = urlparse(str(r.url))
            base_url = f"{parsed.scheme}://{parsed.netloc}{parsed.path.rsplit('/', 1)[0]}/"

            headers_query = "&".join([f"h_{quote(k)}={quote(v)}" for k, v in headers.items()])
            modified = []

            for line in content.splitlines():
                line = line.strip()
                if line.startswith("#EXT-X-KEY") and 'URI="' in line:
                    line = replace_key_uri(line, headers_query)
                elif line and not line.startswith("#"):
                    full_url = urljoin(base_url, line)
                    line = f"/proxy/ts?url={quote(full_url)}&{headers_query}"
                modified.append(line)

            return PlainTextResponse(
                "\n".join(modified),
                media_type="application/x-mpegURL",
                headers={"Content-Disposition": 'inline; filename="index.m3u8"'}
            )

    except httpx.RequestError as e:
        return PlainTextResponse(f"İndirme hatası: {str(e)}", status_code=500)

@app.get("/proxy/ts")
async def proxy_ts(request: Request, url: str):
    headers = extract_headers_from_query(request)

    try:
        async with httpx.AsyncClient(timeout=30.0, verify=False) as client:
            r = await client.get(url, headers=headers, follow_redirects=True)
            r.raise_for_status()
            return StreamingResponse(r.aiter_bytes(), media_type="video/mp2t")
    except httpx.RequestError as e:
        return PlainTextResponse(f"Segment hatası: {str(e)}", status_code=500)

@app.get("/proxy/key")
async def proxy_key(request: Request, url: str):
    headers = extract_headers_from_query(request)

    try:
        async with httpx.AsyncClient(timeout=10.0, verify=False) as client:
            r = await client.get(url, headers=headers, follow_redirects=True)
            r.raise_for_status()
            return Response(content=r.content, media_type="application/octet-stream")
    except httpx.RequestError as e:
        return PlainTextResponse(f"Key hatası: {str(e)}", status_code=500)

@app.get("/")
def index():
    return {"status": "Proxy aktif!"}

