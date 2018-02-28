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
        $this->line(PHP_EOL . 'Adding AdminThemeUserTrait to User model');
        $this->call('admin-theme:add-user-trait');

        $this->line(PHP_EOL . 'Publishing Permissions migrations and config file');
        $this->call('vendor:publish', ['--provider' => 'Spatie\Permission\PermissionServiceProvider',]);

        $this->line(PHP_EOL . 'Publishing Media Library migrations and config file');
        $this->call('vendor:publish', ['--provider' => 'Spatie\MediaLibrary\MediaLibraryServiceProvider']);

    }
}
