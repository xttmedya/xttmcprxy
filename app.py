from fastapi import FastAPI, Request, HTTPException, Response
from fastapi.responses import StreamingResponse, PlainTextResponse
import requests
import urllib3
from urllib.parse import urljoin

urllib3.disable_warnings(urllib3.exceptions.InsecureRequestWarning)

app = FastAPI()

HEADERS_DEFAULT = {
    "User-Agent": "Mozilla/5.0 (Windows NT 6.1; Win64; x64)",
    "Accept": "*/*",
    "Accept-Language": "en_US",
    "Range": "bytes=0-",
}

def merge_headers(custom_headers):
    headers = HEADERS_DEFAULT.copy()
    headers.update(custom_headers)
    return headers

@app.get("/proxy/m3u")
def proxy_m3u8(request: Request, url: str | None = None):
    if not url:
        raise HTTPException(status_code=400, detail="url parametresi gerekli")

    headers = merge_headers({
        "User-Agent": request.headers.get("User-Agent", HEADERS_DEFAULT["User-Agent"]),
        "Range": request.headers.get("Range", HEADERS_DEFAULT["Range"]),
    })

    try:
        resp = requests.get(url, headers=headers, allow_redirects=False, verify=False, timeout=10)
    except Exception as e:
        raise HTTPException(status_code=502, detail=f"İlk istek hatası: {e}")

    if resp.status_code == 302:
        real_url = resp.headers.get("Location")
        if not real_url:
            raise HTTPException(status_code=502, detail="Redirect ancak Location başlığı yok")
    elif resp.status_code == 200:
        real_url = url
    else:
        raise HTTPException(status_code=502, detail=f"Beklenmeyen HTTP kodu: {resp.status_code}")

    try:
        real_resp = requests.get(real_url, headers=headers, verify=False, timeout=10)
        if real_resp.status_code != 200:
            raise HTTPException(status_code=502, detail=f"Gerçek m3u8 indirilemedi: {real_resp.status_code}")
    except Exception as e:
        raise HTTPException(status_code=502, detail=f"m3u8 istek hatası: {e}")

    content = real_resp.text

    if "#EXTM3U" not in content:
        raise HTTPException(status_code=400, detail="Geçerli m3u8 değil")

    base_url = real_url.rsplit("/", 1)[0] + "/"

    lines = content.splitlines()
    new_lines = []
    for line in lines:
        line = line.strip()
        if line == "" or line.startswith("#"):
            new_lines.append(line)
        elif line.endswith(".ts"):
            full_url = urljoin(base_url, line)
            proxied_url = f"/proxy/ts?url={full_url}"
            new_lines.append(proxied_url)
        else:
            new_lines.append(line)

    return Response(content="\n".join(new_lines), media_type="application/x-mpegURL")


@app.get("/proxy/ts")
def proxy_ts(request: Request, url: str | None = None):
    if not url:
        raise HTTPException(status_code=400, detail="url parametresi gerekli")

    headers = merge_headers({
        "User-Agent": request.headers.get("User-Agent", HEADERS_DEFAULT["User-Agent"]),
        "Range": request.headers.get("Range", HEADERS_DEFAULT["Range"]),
        "Referer": request.headers.get("Referer", ""),
    })

    try:
        r = requests.get(url, headers=headers, stream=True, timeout=30, verify=False)
        if r.status_code != 200:
            raise HTTPException(status_code=502, detail=f"Segment indirilemedi: HTTP {r.status_code}")

        def generate():
            for chunk in r.iter_content(chunk_size=8192):
                if chunk:
                    yield chunk

        content_type = r.headers.get("Content-Type", "video/MP2T")
        return StreamingResponse(generate(), media_type=content_type)

    except Exception as e:
        raise HTTPException(status_code=502, detail=f"Segment proxy hatası: {e}")


if __name__ == "__main__":
    import uvicorn
    uvicorn.run(app, host="0.0.0.0", port=6000)
