import threading
import time
import requests

def keep_alive():
    def ping():
        while True:
            try:
                requests.get("https://your-render-service-name.onrender.com/")
            except:
                pass
            time.sleep(60)
    threading.Thread(target=ping, daemon=True).start()
