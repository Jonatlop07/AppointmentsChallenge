import requests
import json
import pickle
import os
import argparse

API_URL = os.environ.get("API_URL", "http://localhost:8000/api")
CACHE_FILE = "appointments_cache.pkl"

'''
Makes an HTTP GET request to /appointments endpoint
and handles errors in the request
'''
def fetch_appointments():
    ENDPOINT_URL = f"{API_URL}/appointments"
    response = requests.get(ENDPOINT_URL)
    if response.status_code == 200:
        return response.json()
    else:
        print(f"Error fetching data: {response.status_code}")
        return []


'''
Saves appointments in the specified cache file
'''
def cache_appointments(appointments):
    with open(CACHE_FILE, 'wb') as cache_file:
        pickle.dump(appointments, cache_file)


'''
Reads the appointments from the cache file
'''
def load_cached_appointments():
    if os.path.exists(CACHE_FILE):
        with open(CACHE_FILE, 'rb') as cache_file:
            return pickle.load(cache_file)
    return None


def get_appointments_from_cache():
    cached_appointments = load_cached_appointments()
    if cached_appointments:
        return cached_appointments
    return fetch_appointments()


'''
Tries to get the lists of appointments from cache if they exist there and cache is enabled,
else fetches it from the API. Then, computes the top 5 appointments sorted
by score and creation date and caches them if required
'''
def get_top_appointments(use_cache=False, cache_data=False):
    appointments = None
    cached_appointments = None
    if use_cache:
        appointments = get_appointments_from_cache()
    else:
        appointments = fetch_appointments()
    sorted_appointments = sorted(appointments, key=lambda x: (-x['score'], x['created_at']))
    top_appointments = sorted_appointments[:5]
    if cache_data:
        cache_appointments(appointments)
    return top_appointments


if __name__ == "__main__":
    # Parse the command-line arguments
    parser = argparse.ArgumentParser(description="ELT Script for appointments")
    parser.add_argument('--cache-data', action='store_true', help='Whether to cache the data after fetching it')
    parser.add_argument('--use-cache', action='store_true', help='Whether to use cached data if available')

    args = parser.parse_args()

    # Fetch the top appointments, optionally using cache
    top_appointments = get_top_appointments(use_cache=args.use_cache, cache_data=args.cache_data)

    print(json.dumps(top_appointments, indent=2))
