# MAT-MANAGER

Sistema de gestión de materiales desarrollado con React + Vite en el frontend y PHP en el backend.

## 🚀 Tecnologías Utilizadas

### Frontend
- **React 18** - Librería de JavaScript para construir interfaces de usuario
- **Vite** - Build tool y dev server ultrarrápido
- **TailwindCSS** - Framework de CSS utility-first para diseño moderno
- **React Router DOM** - Enrutamiento del lado del cliente
- **JavaScript (JSX)** - Sin TypeScript, usando JavaScript puro

### Backend
- **PHP** - Lenguaje de servidor
- **MySQL** - Base de datos relacional
- **API REST** - Arquitectura de API

## 📁 Estructura del Proyecto

\`\`\`
mat-manager/
├── frontend/                    # Aplicación React
│   ├── public/                  # Archivos estáticos
│   │   └── images/             # Imágenes del proyecto
│   ├── src/
│   │   ├── components/         # Componentes reutilizables
│   │   │   ├── Layout.jsx      # Layout principal con header/footer
│   │   │   ├── DashboardCard.jsx
│   │   │   └── ProtectedRoute.jsx
│   │   ├── context/            # Context API de React
│   │   │   └── AuthContext.jsx # Manejo de autenticación
│   │   ├── pages/              # Páginas de la aplicación
│   │   │   ├── Login.jsx       # Página de inicio de sesión
│   │   │   ├── admin/          # Páginas del administrador
│   │   │   │   ├── Dashboard.jsx
│   │   │   │   ├── Users.jsx
│   │   │   │   ├── Providers.jsx
│   │   │   │   └── History.jsx
│   │   │   ├── gerente/        # Páginas del gerente
│   │   │   │   ├── Dashboard.jsx
│   │   │   │   ├── Materials.jsx
│   │   │   │   └── Orders.jsx
│   │   │   └── bodeguero/      # Páginas del bodeguero
│   │   │       └── Materials.jsx
│   │   ├── services/           # Servicios y API
│   │   │   └── api.js          # Cliente API REST
│   │   ├── App.jsx             # Componente principal
│   │   ├── main.jsx            # Punto de entrada
│   │   └── index.css           # Estilos globales
│   ├── .env                    # Variables de entorno
│   ├── index.html              # HTML principal
│   ├── package.json            # Dependencias del proyecto
│   ├── vite.config.js          # Configuración de Vite
│   ├── tailwind.config.js      # Configuración de Tailwind
│   └── postcss.config.js       # Configuración de PostCSS
├── api/                        # API REST en PHP
│   ├── auth/                   # Endpoints de autenticación
│   ├── materials/              # Endpoints de materiales
│   ├── users/                  # Endpoints de usuarios
│   ├── providers/              # Endpoints de proveedores
│   ├── orders/                 # Endpoints de pedidos
│   ├── config/                 # Configuración de la API
│   └── middleware/             # Middleware de autenticación
├── backend/                    # Backend PHP legacy
│   ├── config/                 # Configuración de base de datos
│   ├── database/               # Scripts SQL
│   └── legacy/                 # Código legacy
└── config.php                  # Configuración global

\`\`\`

## 🎨 Características del Diseño

### Paleta de Colores
- **Primary**: `#0F0F0F` (Negro profundo)
- **Secondary**: `#FEB900` (Amarillo dorado)
- **Accent**: `#FF8C00` (Naranja)

### Diseño Minimalista
- Interfaz limpia y moderna
- Espaciado generoso
- Transiciones suaves
- Cards con sombras sutiles
- Hover effects elegantes
- Responsive design para todos los dispositivos

## 🔐 Roles de Usuario

El sistema maneja tres roles diferentes:

1. **Administrador**
   - Gestión de usuarios
   - Gestión de proveedores
   - Visualización de historiales

2. **Gerente**
   - Visualización de materiales
   - Gestión de pedidos

3. **Bodeguero**
   - Visualización de materiales en bodega

## 🛠️ Instalación y Configuración

### Requisitos Previos
- Node.js 18+ y npm/pnpm
- XAMPP (Apache + MySQL + PHP)
- Git

### Paso 1: Clonar el Repositorio
\`\`\`bash
git clone <repository-url>
cd mat-manager
\`\`\`

### Paso 2: Configurar la Base de Datos
1. Iniciar XAMPP (Apache y MySQL)
2. Abrir phpMyAdmin (http://localhost/phpmyadmin)
3. Crear base de datos `mat-manager`
4. Importar el archivo `backend/database/mat-manager.sql`

### Paso 3: Configurar el Backend
El archivo `config.php` en la raíz ya está configurado para XAMPP:
\`\`\`php
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'mat-manager');
\`\`\`

### Paso 4: Instalar Dependencias del Frontend
\`\`\`bash
cd frontend
npm install
# o
pnpm install
\`\`\`

### Paso 5: Configurar Variables de Entorno
El archivo `.env` ya está creado en `frontend/.env`:
\`\`\`env
VITE_API_BASE_URL=http://localhost/mat-manager/api
\`\`\`

**IMPORTANTE**: Si tu proyecto está en una ruta diferente o usas un puerto diferente, ajusta la URL:
- Puerto personalizado: `http://localhost:8080/mat-manager/api`
- Virtual host: `http://mat-manager.local/api`
- Subcarpeta diferente: `http://localhost/mi-carpeta/api`

### Paso 6: Iniciar el Proyecto

**IMPORTANTE**: Debes tener XAMPP corriendo con Apache y MySQL antes de iniciar el frontend.

