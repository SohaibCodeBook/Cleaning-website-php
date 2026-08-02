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
# Staging photo folders are source material only; the theme renders from
# assets/images/ba/ and assets/images/after images gallery/.
zip -r "$ZIP_FILE" hausmeister-theme \
	-x "*.DS_Store" \
	-x "*/.DS_Store" \
	-x "*/__MACOSX/*" \
	-x "hausmeister-theme/assets/images/before and after/*" \
	-x "hausmeister-theme/assets/images/before and after images 2/*" \
	-x "hausmeister-theme/assets/images/before and after optimized/*" \
	-x "hausmeister-theme/assets/images/before and after images 2 optimized/*"

echo "Created: $ZIP_FILE"
ls -lh "$ZIP_FILE"
