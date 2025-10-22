# Guía de Configuración - MAT-MANAGER

## Problema: Error 404 al conectar con la API

Si ves errores como:
\`\`\`
GET http://localhost:3000/api/auth/check.php 404 (Not Found)
POST http://localhost:3000/api/auth/login.php 404 (Not Found)
\`\`\`

Esto significa que el proxy de Vite no está encontrando tu API de PHP.

## Solución Paso a Paso

### 1. Verifica que XAMPP esté corriendo
- Abre el Panel de Control de XAMPP
- Asegúrate de que **Apache** y **MySQL** estén iniciados (botones verdes)

### 2. Verifica la ubicación del proyecto
Tu proyecto debe estar en la carpeta `htdocs` de XAMPP:
\`\`\`
C:\xampp\htdocs\mat-manager\
\`\`\`

### 3. Verifica que la API funcione directamente
Abre tu navegador y prueba:
\`\`\`
http://localhost/mat-manager/api/auth/check.php
\`\`\`

Deberías ver una respuesta JSON (aunque sea un error de autenticación).

Si ves un error 404, significa que:
- El proyecto no está en la carpeta correcta
- Apache no está corriendo
- La ruta en el navegador es incorrecta

### 4. Configura el archivo vite.config.js

El archivo `vite.config.js` debe tener el proxy configurado correctamente:

\`\`\`javascript
export default defineConfig({
  plugins: [react()],
  server: {
    port: 3000,
    proxy: {
      "/api": {
        target: "http://localhost/mat-manager",
        changeOrigin: true,
        rewrite: (path) => path,
      },
    },
  },
})
\`\`\`

**Importante**: Si tu proyecto está en una carpeta diferente, ajusta el `target`:
- Si está en `C:\xampp\htdocs\mi-proyecto\`, usa: `target: "http://localhost/mi-proyecto"`
- Si usas un puerto diferente, usa: `target: "http://localhost:8080/mat-manager"`

### 5. Reinicia el servidor de Vite

Después de cambiar la configuración:

\`\`\`bash
# Detén el servidor (Ctrl + C)
# Luego inicia de nuevo:
npm run dev
\`\`\`

### 6. Verifica los logs en la consola

Abre las DevTools del navegador (F12) y busca estos mensajes:

\`\`\`
[v0] API Base URL configured: /api
[v0] Making API request to: /api/auth/check.php
\`\`\`

Si ves la URL correcta pero sigue dando 404, el problema está en el proxy de Vite.

## Configuraciones Alternativas

### Opción A: Usar la URL completa (sin proxy)

Si el proxy no funciona, puedes usar la URL completa directamente:

**frontend/.env**
\`\`\`env
VITE_API_BASE_URL=http://localhost/mat-manager/api
\`\`\`

**frontend/vite.config.js**
\`\`\`javascript
export default defineConfig({
  plugins: [react()],
  server: {
    port: 3000,
    // Sin proxy
  },
})
\`\`\`

**Nota**: Necesitarás configurar CORS en tu API PHP.

### Opción B: Usar un Virtual Host

Crea un virtual host en Apache para una URL más limpia:

**C:\xampp\apache\conf\extra\httpd-vhosts.conf**
```apache
<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs/mat-manager"
    ServerName mat-manager.local
</VirtualHost>
