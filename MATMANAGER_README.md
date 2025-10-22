# MatManager - Sistema de Control de Materiales de Construcción

Sistema completo de gestión de materiales de construcción con frontend en React y backend en PHP.

## Descripción General

MatManager es un sistema web diseñado para gestionar el control de materiales de construcción, incluyendo inventario, pedidos, proveedores y usuarios. Cuenta con un diseño minimalista, modo claro/oscuro, y capacidad de exportación a PDF y Excel.

## Características Principales

### Frontend (React + TypeScript + TailwindCSS)
- **Diseño Minimalista**: Interfaz limpia con colores amarillo, blanco y negro
- **Modo Claro/Oscuro**: Toggle para cambiar entre temas
- **Responsive**: Adaptado para móvil, tablet y desktop
- **Exportación**: Generación de reportes en PDF y Excel
- **Autenticación**: Sistema de login con roles diferenciados
- **Navegación Fluida**: React Router para SPA

### Backend (PHP + MySQL)
- **API RESTful**: Endpoints organizados por módulos
- **Autenticación por Sesiones**: Manejo seguro de usuarios
- **CORS Configurado**: Permite conexión con frontend
- **Base de Datos MySQL**: Con triggers para historial automático
- **Middleware de Autenticación**: Protección de endpoints

## Tecnologías

### Frontend
- React 18
- TypeScript
- Vite
- TailwindCSS
- React Router
- jsPDF & xlsx (exportación)
- Lucide React (iconos)

### Backend
- PHP 8.x
- MySQL/MariaDB
- XAMPP

## Estructura del Proyecto

```
project/
├── frontend/                  # Aplicación React
│   ├── src/
│   │   ├── components/       # Componentes reutilizables
│   │   ├── pages/           # Páginas de la aplicación
│   │   ├── services/        # Servicios API
│   │   ├── hooks/          # Hooks personalizados
│   │   ├── utils/          # Utilidades
│   │   ├── types/          # Tipos TypeScript
│   │   └── styles/         # Estilos globales
│   ├── package.json
│   └── README.md           # Documentación del frontend
│
├── api/                      # Backend PHP
│   ├── auth/               # Autenticación
│   ├── materials/          # Gestión de materiales
│   ├── orders/            # Gestión de pedidos
│   ├── providers/         # Gestión de proveedores
│   ├── users/            # Gestión de usuarios
│   ├── config/           # Configuración (DB, CORS)
│   └── middleware/       # Middleware de autenticación
│
├── backend/                 # Backend legacy y utilidades
│   └── database/           # Scripts SQL
│       └── mat-manager.sql # Base de datos
│
└── config.php              # Configuración de base de datos
```

## Instalación

### Requisitos Previos
- XAMPP (Apache + MySQL)
- Node.js (v16 o superior)
- npm o yarn

### Paso 1: Configurar Backend

1. **Instalar XAMPP** y iniciar Apache y MySQL

2. **Crear Base de Datos**:
   - Abrir phpMyAdmin: `http://localhost/phpmyadmin`
   - Crear una base de datos llamada `mat-manager`
   - Importar el archivo: `backend/database/mat-manager.sql`

