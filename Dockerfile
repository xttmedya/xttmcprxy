FROM python:3.10-slim

WORKDIR /app

COPY requirements.txt .
COPY app.py .

# pip ve tüm paketleri tek seferde yükle
RUN pip install --upgrade pip && \
    pip install --no-cache-dir -r requirements.txt

EXPOSE 10000

CMD ["gunicorn", "app:app", \
     "-w", "4", \
     "--worker-class", "gevent", \
     "--worker-connections", "100", \
     "-b", "0.0.0.0:10000", \
     "--timeout", "120", \
     "--keep-alive", "5", \
     "--max-requests", "1000", \
     "--max-requests-jitter", "100"]
