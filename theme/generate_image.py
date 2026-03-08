#!/usr/bin/env python3
"""Generate images via Gemini API (Nano Banana Pro) for Instagarda"""
import json, sys, base64, urllib.request, os

API_KEY = "AIzaSyBxqYN7gX-aYTv5u2Pl_xfc6sRv-C7wDW8"
MODEL = "nano-banana-pro-preview"
ENDPOINT = f"https://generativelanguage.googleapis.com/v1beta/models/{MODEL}:generateContent?key={API_KEY}"

def generate(prompt, output_path):
    payload = json.dumps({
        "contents": [{"parts": [{"text": prompt}]}],
        "generationConfig": {"responseModalities": ["TEXT", "IMAGE"]}
    }).encode()

    req = urllib.request.Request(ENDPOINT, data=payload, headers={"Content-Type": "application/json"})

    try:
        with urllib.request.urlopen(req, timeout=120) as resp:
            data = json.loads(resp.read())
    except Exception as e:
        print(f"FAIL: {output_path} -> {e}")
        return False

    if "candidates" not in data:
        print(f"FAIL: {output_path} -> {json.dumps(data.get('error', data))[:200]}")
        return False

    for part in data["candidates"][0]["content"]["parts"]:
        if "inlineData" in part:
            img = base64.b64decode(part["inlineData"]["data"])
            os.makedirs(os.path.dirname(output_path), exist_ok=True)
            with open(output_path, "wb") as f:
                f.write(img)
            size_kb = len(img) // 1024
            print(f"OK: {output_path} ({size_kb}KB)")
            return True

    print(f"FAIL: {output_path} -> no image in response")
    return False

if __name__ == "__main__":
    if len(sys.argv) < 3:
        print("Usage: python3 generate_image.py <output_path> <prompt>")
        sys.exit(1)
    generate(sys.argv[2], sys.argv[1])
