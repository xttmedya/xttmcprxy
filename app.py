from fastapi import FastAPI, Request, Response
from fastapi.responses import StreamingResponse, PlainTextResponse
from urllib.parse import urlparse, urljoin, quote, unquote
import httpx
import re
import asyncio

app = FastAPI()

def detect_m3u_type(content: str):
    if "#EXTM3U" in content and "#EXTINF" in content:
        return "m3u8"
    return "m3u"

def replace_key_uri(line: str, headers_query: str):
    match = re.search(r'URI="([^"]+)"', line)
    if match:
        key_url = match.group(1)
        proxied_key_url = f"/proxy/key?url={quote(key_url)}&{headers_query}"
        return line.replace(key_url, proxied_key_url)
    return line

def extract_headers(request: Request):
    # h_User_Agent=... gibi parametrelerden header üretir
    return {
        unquote(k[2:]).replace("_", "-"): unquote(v)
        for k, v in request.query_params.items()
        if k.lower().startswith("h_")
    }

@app.get("/proxy/m3u")
async def proxy_m3u(request: Request):
    m3u_url = request.query_params.get("url", "").strip()
    if not m3u_url:
        return PlainTextResponse("Hata: 'url' parametresi eksik", status_code=400)

    headers = extract_headers(request)

    try:
        async with httpx.AsyncClient(verify=False, timeout=httpx.Timeout(20.0, connect=10.0)) as client:
            r = await client.get(m3u_url, headers=headers)
            r.raise_for_status()
            m3u_content = r.text

        file_type = detect_m3u_type(m3u_content)

        segment_lines = [l for l in m3u_content.splitlines() if l.strip() and not l.startswith("#")]
        if file_type == "m3u8" and all(".tsmmt" in l for l in segment_lines):
            return Response(m3u_content, media_type="application/x-mpegURL")

        parsed_url = urlparse(str(r.url))
        base_url = f"{parsed_url.scheme}://{parsed_url.netloc}{parsed_url.path.rsplit('/', 1)[0]}/"
        headers_query = "&".join([f"h_{quote(k)}={quote(v)}" for k, v in headers.items()])

        modified_m3u8 = []
        for line in m3u_content.splitlines():
            line = line.strip()
            if line.startswith("#EXT-X-KEY") and 'URI="' in line:
                line = replace_key_uri(line, headers_query)
            elif line and not line.startswith("#"):
                full_url = urljoin(base_url, line)
                line = f"/proxy/ts?url={quote(full_url)}&{headers_query}"
            modified_m3u8.append(line)

        return Response("\n".join(modified_m3u8), media_type="application/x-mpegURL")

    except httpx.RequestError as e:
        return PlainTextResponse(f"İndirme hatası: {str(e)}", status_code=500)

@app.get("/proxy/ts")
async def proxy_ts(request: Request):
    ts_url = request.query_params.get("url", "").strip()
    if not ts_url:
        return PlainTextResponse("Hata: 'url' parametresi eksik", status_code=400)

    headers = extract_headers(request)

    try:
        async with httpx.AsyncClient(timeout=httpx.Timeout(30.0, connect=10.0)) as client:
            r = await client.get(ts_url, headers=headers, stream=True)
            r.raise_for_status()

            async def stream_generator():
                async for chunk in r.aiter_bytes():
                    yield chunk

            return StreamingResponse(stream_generator(), media_type="video/mp2t")

    except httpx.RequestError as e:
        return PlainTextResponse(f"Segment hatası: {str(e)}", status_code=500)

@app.get("/proxy/key")
async def proxy_key(request: Request):
    key_url = request.query_params.get("url", "").strip()
    if not key_url:
        return PlainTextResponse("Hata: 'url' parametresi eksik", status_code=400)

    headers = extract_headers(request)

    try:
        async with httpx.AsyncClient(timeout=httpx.Timeout(15.0, connect=5.0)) as client:
            r = await client.get(key_url, headers=headers)
            r.raise_for_status()
            return Response(r.content, media_type="application/octet-stream")

    except httpx.RequestError as e:
        return PlainTextResponse(f"Key hatası: {str(e)}", status_code=500)

@app.get("/")
def index():
    return {"status": "Proxy aktif - FastAPI sürüm çalışıyor!"}
