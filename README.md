
- **PHP >= 8.1** (habilitar las siguientes extenciones: `BCMath`, `Ctype`, `Fileinfo`, `JSON`, `Mbstring`, `OpenSSL`, `PDO`, `Tokenizer`, `XML`)

### 1. Instalar dependencias
```bash
composer install
npm install
npm audit fix
npm run build
npm run dev
php artisan key:generate
```

## Configuración
### 1. Migraciones
```bash
php artisan migrate
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
php artisan db:seed
php artisan db:seed --class=Seeder
php artisan make:filament-resource NameModel --generate
```