3. **Configurar Conexión**:
   Editar `config.php` con tus credenciales:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   define('DB_NAME', 'mat-manager');
   ```

4. **Copiar Archivos**:
   Copiar toda la carpeta del proyecto a `C:/xampp/htdocs/matmanager/`

### Paso 2: Configurar Frontend

1. **Navegar al directorio**:
   ```bash
   cd frontend
   ```

2. **Instalar dependencias**:
   ```bash
   npm install
   ```

3. **Iniciar servidor de desarrollo**:
   ```bash
   npm run dev
   ```

4. **Abrir en el navegador**:
   ```
   http://localhost:3000
   ```

## Uso

### Credenciales de Acceso

**Administrador** (acceso completo):
- Usuario: `marcos`
- Contraseña: `2401`

**Otros usuarios disponibles en la base de datos**:
- Usuario: `checo` (Bodeguero)
- Usuario: `ssayko` (Gerente)
- Usuario: `pepin` (Bodeguero)
- Contraseña para todos: `2401`

### Módulos Disponibles

#### 1. Dashboard
- Vista general con estadísticas
- Total de materiales, pedidos, proveedores
- Valor total del inventario

#### 2. Materiales
- Listar todos los materiales
- Crear nuevo material
- Editar material existente
- Eliminar material
- Exportar a PDF/Excel

#### 3. Pedidos
- Listar todos los pedidos
- Crear nuevo pedido
- Ver estado (Pendiente/Recibido)
- Exportar a PDF/Excel

#### 4. Proveedores
- Listar todos los proveedores
- Crear nuevo proveedor
- Ver información de contacto
- Exportar a PDF/Excel

#### 5. Usuarios (Solo Administradores)
- Listar todos los usuarios del sistema
- Crear nuevo usuario
- Editar información de usuario
- Eliminar usuario
- Asignar roles (administrador, gerente, bodeguero)
- Exportar a PDF/Excel

## Roles y Permisos

### Administrador
- Acceso completo a todos los módulos
- Puede gestionar usuarios
- Todas las operaciones CRUD

### Gerente
- Ver y gestionar materiales
- Ver y gestionar pedidos
- Ver y gestionar proveedores
- Sin acceso a gestión de usuarios

### Bodeguero
- Ver y gestionar materiales
- Ver y gestionar pedidos
- Ver y gestionar proveedores
- Sin acceso a gestión de usuarios

## Características del Diseño

### Paleta de Colores
- **Principal**: Amarillo (#FCD34D)
- **Fondo Claro**: Blanco (#FFFFFF)
- **Fondo Oscuro**: Gris Oscuro (#1F2937)
- **Texto**: Negro/Blanco según el tema

### Modo Claro/Oscuro
- Toggle en el header (icono sol/luna)
- Preferencia guardada en localStorage
- Transiciones suaves entre temas

### Diseño Responsive
- **Móvil**: Menú lateral colapsable
- **Tablet**: Layout optimizado
- **Desktop**: Sidebar fijo, máximo aprovechamiento del espacio

## Exportación de Datos

### PDF
- Formato profesional con encabezados
- Fecha de generación automática
- Colores del tema aplicados
- Tablas organizadas

### Excel
- Formato .xlsx estándar
- Todas las columnas incluidas
- Datos sin formato para análisis
- Compatible con Excel, Google Sheets, LibreOffice

## API Endpoints

### Autenticación
```
POST /api/auth/login.php       - Iniciar sesión
POST /api/auth/logout.php      - Cerrar sesión
GET  /api/auth/check.php       - Verificar sesión
```

### Materiales
```
GET  /api/materials/list.php   - Listar
POST /api/materials/create.php - Crear
POST /api/materials/update.php - Actualizar
POST /api/materials/delete.php - Eliminar
GET  /api/materials/get.php    - Obtener uno
```

### Pedidos
```
GET  /api/orders/list.php      - Listar
POST /api/orders/create.php    - Crear
```

### Proveedores
```
GET  /api/providers/list.php   - Listar
POST /api/providers/create.php - Crear
```

### Usuarios (Admin)
```
GET  /api/users/list.php       - Listar
POST /api/users/create.php     - Crear
POST /api/users/update.php     - Actualizar
POST /api/users/delete.php     - Eliminar
```

## Base de Datos

### Tablas Principales
- `users` - Usuarios del sistema
- `materiales` - Inventario de materiales
- `pedidos` - Pedidos realizados
- `proovedores` - Proveedores de materiales

### Tablas de Historial (Triggers Automáticos)
- `historialusers` - Historial de cambios en usuarios
- `auditoriamateriales` - Auditoría de materiales
- `historialpedidos` - Historial de pedidos
- `historialproveedores` - Historial de proveedores

## Desarrollo

### Frontend Development
```bash
cd frontend
npm run dev          # Servidor de desarrollo
npm run build        # Compilar para producción
npm run preview      # Previsualizar producción
```

### Scripts Disponibles
- `dev` - Inicia Vite en modo desarrollo (puerto 3000)
- `build` - Compila TypeScript y construye con Vite
- `preview` - Sirve la versión de producción localmente

## Solución de Problemas

### Frontend no se conecta al backend
1. Verificar que XAMPP esté corriendo
2. Verificar proxy en `vite.config.ts`
3. Verificar archivos PHP en ubicación correcta

### Error de CORS
1. Verificar archivo `/api/config/cors.php`
2. Asegurar que headers CORS estén configurados

### Error de autenticación
1. Verificar que la base de datos esté importada
2. Verificar credenciales de usuarios
3. Revisar configuración de sesiones PHP

### Los estilos no se aplican
1. Ejecutar `npm install` nuevamente
2. Verificar configuración de TailwindCSS
3. Reiniciar servidor de desarrollo

## Mejoras Futuras

- [ ] Dashboard con gráficos interactivos
- [ ] Notificaciones en tiempo real
- [ ] Historial de cambios en interfaz
- [ ] Búsqueda y filtrado avanzado
- [ ] Importación masiva de datos (Excel/CSV)
- [ ] Reportes personalizados
- [ ] API documentada con Swagger
- [ ] Tests unitarios y de integración

## Contribuir

1. Fork el proyecto
2. Crear una rama (`git checkout -b feature/NuevaCaracteristica`)
3. Commit cambios (`git commit -m 'Agregar nueva característica'`)
4. Push a la rama (`git push origin feature/NuevaCaracteristica`)
5. Abrir Pull Request

## Licencia

Este proyecto es parte del sistema MatManager para control de materiales de construcción.

## Soporte

Para consultas o soporte sobre MatManager, contactar al equipo de desarrollo.

---

**MatManager** - Sistema de Control de Materiales de Construcción
Desarrollado con React, TypeScript, TailwindCSS, PHP y MySQL
