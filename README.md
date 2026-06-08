# Instrumentos TFG – Bryan Vega Rondón

Aplicación Laravel 11 con persistencia MySQL para los tres instrumentos de recolección de datos del Trabajo Final de Graduación de la Licenciatura en Docencia (USM, 2026).

## Instrumentos incluidos

| # | Instrumento | Participantes | Tipo |
|---|-------------|---------------|------|
| 1 | Encuesta Likert sobre uso de IA en programación | Estudiantes | Cuantitativo |
| 2 | Guía de entrevista semiestructurada | Docentes | Cualitativo |
| 3 | Prueba diagnóstica de competencias en POO | Estudiantes | Cuantitativo |

## Panel de administración

Ruta: `/admin` — Permite:
- Ver todas las respuestas por instrumento
- Filtrar por fase (pre/post) o institución
- Ver el detalle completo de cada respuesta
- **Exportar a CSV** (compatible con Excel) para análisis estadístico

---

## Despliegue en Plesk (servidor compartido)

### Requisitos del servidor
- PHP ≥ 8.2 (con extensiones: `mbstring`, `openssl`, `pdo`, `pdo_mysql`, `tokenizer`, `xml`, `ctype`, `json`)
- MySQL ≥ 5.7
- Composer
- mod_rewrite habilitado (Apache)

### Paso 1 – Crear base de datos en Plesk

En Plesk → Bases de datos → Agregar base de datos:
- Nombre: `tfg_instrumentos`
- Usuario y contraseña (guárdalos para el `.env`)

### Paso 2 – Configurar el repositorio en GitHub

```bash
# En tu máquina local (ya tienes el repo inicializado)
git remote add origin https://github.com/TU_USUARIO/tfg-instrumentos.git
git push -u origin master
```

### Paso 3 – Clonar en el servidor Plesk

En Plesk → Git → Añadir repositorio, o vía SSH:

```bash
# Entra por SSH al servidor
cd /var/www/vhosts/tu-dominio.com/
git clone https://github.com/TU_USUARIO/tfg-instrumentos.git httpdocs
cd httpdocs
```

### Paso 4 – Instalar dependencias

```bash
composer install --no-dev --optimize-autoloader
```

### Paso 5 – Configurar el entorno

```bash
cp .env.example .env
nano .env   # o usa el editor de Plesk para editar el archivo
```

Edita estos valores en `.env`:

```env
APP_URL=https://tu-dominio.com
APP_KEY=   # se genera en el paso siguiente

DB_HOST=127.0.0.1
DB_DATABASE=tfg_instrumentos
DB_USERNAME=tu_usuario_bd
DB_PASSWORD=tu_password_bd

ADMIN_PASSWORD=EligeTuContraseñaSegura
```

### Paso 6 – Generar la clave de la app y migrar

```bash
php artisan key:generate
php artisan migrate
```

### Paso 7 – Permisos de directorios

```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
# En algunos hosts el usuario es apache o nobody en vez de www-data
```

### Paso 8 – Configurar el Document Root en Plesk

En Plesk → Sitios web → Configuración del hosting:
- **Document Root:** cambia de `httpdocs/` a `httpdocs/public/`

> Esto es **crítico**: Laravel sirve todo desde `public/`. Si el Document Root apunta a la raíz, la app no funcionará correctamente.

---

## Despliegue continuo desde GitHub (Plesk Git)

En Plesk → tu dominio → Git:
1. Conecta el repositorio de GitHub
2. Activa el webhook para deploy automático en cada `push`
3. En el script de deploy agrega:
```bash
composer install --no-dev --optimize-autoloader
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## URLs de la aplicación

| Ruta | Descripción |
|------|-------------|
| `/encuesta` | Instrumento 1 — Encuesta estudiantes |
| `/entrevista` | Instrumento 2 — Registro de entrevista docente |
| `/prueba` | Instrumento 3 — Prueba diagnóstica |
| `/admin` | Panel de administración (requiere contraseña) |
| `/admin/encuestas/export` | Exportar encuestas a CSV |
| `/admin/entrevistas/export` | Exportar entrevistas a CSV |
| `/admin/pruebas/export` | Exportar pruebas a CSV |

## Contraseña del panel admin

Definida en `.env` como `ADMIN_PASSWORD`. El valor por defecto en `.env.example` es `tfg2026admin` — **cámbialo antes de desplegar**.

---

## Estructura del proyecto

```
app/
  Http/
    Controllers/          ← Lógica de cada instrumento + Admin
    Middleware/           ← AdminAuth (protege el panel)
  Models/                 ← Encuesta, Entrevista, Prueba
config/
  admin.php               ← Lee ADMIN_PASSWORD del .env
database/migrations/      ← 3 migraciones (una por tabla)
resources/views/
  layouts/app.blade.php   ← Layout principal (diseño del HTML original)
  encuesta/               ← Formulario + confirmación
  entrevista/             ← Formulario + confirmación
  prueba/                 ← Formulario + confirmación
  admin/                  ← Panel: login, dashboard, listas, detalle
routes/web.php            ← Todas las rutas
```

---

*Aplicación desarrollada por Bryan Vega Rondón (2026) como soporte tecnológico para la recolección de datos del TFG.*
