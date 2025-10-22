# Características del Frontend - MatManager

## Diseño Visual

### Paleta de Colores
- **Primario**: Amarillo (#FCD34D) - Botones, acentos, highlights
- **Fondo Claro**: Blanco (#FFFFFF) - Modo día
- **Fondo Oscuro**: Gris Oscuro (#1F2937) - Modo noche
- **Texto**: Negro/Blanco - Según el tema activo

### Tema Claro
```
- Fondo: Blanco limpio
- Cards: Blanco con sombras sutiles
- Texto: Negro/Gris oscuro
- Acentos: Amarillo vibrante
- Bordes: Gris claro
```

### Tema Oscuro
```
- Fondo: Gris muy oscuro
- Cards: Gris oscuro con bordes sutiles
- Texto: Blanco/Gris claro
- Acentos: Amarillo vibrante
- Bordes: Gris medio oscuro
```

## Componentes Principales

### 1. Sidebar (Menú Lateral)
- **Características**:
  - Logo de MatManager en la parte superior
  - Navegación con iconos y texto
  - Resaltado del item activo (fondo amarillo)
  - Información del usuario en la parte inferior
  - Botón de cerrar sesión
  - Responsive: se oculta en móvil, overlay en tablet

- **Items de Menú**:
  - Dashboard (LayoutDashboard)
  - Materiales (Package)
  - Pedidos (ShoppingCart)
  - Proveedores (Truck)
  - Usuarios (Users) - Solo administradores

### 2. Header
- **Características**:
  - Botón de menú móvil (hamburguesa)
  - Título del sistema
  - Toggle de tema (Sol/Luna)
  - Sticky en la parte superior
  - Responsive con mejor disposición móvil

### 3. Cards de Dashboard
- **Estadísticas Visuales**:
  - Total de materiales (icono Package, fondo azul)
  - Total de pedidos (icono ShoppingCart, fondo verde)
  - Total de proveedores (icono Truck, fondo morado)
  - Valor total inventario (icono TrendingUp, fondo amarillo)

### 4. Tablas de Datos
- **Diseño**:
  - Encabezados con fondo gris claro/oscuro
  - Rows con hover effect
  - Columnas organizadas y legibles
  - Responsive horizontal scroll
  - Iconos de acciones (editar, eliminar)
  - Estados con badges de colores

### 5. Modales
- **Características**:
  - Overlay con fondo semi-transparente
  - Animación de aparición (slide-up)
  - Header con título y botón cerrar
  - Formularios organizados
  - Botones de acción al final
  - Cierre al click fuera

### 6. Botones
- **Variantes**:
  - Primary: Amarillo, para acciones principales
  - Secondary: Gris, para acciones secundarias
  - Danger: Rojo, para eliminar
  - Ghost: Transparente, para hover

- **Tamaños**:
  - Small (sm): Compacto
  - Medium (md): Estándar
  - Large (lg): Prominente

### 7. Inputs
- **Características**:
  - Label encima del campo
  - Border con focus amarillo
  - Placeholder sutil
  - Mensajes de error en rojo
  - Soporte para modo oscuro
  - Diferentes tipos (text, number, email, tel, password)

## Páginas

### Login
- Diseño centrado
- Card con sombra
- Logo prominente
- Formulario simple
- Mensajes de error claros
- Fondo con gradiente amarillo

### Dashboard
- Grid responsive (1-2-4 columnas)
- Cards con estadísticas
- Iconos coloridos
- Carga de datos en tiempo real
- Loading spinner

### Materiales
- Tabla completa de materiales
- Botones de exportación (PDF/Excel)
- Modal de creación/edición
- Validación de formularios
- Botones de editar/eliminar por fila

### Pedidos
- Tabla de pedidos
- Estados con badges de color
- Modal de creación
- Exportación PDF/Excel
- Visualización de fechas

### Proveedores
- Tabla de proveedores
- Información de contacto
- Modal de creación
- Exportación PDF/Excel
- Datos organizados

### Usuarios (Solo Admin)
- Tabla de usuarios del sistema
- Roles con badges
- Modal de creación/edición
- CRUD completo
- Exportación PDF/Excel
- Select para roles

## Características Técnicas

### Animaciones
```css
- fade-in: Aparición gradual (opacity 0 -> 1)
- slide-up: Deslizamiento vertical (translateY)
- Hover effects en botones y rows
- Transiciones suaves (300ms)
```

### Responsive Design

**Móvil (< 1024px)**:
- Sidebar oculto por defecto
- Botón de menú hamburguesa visible
- Overlay oscuro al abrir sidebar
- Tablas con scroll horizontal
- Cards en una columna
- Formularios apilados

**Tablet (1024px - 1280px)**:
- Sidebar visible
- Layout optimizado
- Cards en 2 columnas
- Mejor aprovechamiento del espacio

**Desktop (> 1280px)**:
- Sidebar fijo
- Cards en 4 columnas
- Tablas completas sin scroll
- Máximo espacio para contenido

### Accesibilidad
- Labels en todos los inputs
- ARIA labels en botones
- Contraste de colores adecuado
- Focus visible en elementos interactivos
- Keyboard navigation

### Performance
- Lazy loading de componentes
- Código optimizado con Vite
- Tree shaking automático
- CSS purging con Tailwind
- Minificación en producción

## Exportación de Datos

### PDF
```javascript
- Librería: jsPDF + jspdf-autotable
- Formato: Tabla profesional
- Header: Título y fecha
- Estilo: Colores del tema
- Auto-width de columnas
- Nombre de archivo con timestamp
```

### Excel
```javascript
- Librería: xlsx
- Formato: .xlsx
- Hoja: Sheet1
- Datos: Sin formato para análisis
- Nombre de archivo con timestamp
- Compatible con Excel, Google Sheets
```

## Flujo de Autenticación

1. Usuario ingresa credenciales en Login
2. Frontend envía POST a `/api/auth/login.php`
3. Backend valida y crea sesión
4. Frontend guarda usuario en contexto
5. Protección de rutas por rol
6. Verificación de sesión al cargar app
7. Logout limpia sesión y redirige

## Estado Global

### AuthContext
```typescript
- user: Usuario actual o null
- loading: Estado de carga
- login(username, password): Iniciar sesión
- logout(): Cerrar sesión
```

### ThemeContext
```typescript
- theme: 'light' | 'dark'
- toggleTheme(): Cambiar tema
- Persistencia en localStorage
```

## API Client

### ApiService
```typescript
- request<T>(): Método genérico
- Credenciales incluidas
- Headers JSON automáticos
- Manejo de errores
- Tipado TypeScript

Métodos disponibles:
- login, logout, checkAuth
- getMaterials, createMaterial, updateMaterial, deleteMaterial
- getOrders, createOrder
- getProviders, createProvider
- getUsers, createUser, updateUser, deleteUser
```

## Utilidades

### cn (Class Names)
```typescript
Combina y mergea clases de Tailwind
- clsx para condicionales
- twMerge para conflictos
```

### exportUtils
```typescript
exportToPDF(data, columns, title)
exportToExcel(data, filename)
```

## Tipos TypeScript

```typescript
- User: Usuario del sistema
- Material: Material de construcción
- Order: Pedido
- Provider: Proveedor
- AuthResponse: Respuesta de auth
- ApiResponse<T>: Respuesta genérica API
```

## Próximas Mejoras

- [ ] Paginación en tablas
- [ ] Búsqueda y filtros
- [ ] Ordenamiento de columnas
- [ ] Gráficos en dashboard
- [ ] Notificaciones toast
- [ ] Drag & drop para archivos
- [ ] Modo offline
- [ ] Progressive Web App (PWA)

---

Frontend desarrollado con React 18, TypeScript, Vite y TailwindCSS
