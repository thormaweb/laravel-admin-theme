# iVirtual.la Laravel Admin Theme

Material Design Admin dashboard and Users roles for scaffolding new projects.

## Thanks to:
Propeler css admin theme (v1.1)

* [Prerequisites](#markdown-header-prerequisites)
* [Installation](#markdown-header-installation)
    * [Install](#markdown-header-install)
    * [Publish](#markdown-header-publish)
* [Configuration](#markdown-header-configuration)
    * [Database](#markdown-header-database)
    * [Routes](#markdown-header-routes)
* [Usage](#markdown-header-usage)
    * [Blade](#markdown-header-blade)

## Prerequisites

- [Images](https://bitbucket.org/ivirtual-la/images-package)

## Installation

### Install
Add in the `composer.json` file the packagist resositories.

```json
"repositories": [
        { "type": "git", "url": "https://ivirtual-la@bitbucket.org/ivirtual-la/images-package.git" },
        { "type": "git", "url": "https://ivirtual-la@bitbucket.org/ivirtual-la/admin-theme-package.git" },
    ]
```

Run the following commands to install the package.
```shell
// Install the blog.
$ composer require "ivirtual/admin-theme:0.*"
```

### Publish

Update `config/app.php` by adding an entry for the service provider.
```php
'providers' => [

    // iVirtual Admin Theme Service Provider.
    iVirtual\AdminTheme\AdminThemeServiceProvider::class,

    // Laratrust Service provider if not set yet.
    Laratrust\LaratrustServiceProvider::class,

],

'aliases' => [

    // Laratrust alias.
    'Laratrust'   => Laratrust\LaratrustFacade::class,

]
```

Update `app/Http/Kernel.php` by adding the Laratrust Middlewares.
```php
protected $routeMiddleware = [

    // Laratrust middlewares.
    'role' => \Laratrust\Middleware\LaratrustRole::class,
    'permission' => \Laratrust\Middleware\LaratrustPermission::class,
    'ability' => \Laratrust\Middleware\LaratrustAbility::class,

];

```

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

**First, go to the `App\User` model and implement the abstract method for the full name attribute.**
```
public function getFullName()
{
   return $this->name;
}
```

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
