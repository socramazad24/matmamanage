# Guía de Solución de Problemas

## Error 404 al conectar con la API

Si ves errores como `Failed to load resource: the server responded with a status of 404 (Not Found)`, sigue estos pasos:

### 1. Verifica que XAMPP esté corriendo

Asegúrate de que Apache y MySQL estén activos en el panel de control de XAMPP.

### 2. Verifica la ubicación del proyecto

El proyecto debe estar en la carpeta `htdocs` de XAMPP:
\`\`\`
C:\xampp\htdocs\mat-manager\
\`\`\`

### 3. Verifica la URL de la API

Abre el archivo `frontend/.env` y confirma que la URL sea correcta:

\`\`\`env
VITE_API_BASE_URL=http://localhost/mat-manager/api
\`\`\`

Si tu proyecto está en una subcarpeta diferente, ajusta la URL:
\`\`\`env
VITE_API_BASE_URL=http://localhost/tu-carpeta/mat-manager/api
\`\`\`

### 4. Prueba la API directamente

Abre tu navegador y visita:
\`\`\`
http://localhost/mat-manager/api/auth/check.php
\`\`\`

Deberías ver una respuesta JSON como:
\`\`\`json
{"success":true,"authenticated":false}
\`\`\`

Si ves un error 404, verifica:
- Que la carpeta `api` existe en `mat-manager/`
- Que Apache está corriendo
- Que el archivo `api/auth/check.php` existe

### 5. Verifica los logs de la consola

Abre las herramientas de desarrollo del navegador (F12) y busca mensajes que empiecen con `[v0]`:

\`\`\`
[v0] API Base URL configured: http://localhost/mat-manager/api
[v0] Making API request to: http://localhost/mat-manager/api/auth/check.php
\`\`\`

Esto te ayudará a identificar qué URL está intentando usar la aplicación.

### 6. Problemas de CORS

Si ves errores de CORS, verifica que el archivo `api/config/cors.php` tenga la configuración correcta:

\`\`\`php
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Credentials: true");
\`\`\`

### 7. Reinicia el servidor de desarrollo

Después de cambiar el archivo `.env`, reinicia Vite:

\`\`\`bash
# Detén el servidor (Ctrl+C)
# Vuelve a iniciarlo
npm run dev
\`\`\`

## Error "La respuesta del servidor no es JSON"

Esto significa que PHP está devolviendo HTML en lugar de JSON. Posibles causas:

1. **Error de PHP**: Revisa los logs de Apache en `xampp/apache/logs/error.log`
2. **Ruta incorrecta**: El archivo PHP no existe en la ubicación especificada
3. **PHP no está procesando el archivo**: Verifica que Apache tenga PHP habilitado

## Base de datos no conecta

1. Verifica que MySQL esté corriendo en XAMPP
2. Importa el archivo SQL de la base de datos (si existe)
3. Verifica las credenciales en `config.php`:
   \`\`\`php
   define('DB_HOST', '127.0.0.1');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   define('DB_NAME', 'mat-manager');
   \`\`\`

## Contacto

Si los problemas persisten, revisa:
- Los logs de Apache: `xampp/apache/logs/error.log`
- Los logs de PHP: `xampp/php/logs/php_error_log`
- La consola del navegador (F12)
