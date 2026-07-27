#!/bin/bash
# Rebuild WordPress theme zip for upload (Appearance → Themes → Add New → Upload).
set -euo pipefail

ROOT="$(cd "$(dirname "$0")" && pwd)"
THEME_DIR="$ROOT/hausmeister-theme"
ZIP_FILE="$ROOT/hausmeister-theme.zip"

if [ ! -d "$THEME_DIR" ]; then
	echo "Error: hausmeister-theme folder not found." >&2
	exit 1
fi

rm -f "$ZIP_FILE"
zip -r "$ZIP_FILE" hausmeister-theme \
	-x "*.DS_Store" \
	-x "*/__MACOSX/*"

echo "Created: $ZIP_FILE"
ls -lh "$ZIP_FILE"
