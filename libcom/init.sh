composer install
composer update
npm install
npm run production
php artisan migrate:fresh
php artisan world:init
php artisan db:seed
php artisan storage:link
php artisan vendor:publish --force --provider="Spatie\Permission\PermissionServiceProvider"
php artisan vendor:publish --force --provider="Khsing\World\WorldServiceProvider"
composer dump-autoload
