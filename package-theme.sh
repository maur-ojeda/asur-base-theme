#!/bin/bash

THEME_NAME="asur-base-theme"
ZIP_FILE="${THEME_NAME}.zip"

echo ""
echo "📦 Empaquetando tema ${THEME_NAME}..."

# Asegúrate de estar en el directorio del theme
cd "$(dirname "$0")"

# Eliminar zip anterior si existe
rm -f "${ZIP_FILE}"

# Crear el zip excluyendo archivos de desarrollo
zip -r "${ZIP_FILE}" . \
  -x "*.DS_Store" \
  -x "node_modules/*" \
  -x "node_modules/**" \
  -x ".git/*" \
  -x ".git/**" \
  -x ".gitignore" \
  -x "package-lock.json" \
  -x "package.json" \
  -x "webpack.config.js" \
  -x "vite.config.js" \
  -x ".vscode/*" \
  -x ".vscode/**" \
  -x "src/*" \
  -x "src/**" \
  -x "*.sh" \
  -x "*.log" \
  -x "*.zip"

echo "✅ Tema empaquetado correctamente en ${ZIP_FILE}"
