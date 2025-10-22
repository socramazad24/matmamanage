# MatManager - Frontend

Sistema de control de materiales de construcción desarrollado con React, TypeScript y TailwindCSS.

## Características

- **Interfaz Minimalista**: Diseño limpio con colores amarillo, blanco y negro
- **Modo Claro/Oscuro**: Cambia entre temas según tu preferencia
- **Gestión Completa**: Módulos para materiales, pedidos, proveedores y usuarios
- **Exportación**: Genera reportes en PDF y Excel de todas las tablas
- **Autenticación**: Sistema de login con roles (administrador, gerente, bodeguero)
- **Responsive**: Adaptado para dispositivos móviles, tablets y desktop

## Tecnologías Utilizadas

- **React 18**: Biblioteca de UI
- **TypeScript**: Tipado estático
- **Vite**: Build tool moderno
- **TailwindCSS**: Framework de estilos
- **React Router**: Navegación
- **jsPDF**: Generación de PDF
- **xlsx**: Exportación a Excel
- **Lucide React**: Iconos

## Estructura del Proyecto

```
frontend/
├── src/
│   ├── components/        # Componentes reutilizables
│   │   ├── Button.tsx
│   │   ├── Input.tsx
│   │   ├── Modal.tsx
│   │   ├── Header.tsx
│   │   ├── Sidebar.tsx
│   │   └── Layout.tsx
│   ├── pages/            # Páginas de la aplicación
│   │   ├── Login.tsx
│   │   ├── Dashboard.tsx
│   │   ├── Materials.tsx
│   │   ├── Orders.tsx
│   │   ├── Providers.tsx
│   │   └── Users.tsx
│   ├── services/         # Servicios API
│   │   └── api.ts
│   ├── hooks/           # React Hooks personalizados
│   │   ├── useAuth.ts
│   │   └── useTheme.ts
│   ├── utils/           # Utilidades
│   │   ├── cn.ts
│   │   └── exportUtils.ts
│   ├── types/           # Definiciones de tipos TypeScript
│   │   └── index.ts
│   ├── styles/          # Estilos globales
│   │   └── index.css
│   ├── App.tsx          # Componente principal
│   └── main.tsx         # Punto de entrada
├── public/              # Archivos estáticos
├── index.html           # HTML base
├── package.json         # Dependencias
├── vite.config.ts       # Configuración de Vite
├── tailwind.config.js   # Configuración de Tailwind
└── tsconfig.json        # Configuración de TypeScript
```

## Instalación

1. **Navegar al directorio del frontend**:
```bash
cd frontend
```

2. **Instalar dependencias**:
```bash
npm install
```

## Configuración del Backend

El frontend está configurado para conectarse al backend PHP en XAMPP. Asegúrate de:

1. **Iniciar XAMPP**: Apache y MySQL deben estar corriendo
2. **Base de datos**: Importar el archivo `backend/database/mat-manager.sql`
3. **Backend API**: Los archivos PHP deben estar en la carpeta del proyecto

El proxy de Vite redirige las peticiones `/api` a `http://localhost:80` donde está corriendo el backend PHP.

## Scripts Disponibles

### Desarrollo
```bash
npm run dev
```
Inicia el servidor de desarrollo en `http://localhost:3000`

### Construcción
```bash
npm run build
```
Genera los archivos optimizados para producción en la carpeta `dist/`

### Vista previa
```bash
npm run preview
```
Previsualiza la versión de producción localmente

## Uso

### Login
- Usuario: `marcos`
- Contraseña: `2401`
- Rol: Administrador

O crea un nuevo usuario con rol de administrador desde la base de datos.

### Módulos

#### Dashboard
Muestra estadísticas generales del sistema:
- Total de materiales
- Total de pedidos
- Total de proveedores
- Valor total del inventario

#### Materiales
- Ver listado de materiales
- Crear nuevo material
- Editar material existente
- Eliminar material
- Exportar a PDF/Excel

