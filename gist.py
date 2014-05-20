import tempfile
from subprocess import call
import os.path
import json
import requests
from requests.auth import HTTPBasicAuth

# Get the user's default editor
EDITOR = os.environ.get("EDITOR", "vim")

# Nabbed from here: https://github.com/settings/applications#personal-access-tokens
GITHUB_PAC = "" 

with tempfile.NamedTemporaryFile(suffix=".tmp") as temp:
    # Fire up vim
    call([EDITOR, temp.name])

    # Get the tempfile contents + filename
    f = open(temp.name, 'r')
    c = f.read()
    filename = os.path.split(temp.name)[1]

    # Build request dict and JSONify it
    files = { filename: { "content" : c } }
    content = { "description": "", "public": False, "files": files }
    content = json.dumps(content)

    # Make the request and store response
    if len(GITHUB_PAC) > 0:
        g = requests.post("https://api.github.com/gists", auth=HTTPBasicAuth(GITHUB_PAC, "x-oauth-basic"), data=content)
    else:
        g = requests.post("https://api.github.com/gists", data=content)
    r = g.json()

	# Handle errors plox
    if 'message' in r.keys():
        print "Error: " + r["message"]
    else:
        print r["html_url"]
