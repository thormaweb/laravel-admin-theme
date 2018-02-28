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
     * Commands to call with their description
     *
     * @var array
     */
    protected $calls = [
        'admin-theme:add-user-trait' => 'Adding AdminThemeUserTrait to User model',
        'php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="config"' => 'Publish Media Library config file.',
        'php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="config"' => 'Publish Permissions config file.'
    ];

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->calls as $command => $info) {
            $this->line(PHP_EOL . $info);
            $this->call($command);
        }
    }
}
