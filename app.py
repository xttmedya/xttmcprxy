from flask import Flask, request, Response
import requests
from urllib.parse import urlparse, urljoin, quote, unquote
import re
import keepalive  # bu dosya ile arka planda uygulamayı sıcak tut

app = Flask(__name__)
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

def extract_headers_from_request():
    # Dışarıdan gelen h_ ile başlayan parametreleri alır
    return {
        unquote(k[2:]).replace("_", "-"): unquote(v).strip()
        for k, v in request.args.items()
        if k.lower().startswith("h_")
    }

@app.route('/proxy/m3u')
def proxy_m3u():
    m3u_url = request.args.get('url', '').strip()
    if not m3u_url:
        return "Hata: 'url' parametresi eksik", 400

    headers = extract_headers_from_request()

    try:
        # response = requests.get(m3u_url, headers=headers, timeout=(10, 20))
        response = requests.get(m3u_url, headers=headers, timeout=(10, 20), verify=False)
        response.raise_for_status()
        m3u_content = response.text
        file_type = detect_m3u_type(m3u_content)

        segment_lines = [l for l in m3u_content.splitlines() if l.strip() and not l.startswith("#")]
        # if file_type == "m3u8" and all(".ts" in l for l in segment_lines):
        if file_type == "m3u8" and all(".tsmmt" in l for l in segment_lines):
            return Response(m3u_content, content_type="application/x-mpegURL")

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
                line = f"/proxy/ts?url={quote(full_url)}&{headers_query}"
                # line = f"https://xttmc-boss.hf.space/proxy/ts?url={quote(full_url)}&{headers_query}"
            modified_m3u8.append(line)

        return Response("\n".join(modified_m3u8), content_type="application/x-mpegURL")

    except requests.RequestException as e:
        return f"Indirme hatası: {str(e)}", 500

@app.route('/proxy/ts')
def proxy_ts():
    ts_url = request.args.get('url', '').strip()
    if not ts_url:
        return "Hata: 'url' parametresi eksik", 400

    headers = extract_headers_from_request()

    try:
        response = requests.get(ts_url, headers=headers, stream=True, timeout=(10, 30))
        response.raise_for_status()

        def generate():
            for chunk in response.iter_content(chunk_size=8192):
                if chunk:
                    yield chunk

        return Response(generate(), content_type="video/mp2t")

    except requests.RequestException as e:
        return f"Segment hatası: {str(e)}", 500

@app.route('/proxy/key')
def proxy_key():
    key_url = request.args.get('url', '').strip()
    if not key_url:
        return "Hata: 'url' parametresi eksik", 400

    headers = extract_headers_from_request()

    try:
        response = requests.get(key_url, headers=headers, timeout=(5, 15))
        response.raise_for_status()
        return Response(response.content, content_type="application/octet-stream")
    except requests.RequestException as e:
        return f"Key hatası: {str(e)}", 500

@app.route('/')
def index():
    return "Proxy aktif!"

if __name__ == '__main__':
    app.run(host="0.0.0.0", port=10000)
