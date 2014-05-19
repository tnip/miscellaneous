import tempfile
from subprocess import call
import os.path
import json
import requests

# Get the user's default editor
EDITOR = os.environ.get("EDITOR", "vim")

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
    g = requests.post("https://api.github.com/gists", data=content)
    r = g.json()

    print r["html_url"]
