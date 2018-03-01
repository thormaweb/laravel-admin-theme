<?php

namespace iVirtual\AdminTheme\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class AmendFilesCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'admin-theme:amend-files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Amend Laravel core files to work with Admin Theme';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        (new Filesystem)->delete(
            [
                base_path('app/User.php'),
                base_path('app/OtroModel.php')
            ]
        );
        copy(
            __DIR__ . '/stubs/User.php',
            base_path('app/User.php')
        );

        $this->info("AdminThemeUserTrait added successfully to User class");
    }
}
