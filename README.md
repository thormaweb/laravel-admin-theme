# [iVirtual.la](https://ivirtual.la) Laravel Admin Theme

Material Design Admin dashboard with out of the box Users permissions for scaffolding new projects.

## Thanks to:
Propeler CSS Admin Theme (v1.2)

* [Installation](#installation)
    * [Install](#install)
    * [Publish](#publish)
* [Configuration](#configuration)
    * [Database](#database)
    * [Routes](#routes)
* [Usage](#usage)
    * [Blade](#blade)

## Installation

### Install

Run the following commands to install the package.
```shell
composer require iVirtual-la/laravel-admin-theme
```

### Publish

If you want to customice the roles and permission tables, or if your User model use UUID check out the `spatie/laravel-permission` documentation [https://github.com/spatie/laravel-permission](https://github.com/spatie/laravel-permission)

**Run the following commands:**

```shell
// Publish iVirtual Admin Theme Service Provider.
$ php artisan vendor:publish --provider="iVirtual\AdminTheme\AdminThemeServiceProvider"
```
Possible tags for the `vendor:publish` command:

- config
- migrations
- seeds
- views
- lang
- public

## Configuration

Run the setup of the admin theme.
```shell
// Run the iVirtual Admin Theme setup.
$ php artisan admin-theme:setup
```

### Database

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

### Routes

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

    // Load the login view route.
    $this->forLogin();

    // Load the login & logout functions routes.
    $this->forAuth();

    // Load the dashboard routes.
    $this->forAdmin();
});
```

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

## Usage

### Blade

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

#### User password forget function
We use the default laravel sent forget link, but with custome views.
The only thing you need to do is override one named router to redirect our controller.
```
// Override password reset
Route::get(config('admin-theme.path.panel') . config('admin-theme.path.password_reset'), function () {
   return redirect()->route('ivi_admin_theme_password_reset', ['token' => array_keys(request()->query())[0]]);
})->name('password.reset');
```

Then if you don't like laravel default email check the customization page here:
https://laravel.com/docs/5.5/passwords#password-customization