#### Verificar el Backend
Antes de iniciar el frontend, verifica que el backend esté funcionando:
\`\`\`bash
# Abre en tu navegador:
http://localhost/mat-manager/api/auth/check.php
\`\`\`

Deberías ver una respuesta JSON como:
\`\`\`json
{"success":false,"authenticated":false,"message":"No autenticado"}
\`\`\`

Si ves un error 404 o HTML en lugar de JSON, revisa:
1. Que XAMPP esté corriendo
2. Que el proyecto esté en `C:\xampp\htdocs\mat-manager\`
3. Que Apache esté configurado correctamente

#### Iniciar el Frontend

**Opción 1: Desarrollo con Vite Dev Server**
\`\`\`bash
cd frontend
npm install  # Solo la primera vez
npm run dev
\`\`\`
La aplicación estará disponible en `http://localhost:3000`

**NOTA**: Si cambias el archivo `.env`, debes reiniciar el servidor de Vite para que los cambios tomen efecto.

### Paso 7: Configurar Apache (XAMPP)
1. Copiar el proyecto a `C:/xampp/htdocs/mat-manager`
2. Acceder a `http://localhost/mat-manager`

## 📝 Uso de la Aplicación

### Login
1. Acceder a la página de login
2. Ingresar credenciales según el rol
3. El sistema redirige automáticamente al dashboard correspondiente

### Navegación
- Cada rol tiene acceso a diferentes secciones
- El sistema valida permisos en cada ruta
- Logout disponible en todas las páginas

## 🔄 Migración de HTML a React

### Cambios Principales

1. **Estructura de Archivos**
   - ❌ Antes: Múltiples archivos HTML separados
   - ✅ Ahora: Componentes React con enrutamiento SPA

2. **Gestión de Estado**
   - ❌ Antes: Variables globales y localStorage
   - ✅ Ahora: React Context API para autenticación

3. **Estilos**
   - ❌ Antes: CSS externo y Tailwind CDN
   - ✅ Ahora: TailwindCSS compilado con clases utility

4. **API Calls**
   - ❌ Antes: Fetch directo en cada archivo
   - ✅ Ahora: Servicio API centralizado

5. **Enrutamiento**
   - ❌ Antes: Navegación con `window.location.href`
   - ✅ Ahora: React Router DOM con navegación SPA

## 🚀 Scripts Disponibles

\`\`\`bash
# Desarrollo
npm run dev          # Inicia el servidor de desarrollo

# Producción
npm run build        # Compila para producción
npm run preview      # Preview del build de producción
\`\`\`

## 🔧 Configuración de Vite

El proyecto usa Vite sin proxy, haciendo peticiones directas al backend PHP:

\`\`\`javascript
server: {
  port: 3000,
}
\`\`\`

Las peticiones a la API se hacen directamente a `http://localhost/mat-manager/api` usando CORS.

## 🔒 Configuración de CORS

El backend PHP está configurado para aceptar peticiones desde el frontend en `http://localhost:3000`.

Si necesitas cambiar el puerto del frontend, actualiza el archivo `api/config/cors.php`:
\`\`\`php
header("Access-Control-Allow-Origin: http://localhost:TU_PUERTO");
\`\`\`

## 🐛 Solución de Problemas

### Error: "Failed to load resource: 404"
**Causa**: El backend PHP no está accesible.

**Solución**:
1. Verifica que XAMPP esté corriendo (Apache y MySQL en verde)
2. Confirma que el proyecto esté en `C:\xampp\htdocs\mat-manager\`
3. Prueba acceder a: `http://localhost/mat-manager/api/auth/check.php`
4. Si no funciona, revisa los logs de Apache en `C:\xampp\apache\logs\error.log`

### Error: "CORS policy"
**Causa**: El backend no permite peticiones desde el frontend.

**Solución**:
1. Verifica que `api/config/cors.php` tenga la URL correcta del frontend
2. Reinicia Apache en XAMPP
3. Limpia la caché del navegador

### Error: "Connection refused"
**Causa**: Apache no está corriendo o está en un puerto diferente.

**Solución**:
1. Abre el panel de control de XAMPP
2. Verifica que Apache esté en verde (corriendo)
3. Si Apache no inicia, revisa que el puerto 80 no esté ocupado por otro programa
4. Puedes cambiar el puerto de Apache en `httpd.conf` si es necesario

### El frontend carga pero no se conecta al backend
**Causa**: La URL de la API en `.env` es incorrecta.

**Solución**:
1. Verifica que `frontend/.env` tenga: `VITE_API_BASE_URL=http://localhost/mat-manager/api`
2. Ajusta la URL según tu configuración de XAMPP
3. **Reinicia el servidor de Vite** después de cambiar el `.env`

### Cambios en .env no se aplican
**Causa**: Vite no recarga automáticamente las variables de entorno.

**Solución**:
1. Detén el servidor de Vite (Ctrl+C)
2. Vuelve a iniciar con `npm run dev`
3. Verifica en la consola del navegador que la URL sea correcta

## 📋 Checklist de Instalación

- [ ] XAMPP instalado y corriendo
- [ ] Apache en verde (puerto 80)
- [ ] MySQL en verde (puerto 3306)
- [ ] Proyecto en `C:\xampp\htdocs\mat-manager\`
- [ ] Base de datos `mat-manager` creada e importada
- [ ] `http://localhost/mat-manager/api/auth/check.php` responde JSON
- [ ] Node.js instalado (v18 o superior)
- [ ] Dependencias instaladas (`npm install` en frontend)
- [ ] Archivo `.env` configurado con la URL correcta
- [ ] Servidor de Vite corriendo (`npm run dev`)
- [ ] Login funciona correctamente

## 📚 Documentación Adicional

- **QUICK_START.md** - Guía rápida de instalación paso a paso
- **TROUBLESHOOTING.md** - Solución detallada de problemas comunes
- **SETUP.md** - Configuración avanzada del proyecto

---

**Desarrollado con ❤️ usando React + Vite + TailwindCSS**
