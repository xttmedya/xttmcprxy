from fastapi import FastAPI, Request, Response
from fastapi.responses import StreamingResponse
import requests
from urllib.parse import urlparse, urljoin, quote, unquote
import re
import keepalive  # bu dosya ile arka planda uygulamayı sıcak tut

app = FastAPI()
keepalive.keep_alive()  # Bu satır uygulamayı sıcak tutar

def detect_m3u_type(content):
    if "#EXTM3U" in content and "#EXTINF" in content:
        return "m3u8"
    return "m3u"

def replace_key_uri(line, headers_query):
    match = re.search(r'URI="([^"]+)"', line)
    if match:
        key_url = match.group(1)
        proxied_key_url = f"/proxy/key?url={quote(key_url)}&{headers_query}"
        return line.replace(key_url, proxied_key_url)
    return line

def extract_headers_from_request(request: Request):
    return {
        unquote(k[2:]).replace("_", "-"): unquote(v).strip()
        for k, v in request.query_params.items()
        if k.lower().startswith("h_")
    }

@app.get("/proxy/m3u")
async def proxy_m3u(request: Request):
    m3u_url = request.query_params.get('url', '').strip()
    if not m3u_url:
        return Response(content="Hata: 'url' parametresi eksik", status_code=400)

    headers = extract_headers_from_request(request)

    try:
        response = requests.get(m3u_url, headers=headers, timeout=(10, 20), verify=False)
        response.raise_for_status()
        m3u_content = response.text
        file_type = detect_m3u_type(m3u_content)

        segment_lines = [l for l in m3u_content.splitlines() if l.strip() and not l.startswith("#")]
        if file_type == "m3u8" and all(".tsmmt" in l for l in segment_lines):
            return Response(content=m3u_content, media_type="application/x-mpegURL")

        parsed_url = urlparse(response.url)
        base_url = f"{parsed_url.scheme}://{parsed_url.netloc}{parsed_url.path.rsplit('/', 1)[0]}/"

        headers_query = "&".join([f"h_{quote(k)}={quote(v)}" for k, v in headers.items()])
        modified_m3u8 = []

        for line in m3u_content.splitlines():
            line = line.strip()
            if line.startswith("#EXT-X-KEY") and 'URI="' in line:
                line = replace_key_uri(line, headers_query)
            elif line and not line.startswith("#"):
                full_url = urljoin(base_url, line)
                line = unquote(f"https://xttmctv-bsgoal.hf.space/proxy/ts?url={quote(full_url)}&{headers_query}")
                # line = line.replace('%3A',':')
            modified_m3u8.append(line)

        return Response(content="\n".join(modified_m3u8), media_type="application/x-mpegURL")

    except requests.RequestException as e:
        return Response(content=f"Indirme hatası: {str(e)}", status_code=500)

@app.get("/")
async def index():
    return Response(content="Proxy aktif!", media_type="text/plain")
