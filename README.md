# 🚀 Laravel API - Inventario Api

Este proyecto es una API REST construida con Laravel. Incluye autenticación con Laravel Sanctum, control de roles y permisos (Spatie), estructura modular y buenas prácticas para desarrollo de APIs modernas.

---

## 📦 Requisitos

- PHP >= 8.1  
- Composer  
- MySQL o MariaDB  
- Laravel CLI (`composer global require laravel/installer`)

---

## ⚙️ Instalación

Sigue estos pasos para poner en marcha el proyecto en tu entorno local:

### 1. Clonar el repositorio

```bash
git clone https://github.com/josedavidglz/inventario-api.git
cd inventario-api
```

### 2. Instalar dependencias 

```bash
composer install
```

### 3. Configurar entorno 

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Ejecutar migraciones 

```bash
php artisan migrate
```

### 5. Ejecutar seeders 

```bash
php artisan db:seed
```
Este comando creará un usuario administrador por defecto con todos los permisos habilitados:

- 📧 **Email**: `admin@gmail.com`  
- 🔑 **Contraseña**: `123456789`


### 6. Iniciar proyecto 

```bash
php artisan serve
```

La aplicación estará disponible en:

📍 http://localhost:8000 


## 📬 Uso con Postman

Para facilitar las pruebas de la API, se incluye una **colección Postman** exportada con todos los endpoints necesarios.

### 📥 Importar colección en Postman

1. Abre Postman.
2. Haz clic en el botón **"Import"** (arriba a la izquierda).
3. Selecciona la pestaña **"Archivo"**.
4. Haz clic en **"Subir archivos"** y selecciona el archivo `laravel-api.postman_collection.json`
5. La colección aparecerá en tu lista de colecciones, lista para usar.

### 📥 Descargar colección Postman

Puedes descargar la colección de Postman desde el siguiente enlace:

👉 [Descargar colección desde OneDrive](https://drive.google.com/file/d/1SZ_CqwHYS8G73cVz36RRUCDjybke8asI/view?usp=sharing)

Una vez descargado, sigue los pasos de importación descritos en la sección anterior.

### 🔐 Autenticación con token (Laravel Sanctum)

1. Usa el endpoint de login para obtener el token:

```http
POST /api/login
Content-Type: application/json

{
  "email": "admin@gmail.com",
  "password": "123456789"
}
```

## 🧠 Decisiones de Diseño

A continuación se detallan algunas decisiones técnicas clave tomadas en el desarrollo de esta API.

### 🎭 Enum vs Tabla de Roles

Se optó por **una tabla de roles y permisos** (usando el paquete [Spatie Laravel-Permission](https://spatie.be/docs/laravel-permission)) en lugar de usar `enum` por las siguientes razones:

- ✅ Permite gestionar roles y permisos desde la base de datos sin modificar el código.
- ✅ Facilita la asignación dinámica de roles y permisos a usuarios.
- ✅ Soporta relaciones de muchos a muchos (`users ↔ roles`, `roles ↔ permissions`).
- ❌ Usar `enum` limitaría la flexibilidad y dificultaría la administración desde interfaces o seeds.

### 🛡️ Middleware vs Paquete de Autorización

Se eligió utilizar el paquete **Spatie Permission** en lugar de escribir middlewares personalizados por estas razones:

- ✅ Permite usar middlewares como `role` y `permission` ya predefinidos (`->middleware('role:admin')`, etc.).
- ✅ Incluye helpers como `hasRole()`, `can()`, `hasPermissionTo()`, que simplifican el control de acceso en controladores y policies.
- ✅ Se integra bien con Laravel Sanctum y el sistema de autenticación nativo.

> Aún así, es posible crear middlewares personalizados si se requiere una lógica más específica o basada en negocio.

### 🗃️ Cambios al esquema de Base de Datos

Se hicieron los siguientes ajustes respecto al esquema base de Laravel:

- Se agregaron las tablas necesarias para roles y permisos (`roles`, `permissions`, `model_has_roles`, etc.) vía migraciones de Spatie.
- Se creó un **seeder de roles y permisos** para poblar roles iniciales (`admin`, `user`, etc.).
- Se creó un **usuario administrador** por defecto (`admin@gmail.com`, contraseña `123456789`) con todos los permisos asignados desde el seeder.

### 🧹 Uso de SoftDeletes

Se implementó `SoftDeletes` en modelos clave para evitar la eliminación definitiva de registros por las siguientes razones:

- ✅ Permite conservar historial de datos eliminados (útil para auditoría o restauración).
- ✅ Evita problemas de integridad referencial en relaciones con otras tablas.
- ✅ Mejora la experiencia de administración y soporte, permitiendo "recuperar" registros eliminados por error.


### 🌐 Cambios a Endpoints

- Se incorporó un **servicio de login** basado en Laravel Sanctum para emitir tokens personales.
- Las respuestas de errores y excepciones fueron estandarizadas a **formato JSON**, incluyendo los errores capturados desde middlewares.
- La API sigue una arquitectura RESTful clara y modular, orientada a escalabilidad futura.


## 🌍 API Desplegada

La API está disponible públicamente en la siguiente URL:

🔗 [https://api-inventario.alvgoninnovations.com/](https://api-inventario.alvgoninnovations.com/)

Puedes usar esta URL base para consumir los endpoints desde Postman, frontend u otras integraciones.