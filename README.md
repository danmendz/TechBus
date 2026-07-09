
- **PHP >= 8.1** (habilitar las siguientes extenciones: 
`mbstring`,
`pdo_mysql`,
`mysqli`,
`php_pdo_sqlsrv_82_ts_x64.dll`,
`php_sqlsrv_82_ts_x64.dll`,
`gd`,
`fileinfo`,
`zip`,
`curl`,
`intl`)

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
Para produccion:
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
### Configuracion de roles
```bash

php artisan tinker
$user = User::find(1);
$user->assignRole('role');
$user->removeRole('role');
$user->syncRoles([]);
```