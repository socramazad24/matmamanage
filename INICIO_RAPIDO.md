# Inicio Rápido - MatManager

Guía rápida para poner en marcha el sistema MatManager.

## 1. Configurar Backend (PHP + MySQL)

### Iniciar XAMPP
1. Abrir XAMPP Control Panel
2. Iniciar **Apache**
3. Iniciar **MySQL**

### Crear Base de Datos
1. Abrir navegador en: `http://localhost/phpmyadmin`
2. Crear nueva base de datos llamada: `mat-manager`
3. Seleccionar la base de datos
4. Ir a pestaña "Importar"
5. Seleccionar archivo: `backend/database/mat-manager.sql`
6. Click en "Continuar"

### Verificar Configuración
Editar archivo `config.php` en la raíz del proyecto:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');          // Tu usuario MySQL
define('DB_PASS', '');              // Tu contraseña MySQL
define('DB_NAME', 'mat-manager');
```

### Ubicar Proyecto en XAMPP
Copiar toda la carpeta del proyecto a:
```
C:/xampp/htdocs/matmanager/
```

O crear un enlace simbólico.

## 2. Configurar Frontend (React)

### Instalar Dependencias
```bash
cd frontend
npm install
```

### Iniciar Servidor de Desarrollo
```bash
npm run dev
```

El frontend estará disponible en: `http://localhost:3000`

## 3. Acceder al Sistema

### Abrir en el navegador
```
http://localhost:3000
```

### Credenciales de Acceso

**Administrador:**
- Usuario: `marcos`
- Contraseña: `2401`

**Otros usuarios (contraseña para todos: 2401):**
- `checo` (Bodeguero)
- `ssayko` (Gerente)
- `pepin` (Bodeguero)

## 4. Verificar Funcionamiento

### Backend
Probar que el backend responde:
```
http://localhost/matmanager/api/test.php
```

Debería mostrar un mensaje de confirmación.

### Frontend
1. Iniciar sesión con las credenciales
2. Navegar por los diferentes módulos:
   - Dashboard
   - Materiales
   - Pedidos
   - Proveedores
   - Usuarios (solo admin)

## 5. Funcionalidades Principales

### Cambiar Tema
Click en el icono de sol/luna en el header

### Exportar Datos
En cada módulo, usar botones "PDF" o "Excel"

### Crear Registros
Click en botón "Nuevo..." en cada módulo

### Editar/Eliminar
Usar iconos en la columna "Acciones" de cada tabla

## Solución Rápida de Problemas

### Error de conexión al backend
```bash
# Verificar que Apache y MySQL estén corriendo en XAMPP
# Verificar que la ruta del proyecto sea correcta
```

### Error al instalar dependencias
```bash
cd frontend
rm -rf node_modules package-lock.json
npm install
```

### Puerto 3000 en uso
Editar `frontend/vite.config.ts` y cambiar el puerto:
```typescript
server: {
  port: 3001, // Cambiar a otro puerto
}
```

### Base de datos no conecta
1. Verificar MySQL en XAMPP
2. Verificar credenciales en `config.php`
3. Verificar que la base de datos `mat-manager` exista

## Estructura de Carpetas

```
matmanager/
├── api/                    # Backend PHP
├── frontend/               # Frontend React
│   ├── src/
│   ├── package.json
│   └── README.md
├── backend/
│   └── database/
│       └── mat-manager.sql # ¡Importar este archivo!
├── config.php              # ¡Configurar credenciales aquí!
└── MATMANAGER_README.md   # Documentación completa
```

## Comandos Útiles

### Frontend
```bash
cd frontend

# Desarrollo
npm run dev

# Compilar para producción
npm run build

# Vista previa de producción
npm run preview
```

### Ver Logs de Errores
- Frontend: Consola del navegador (F12)
- Backend: Ver logs de Apache en XAMPP

## Próximos Pasos

1. Explorar todos los módulos
2. Crear algunos registros de prueba
3. Probar la exportación a PDF/Excel
4. Cambiar entre modo claro y oscuro
5. Crear usuarios con diferentes roles

## Soporte

Para más información, consultar:
- `MATMANAGER_README.md` - Documentación completa
- `frontend/README.md` - Documentación del frontend

---

¡Listo para usar MatManager!
