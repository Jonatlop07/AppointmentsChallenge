import requests
import json
import pickle
import os

API_URL = os.environ.get("API_URL", "http://localhost:8000/api")
CACHE_FILE = "etl_cache.pkl"


def fetch_appointments():
    ENDPOINT_URL = f"{API_URL}/appointments"
    response = requests.get(ENDPOINT_URL)
    if response.status_code == 200:
        return response.json()
    else:
        print(f"Error fetching data: {response.status_code}")
        return []


def cache_data(data):
    with open(CACHE_FILE, 'wb') as cache_file:
        pickle.dump(data, cache_file)


def load_cache():
    if os.path.exists(CACHE_FILE):
        with open(CACHE_FILE, 'rb') as cache_file:
            return pickle.load(cache_file)
    return None


def get_top_appointments():
    cached_data = load_cache()
    if cached_data:
        return cached_data
    appointments = fetch_appointments()
    sorted_appointments = sorted(appointments, key=lambda x: (-x['score'], x['created_at']), reverse=True)
    top_appointments = sorted_appointments[:5]
    cache_data(top_appointments)
    return top_appointments


if __name__ == "__main__":
    top_appointments = get_top_appointments()
    print(json.dumps(top_appointments, indent=2))