#### Pedidos
- Ver listado de pedidos
- Crear nuevo pedido
- Ver estado de pedidos (Pendiente/Recibido)
- Exportar a PDF/Excel

#### Proveedores
- Ver listado de proveedores
- Crear nuevo proveedor
- Ver información de contacto
- Exportar a PDF/Excel

#### Usuarios (Solo Administradores)
- Ver listado de usuarios
- Crear nuevo usuario
- Editar usuario existente
- Eliminar usuario
- Asignar roles (administrador, gerente, bodeguero)
- Exportar a PDF/Excel

## Temas

### Modo Claro
- Fondo blanco
- Texto negro
- Acentos en amarillo

### Modo Oscuro
- Fondo gris oscuro
- Texto blanco
- Acentos en amarillo

Cambiar entre temas usando el botón del sol/luna en el header.

## Exportación de Datos

### PDF
Genera documentos PDF con formato de tabla profesional:
- Encabezado con título
- Fecha de generación
- Columnas organizadas
- Colores del tema (amarillo)

### Excel
Genera hojas de cálculo con todos los datos de la tabla:
- Formato .xlsx
- Todas las columnas incluidas
- Datos sin formato para facilitar análisis

## Roles y Permisos

### Administrador
- Acceso completo a todos los módulos
- Gestión de usuarios
- Todas las operaciones CRUD

### Gerente
- Ver y gestionar materiales, pedidos y proveedores
- Sin acceso al módulo de usuarios

### Bodeguero
- Ver y gestionar materiales, pedidos y proveedores
- Sin acceso al módulo de usuarios

## API Endpoints

El frontend se comunica con los siguientes endpoints del backend:

### Autenticación
- `POST /api/auth/login.php` - Iniciar sesión
- `POST /api/auth/logout.php` - Cerrar sesión
- `GET /api/auth/check.php` - Verificar sesión

### Materiales
- `GET /api/materials/list.php` - Listar materiales
- `POST /api/materials/create.php` - Crear material
- `POST /api/materials/update.php` - Actualizar material
- `POST /api/materials/delete.php` - Eliminar material

### Pedidos
- `GET /api/orders/list.php` - Listar pedidos
- `POST /api/orders/create.php` - Crear pedido

### Proveedores
- `GET /api/providers/list.php` - Listar proveedores
- `POST /api/providers/create.php` - Crear proveedor

### Usuarios
- `GET /api/users/list.php` - Listar usuarios (admin)
- `POST /api/users/create.php` - Crear usuario (admin)
- `POST /api/users/update.php` - Actualizar usuario (admin)
- `POST /api/users/delete.php` - Eliminar usuario (admin)

## Personalización

### Colores
Editar `tailwind.config.js` para cambiar la paleta de colores:
```javascript
theme: {
  extend: {
    colors: {
      primary: { ... }, // Amarillo
      dark: { ... }     // Negro/Gris
    }
  }
}
```

### Animaciones
Las animaciones están definidas en `tailwind.config.js`:
- `fade-in`: Aparición gradual
- `slide-up`: Deslizamiento hacia arriba

## Solución de Problemas

### El frontend no se conecta al backend
1. Verificar que XAMPP esté corriendo
2. Verificar la URL del proxy en `vite.config.ts`
3. Verificar que los archivos PHP estén en la ubicación correcta

### Error de CORS
El backend debe tener configurados los headers CORS en `/api/config/cors.php`

### No se puede iniciar sesión
1. Verificar que la base de datos esté importada
2. Verificar que exista un usuario en la tabla `users`
3. Revisar las credenciales

### Los estilos no se aplican
1. Ejecutar `npm install` nuevamente
2. Verificar que TailwindCSS esté configurado correctamente
3. Reiniciar el servidor de desarrollo

## Contribuir

1. Fork el proyecto
2. Crear una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abrir un Pull Request

## Licencia

Este proyecto es parte del sistema MatManager para control de materiales de construcción.

## Contacto

Para soporte o consultas sobre el proyecto MatManager.

---

Desarrollado con React, TypeScript y TailwindCSS
