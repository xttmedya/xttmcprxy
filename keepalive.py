import threading
import time
import requests

def keep_alive():
    def ping():
        while True:
            try:
                requests.get("https://xttmchead.onrender.com/")
            except:
                pass
            time.sleep(60)
    threading.Thread(target=ping, daemon=True).start()
