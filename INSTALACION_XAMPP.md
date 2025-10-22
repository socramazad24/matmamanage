# Instalación en XAMPP

## Requisitos
- XAMPP instalado (Apache + MySQL + PHP 7.4 o superior)
- Navegador web moderno

## Pasos de Instalación

### 1. Copiar archivos
Copia toda la carpeta del proyecto a `C:\xampp\htdocs\mat-manager`

### 2. Configurar la base de datos

1. Inicia XAMPP y arranca Apache y MySQL
2. Abre phpMyAdmin en tu navegador: `http://localhost/phpmyadmin`
3. Importa el archivo `backend/database/setup.sql` o copia y pega su contenido en la pestaña SQL
4. Esto creará la base de datos `mat-manager` con las tablas necesarias

### 3. Verificar configuración

El archivo `config.php` ya está configurado para XAMPP con los valores por defecto:
- Host: 127.0.0.1
- Usuario: root
- Contraseña: (vacía)
- Base de datos: mat-manager

Si tu XAMPP usa una configuración diferente, edita el archivo `config.php`

### 4. Acceder a la aplicación

1. Abre tu navegador
2. Ve a: `http://localhost/mat-manager`
3. Serás redirigido al login

### 5. Credenciales por defecto

- **Usuario:** admin
- **Contraseña:** admin123

## Estructura del Proyecto

\`\`\`
mat-manager/
├── api/                    # Backend API (endpoints REST)
│   ├── auth/              # Autenticación
│   ├── materials/         # CRUD de materiales
│   ├── users/             # CRUD de usuarios
│   ├── providers/         # Proveedores
│   └── orders/            # Pedidos
├── frontend/              # Frontend (HTML/CSS/JS)
│   ├── assets/           # Recursos estáticos
│   │   ├── css/         # Estilos
│   │   ├── js/          # Scripts (tailwind, etc)
│   │   └── images/      # Imágenes
│   ├── js/              # JavaScript de la aplicación
│   ├── admin/           # Dashboard administrador
│   ├── gerente/         # Dashboard gerente
│   ├── bodeguero/       # Dashboard bodeguero
│   └── login.html       # Página de login
├── backend/              # Backend organizado
│   ├── config/          # Configuración
│   ├── database/        # Scripts SQL
│   └── legacy/          # Código PHP antiguo (referencia)
├── config.php           # Configuración principal
├── index.php            # Punto de entrada
└── .htaccess           # Configuración Apache
\`\`\`

## Solución de Problemas

### Error de conexión a la base de datos
- Verifica que MySQL esté corriendo en XAMPP
- Verifica que la base de datos `mat-manager` exista
- Revisa las credenciales en `config.php`

### Los estilos no cargan
- Verifica que Apache esté corriendo
- Limpia la caché del navegador (Ctrl + F5)
- Verifica que la ruta sea `http://localhost/mat-manager` (no file://)

### Error 404 en la API
- Verifica que el archivo `.htaccess` esté en la raíz del proyecto
- Verifica que `mod_rewrite` esté habilitado en Apache
- En XAMPP, edita `httpd.conf` y asegúrate que `AllowOverride All` esté configurado

### La sesión no persiste
- Verifica que las cookies estén habilitadas en tu navegador
- Verifica los permisos de la carpeta `C:\xampp\tmp`

## Desarrollo

Para desarrollo, puedes activar los errores de PHP editando `config.php`:

\`\`\`php
error_reporting(E_ALL);
ini_set('display_errors', 1);
\`\`\`

**Importante:** Desactiva esto en producción.

## Seguridad

Antes de usar en producción:
1. Cambia las credenciales por defecto
2. Usa contraseñas seguras
3. Habilita HTTPS
4. Desactiva la visualización de errores
5. Actualiza el archivo `.htaccess` para mayor seguridad
