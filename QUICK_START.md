# Guía Rápida de Instalación - MAT-MANAGER

## Paso 1: Configurar XAMPP

1. **Instala XAMPP** si no lo tienes: https://www.apachefriends.org/

2. **Copia el proyecto** a la carpeta de XAMPP:
   \`\`\`
   C:\xampp\htdocs\mat-manager\
   \`\`\`

3. **Inicia Apache y MySQL** desde el panel de control de XAMPP

4. **Verifica que Apache esté corriendo** abriendo:
   \`\`\`
   http://localhost/
   \`\`\`

## Paso 2: Configurar la Base de Datos

1. **Abre phpMyAdmin**: http://localhost/phpmyadmin

2. **Crea la base de datos**:
   - Nombre: `mat-manager`
   - Cotejamiento: `utf8mb4_general_ci`

3. **Importa el esquema** (si tienes un archivo SQL) o crea las tablas manualmente

4. **Verifica la configuración** en `config.php`:
   \`\`\`php
   define('DB_HOST', '127.0.0.1');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   define('DB_NAME', 'mat-manager');
   \`\`\`

## Paso 3: Verificar el Backend PHP

1. **Prueba el endpoint de autenticación**:
   \`\`\`
   http://localhost/mat-manager/api/auth/check.php
   \`\`\`
   
   Deberías ver una respuesta JSON como:
   \`\`\`json
   {"success":false,"authenticated":false,"message":"No autenticado"}
   \`\`\`

2. **Si ves un error 404**:
   - Verifica que el proyecto esté en `C:\xampp\htdocs\mat-manager\`
   - Verifica que Apache esté corriendo
   - Revisa los logs de Apache en `C:\xampp\apache\logs\error.log`

3. **Si ves un error de PHP**:
   - Verifica que PHP esté habilitado en Apache
   - Revisa `php.ini` y asegúrate que `display_errors = On` para desarrollo

## Paso 4: Configurar el Frontend React

1. **Navega a la carpeta frontend**:
   \`\`\`bash
   cd C:\xampp\htdocs\mat-manager\frontend
   \`\`\`

2. **Instala las dependencias**:
   \`\`\`bash
   npm install
   \`\`\`

3. **Verifica el archivo .env**:
   \`\`\`env
   VITE_API_BASE_URL=http://localhost/mat-manager/api
   \`\`\`

4. **Inicia el servidor de desarrollo**:
   \`\`\`bash
   npm run dev
   \`\`\`

5. **Abre el navegador**:
   \`\`\`
   http://localhost:3000
   \`\`\`

## Paso 5: Probar el Login

1. **Crea un usuario de prueba** en la base de datos:
   \`\`\`sql
   INSERT INTO users (username, password, role) 
   VALUES ('admin', 'admin123', 'admin');
   \`\`\`

2. **Intenta hacer login** con:
   - Usuario: `admin`
   - Contraseña: `admin123`

## Solución de Problemas Comunes

### Error: "Failed to load resource: 404"

**Causa**: El backend PHP no está accesible

**Solución**:
1. Verifica que Apache esté corriendo en XAMPP
2. Confirma que el proyecto esté en `C:\xampp\htdocs\mat-manager\`
3. Prueba acceder directamente a: `http://localhost/mat-manager/api/auth/check.php`
4. Si no funciona, revisa la configuración de Apache en `httpd.conf`

### Error: "CORS policy"

**Causa**: El backend no está permitiendo peticiones desde el frontend

**Solución**:
1. Verifica que `api/config/cors.php` tenga:
   \`\`\`php
   header("Access-Control-Allow-Origin: http://localhost:3000");
   header("Access-Control-Allow-Credentials: true");
   \`\`\`
2. Asegúrate que todos los archivos PHP incluyan `require_once __DIR__ . '/../config/cors.php';`

### Error: "Connection refused"

**Causa**: Apache no está corriendo o está en un puerto diferente

**Solución**:
1. Abre el panel de control de XAMPP
2. Verifica que Apache esté en verde (corriendo)
3. Si Apache no inicia, revisa que el puerto 80 no esté ocupado
4. Puedes cambiar el puerto de Apache en `httpd.conf` si es necesario

### Error: "Database connection failed"

**Causa**: La base de datos no está configurada correctamente

**Solución**:
1. Verifica que MySQL esté corriendo en XAMPP
2. Confirma que la base de datos `mat-manager` exista en phpMyAdmin
3. Revisa las credenciales en `config.php`
4. Prueba la conexión con:
   \`\`\`php
   $conex = new mysqli('127.0.0.1', 'root', '', 'mat-manager');
   if ($conex->connect_error) {
       die("Error: " . $conex->connect_error);
   }
   echo "Conexión exitosa";
   \`\`\`

### El frontend se conecta pero no hay datos

**Causa**: La base de datos está vacía

**Solución**:
1. Importa el esquema de la base de datos
2. Crea usuarios de prueba
3. Agrega datos de ejemplo para materiales, proveedores, etc.

## Estructura de Carpetas Esperada

\`\`\`
C:\xampp\htdocs\mat-manager\
├── api/                    # Backend PHP API
│   ├── auth/              # Endpoints de autenticación
│   ├── materials/         # Endpoints de materiales
│   ├── users/             # Endpoints de usuarios
│   ├── providers/         # Endpoints de proveedores
│   └── config/            # Configuración de CORS y DB
├── backend/               # Lógica de negocio PHP
├── frontend/              # Aplicación React
│   ├── src/              # Código fuente React
│   ├── public/           # Archivos estáticos
│   ├── .env              # Variables de entorno
│   └── package.json      # Dependencias npm
├── config.php            # Configuración de base de datos
└── README.md             # Documentación
\`\`\`

## Checklist de Verificación

- [ ] XAMPP instalado y corriendo
- [ ] Apache en verde (puerto 80)
- [ ] MySQL en verde (puerto 3306)
- [ ] Proyecto en `C:\xampp\htdocs\mat-manager\`
- [ ] Base de datos `mat-manager` creada
- [ ] `http://localhost/mat-manager/api/auth/check.php` responde JSON
- [ ] Node.js instalado (v16 o superior)
- [ ] Dependencias instaladas (`npm install` en frontend)
- [ ] Archivo `.env` configurado correctamente
- [ ] Servidor de desarrollo corriendo (`npm run dev`)
- [ ] Usuario de prueba creado en la base de datos

## Contacto y Soporte

Si después de seguir todos estos pasos sigues teniendo problemas:

1. Revisa los logs de Apache: `C:\xampp\apache\logs\error.log`
2. Revisa los logs de PHP: `C:\xampp\php\logs\php_error_log`
3. Abre la consola del navegador (F12) y busca errores específicos
4. Verifica que todas las rutas y URLs sean correctas

¡Buena suerte! 🚀
