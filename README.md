## Requisitos previos
- **PHP >= 8.1** (con las siguientes extensiones habilitadas: `BCMath`, `Ctype`, `Fileinfo`, `JSON`, `Mbstring`, `OpenSSL`, `PDO`, `Tokenizer`, `XML`)
- **Composer** (para gestionar dependencias de PHP)
- **MySQL/MariaDB/PostgreSQL** (o cualquier otro sistema de gestión de bases de datos compatible)
- **Servidor Web** (Apache, Nginx, etc.)
- **Node.js** y **npm/yarn** (para gestionar paquetes de frontend si se usan)

## Instalación
### 1. Instalar dependencias
Instala las dependencias necesarias para el proyecto:
```bash
composer install
npm install
npm audit fix
npm run build
npm run dev
cp .env.example .env
php artisan key:generate

```
## Configuración
### 1. Corre las migraciones
```bash
php artisan migrate
```
### 2. Crea la cuenta de administrador de FilamentPHP
```bash
php artisan hexa:account --create

```
### 2. Comandos para optimizar el proyecto
```bash
composer dump-autoload -o
php artisan optimize
php artisan icons:cache
php artisan config:clear
php artisan route:clear
php artisan cache:clear
php artisan view:clear
```
### Comandos dentro del proyecto
```bash
php artisan make:custom-filament-user "admin" "surnames" "phone" "admin@gmail.com" "admin123"
php artisan db:seed
php artisan db:seed --class=Seeder
php artisan make:filament-resource NameModel --generate
```