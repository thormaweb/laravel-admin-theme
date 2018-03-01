<?php

namespace iVirtual\AdminTheme\Console\Commands;

use Illuminate\Console\Command;

class SetupCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'admin-theme:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup migration and models for Admin Theme';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->confirm('We only recommend installing Admin Theme in a fresh laravel project. Is this a brand new project?')) {
            $this->line(PHP_EOL . 'Publishing Admin Theme assets, migrations and config files...');
            $this->call('vendor:publish', ['--provider' => 'iVirtual\AdminTheme\AdminThemeServiceProvider',]);

            $admin_path = $this->ask('What will be the admin path? (e.g. if you want to acces from yoursite.com/admin input just "admin")');

            $this->line(PHP_EOL . 'You choose: ' . $admin_path);

            $this->line(PHP_EOL . 'Adding AdminThemeUserTrait to User model');
            $this->call('admin-theme:add-user-trait');

            $this->line(PHP_EOL . 'Publishing Permissions migrations and config file');
            $this->call('vendor:publish', ['--provider' => 'Spatie\Permission\PermissionServiceProvider',]);

            $this->line(PHP_EOL . 'Publishing Media Library migrations and config file');
            $this->call('vendor:publish', ['--provider' => 'Spatie\MediaLibrary\MediaLibraryServiceProvider']);
        } else {
            $this->line(PHP_EOL . 'You can still use this package but require a custome installation process. Please refere to documentation!');
        }

    }
}
