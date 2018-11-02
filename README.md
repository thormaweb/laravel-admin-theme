# [iVirtual.la](https://ivirtual.la) Laravel Admin Theme

Laravel Material Design Admin dashboard with out of the box Users permissions and tons of Blade components and helpers for scaffolding new projects.

// TODO: intro video

## Thanks to:
To [Propeller](https://github.com/digicorp/propeller) because we use his CSS Admin Theme (v1.2), and to [Spatie](https://github.com/spatie) for the amazing laravel packages (we use Permissions and Media Library)

## Index

* [Installation](#installation)
* [Configuration](#configuration)
    * [Theme Setup](#theme-setup)
    * [Project Setup](#project-setup)
* [Daily Usage](#daily-usage)
    * [Blade Components](#blade-components)

## Installation

Installing iVirtual Admin Theme is easy if you install this package from zero (if you are in a fresh new Laravel installation). If you are willing to use this powerfull package in an existing project, it's not that hard to implement but you have to skyp this automatic installation proces because is only usefull in a new projects. Go to the [manual installation section](#manual-installation) for the exact steps.

### Get the package trougth composer

Run this composer command in you shell.
```shell
composer require ivirtual-la/laravel-admin-theme
```

Run the Admin Theme install command and follow the instructions.
```shell
php artisan admin-theme:install
```

## Configuration

It's mandatory that you set the default filesystem in `config/filesystems.php` since Media Library package use the default Public Disk in laravel filesystem config. Of course you can customize that:
[https://docs.spatie.be/laravel-medialibrary/v6/installation-setup](https://docs.spatie.be/laravel-medialibrary/v6/installation-setup)

If you are not sure on how to config this, refer to Laravel documentation to properly configure the Public Disk [https://laravel.com/docs/5.5/filesystem#the-public-disk](https://laravel.com/docs/5.5/filesystem#the-public-disk)

### Theme Setup

### Project Setup

## Daily Usage

### Blade Components

#### Master View
After publishing the views it would be a `/resources/views/layouts/admin_theme.blade.php` file.
That file is the master you should extend your views from.

**/resources/views/layouts/admin_theme.blade.php file:**
```php
@extends('admin-theme::layouts.admin')

@adminThemeMenu

    // The menu goes here.

    @include('admin-theme::user.menu')

    // Or here

@endAdminThemeMenu

@adminThemeContent

    // Any content that must be always render.

    // The content of the pages.
    @yield('content')

@endAdminThemeContent

```
#### Blade Components

**TODO**

---

## Manual Installation

### First require the package

Run composer this composer command in you shell.
```shell
composer require ivirtual-la/laravel-admin-theme
```

### Publish

Now you first need to publish the package files, this include the config file, the public files for the theme a Seeder and some views

```shell
$ php artisan vendor:publish --provider="iVirtual\AdminTheme\AdminThemeServiceProvider"
```

We use `spatie/laravel-permissions` package so you need to get the migrations table and the config file.

```shell
$ php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

If you want to customice the roles and permission tables, or if your User model use UUID check out the `spatie/laravel-permission` documentation [https://github.com/spatie/laravel-permission](https://github.com/spatie/laravel-permission)

We olso use the `spatie/laravel-medialibrary`. Again, you need the migrations table and config file.

```shell
$ php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider"
```

### Tweak some files

#### User model

Your User model needs to implements `HasMedia` interface and use `AdminThemeUserTrait` trait:
```php
<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use iVirtual\AdminTheme\Traits\AdminThemeUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasMedia
{
    use Notifiable, AdminThemeUserTrait;
...
```

It's mandatory that you set the default filesystem in `config/filesystems.php` since Media Library package use the default Public Disk in laravel filesystem config. Of course you can customize that:
[https://docs.spatie.be/laravel-medialibrary/v6/installation-setup](https://docs.spatie.be/laravel-medialibrary/v6/installation-setup)

If you are not sure on how to config this, refer to Laravel documentation to properly configure the Public Disk [https://laravel.com/docs/5.5/filesystem#the-public-disk](https://laravel.com/docs/5.5/filesystem#the-public-disk)

#### Database seeder

Update in the `database/seeds/DataBaseSeeder.php` file.

```php
public function run()
{

    // Call the Admin Theme seeder.
    $this->call(AdminThemeSeeder::class);

}
```

Run the following commands.

```shell
// Migrate the databases.
$ php artisan migrate

// Run the Admin Theme seeder. But first dump-autoload
composer dump-autoload
$ php artisan db:seed --class=AdminThemeSeeder

```

#### AppServiceProvider (install admin theme Routes)

The routes are not loaded by default.

If you want to use the package routes you need to call them in the `app/Http/Providers/AppServiceProvider.php` file.

The routes prefix are loaded from the config file.

```php
use iVirtual\AdminTheme\AdminTheme;

class AppServiceProvider extends ServiceProvider
{

    // ...

    public function register()
    {

        // Call the Admin Theme routes.
        AdminTheme::routes();

    }
}
```

The routes method accept one parameters.

The parameter is a callback to call only the routes you want.

Example:

```php
AdminTheme::routes(function($router) {

    // Load all the routes. By default the router call this method.
    $router->all();

	// Load the dashboard routes.
	$this->adminRoutes();

    // Load the authentication views.
    $this->authRoutes();

    // Load the routes for manage users CRUD and role asigment
    $this->usersRoutes();

});
```

#### Auth files to proper redirect

In the `app/Controllers/Auth/LoginController.php` file,
the `app/Controllers/Auth/RegisterController.php` file and
the `app/Controllers/Auth/ResetPasswordController.php` file update the redirect path:

```php
// The panel_path path.
protected $redirectTo = '/admin';
```

And for last in the `app/Middleware/RedirectIfAuthenticated.php` file.

```php
public function handle($request, Closure $next, $guard = null)
    {

        if (Auth::guard($guard)->check()) {
            // Redirect if the user is not logged in to the login route.
            return redirect()->route('ivi_admin_theme_dashboard');
        }

        return $next($request);
    }
``` 

### Add spatie middlewares

In the `app\Http\Kernel.php` file add the followin middlewares to the `$routeMiddleware` array:

```php
        'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class,
        'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
```        
