<?php

namespace iVirtual\AdminTheme;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use iVirtual\AdminTheme\Console\Commands\SetupCommand;
use iVirtual\AdminTheme\Console\Commands\AmendFilesCommand;

class AdminThemeServiceProvider extends ServiceProvider
{

    /**
     * The commands to be registered.
     *
     * @var array
     */
    protected $commands = [
        'Setup' => 'command.admin-theme.setup',
        'AmendFiles' => 'command.admin-theme.amend-files'
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        if ($this->app->runningInConsole()) {

            $this->publishConfiguration();

            $this->publishMigrations();

            $this->publishSeeders();

            $this->publishResources();

        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'admin-theme');

        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'admin-theme');

        $this->registerViewComposers();

        if (class_exists('\Blade')) {
            $this->registerBladeDirectives();
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind('ivirtual-admin-theme', function () {
            return new AdminTheme();
        });

        $this->registerCommands();

        $this->mergeConfig();
    }

    /**
     * Publish the Admin Theme config file.
     *
     * @return void
     */
    public function publishConfiguration()
    {
        $this->publishes([
            __DIR__ . '/../config' => config_path(),
        ], 'config');
    }

    /**
     * Publish the Admin Theme migration files.
     *
     * @return void
     */
    public function publishMigrations()
    {
//        $this->publishes([
//            __DIR__.'/../database/migrations' => database_path('migrations'),
//        ], 'migrations');
    }

    /**
     * Publish the Admin Theme Seeders.
     *
     * @return void
     */
    public function publishSeeders()
    {
        $this->publishes([
            __DIR__ . '/../database/seeds' => database_path('seeds'),
        ], 'seeds');
    }

    /**
     * Publish the resources files.
     *
     * @return void
     */
    public function publishResources()
    {
        $this->publishes([
            __DIR__ . '/../resources/views/layouts/admin_theme.blade.php' => resource_path('views/layouts/admin_theme.blade.php'),
        ], 'views');

        $this->publishes([
            __DIR__ . '/../resources/views/user' => resource_path('views/vendor/admin-theme/user'),
        ], 'views');

        $this->publishes([
            __DIR__ . '/../resources/lang' => resource_path('lang/admin-theme'),
        ], 'lang');

        $this->publishes([
            __DIR__ . '/../public/' => public_path('vendor/ivirtual/admin-theme/'),
        ], 'public');
    }

    /**
     * Register the view composers.
     *
     * @return void
     */
    public function registerViewComposers()
    {
        View::composer([
            'admin-theme::layouts.admin',
            'admin-theme::profile'
        ], 'iVirtual\AdminTheme\ViewComposers\AdminViewComposer');
    }

    /**
     * Register the blade directives.
     *
     * @return void
     */
    public function registerBladeDirectives()
    {
        (new AdminThemeRegisterBladeDirectives())->handle();
    }

    /**
     * Register the given commands.
     *
     * @return void
     */
    protected function registerCommands()
    {
        foreach (array_keys($this->commands) as $command) {
            $method = "register{$command}Command";

            call_user_func_array([$this, $method], []);
        }

        $this->commands(array_values($this->commands));
    }

    protected function registerSetupCommand()
    {
        $this->app->singleton('command.admin-theme.setup', function () {
            return new SetupCommand();
        });
    }

    protected function registerAmendFilesCommand()
    {
        $this->app->singleton('command.admin-theme.amend-files', function () {
            return new AmendFilesCommand();
        });
    }

    /**
     * Merges user's and admin theme's configs.
     *
     * @return void
     */
    private function mergeConfig()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/admin-theme.php',
            'admin-theme'
        );
    }
}
