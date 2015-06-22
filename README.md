# Laravel AdminAuth

## Installation

1. Open `config/app.php` and find the `providers` key. Add `AdminAuthServiceProvider` to the array.
```php
	...
	Condoriano\AdminAuth\Providers\AdminAuthServiceProvider::class,
	...
```
2. Publish assets and config files.
```
php artisan vendor:publish --provider="Condoriano\AdminAuth\AdminAuthServiceProvider"
```

3. Run migrations
```
php artisan migrate
```

4. Open `config/auth.php` and add option `admin_model` to tell which Eloquent model will be used
```
'admin_model' => \App\Models\AdminUser::class,
```

## Использование

Для авторизации используются роуты:
* GET admin/login
* POST admin/login
* GET admin/logout


