<?php

namespace iVirtual\AdminTheme\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\File;
use Symfony\Component\Finder\Finder;
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
	 * The Composer instance.
	 *
	 * @var \Illuminate\Support\Composer
	 */
	protected $composer;

	/**
	 * Amend laravel files
	 *
	 * @param  \Illuminate\Support\Composer  $composer
	 * @return void
	 */
	public function __construct(Composer $composer)
	{
		parent::__construct();
		$this->composer = $composer;
	}

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (!app()->isLocal()) {
            $this->alert('You can not run this command on a production enviroment!');
            return;
        }

        // Replace User
        File::delete(
            [
                base_path('app/User.php'),
                base_path('database/seeds/DatabaseSeeder.php'),
                base_path('app/Providers/AppServiceProvider.php'),
            ]
        );
        File::copy(__DIR__ . '/stubs/User.php', base_path('app/User.php'));
        File::copy(__DIR__ . '/stubs/DatabaseSeeder.php', base_path('database/seeds/DatabaseSeeder.php'));
        File::copy(__DIR__ . '/stubs/AppServiceProvider.php', base_path('app/Providers/AppServiceProvider.php'));

        // Replace /home path
        $admin_path = $this->ask('Now, what will be the admin path?' . PHP_EOL . '(e.g. if you want to acces from yoursite.com/admin just input "admin")');
        $admin_path = str_replace('/', '', $admin_path);

        $files = Finder::create()
            ->in(base_path('app'))
            ->name('*.php')
            ->contains('/home');

        foreach ($files as $file) {
            $contents = File::get($file->getRealPath());

            $updated = str_replace('/home', '/'.$admin_path, $contents);

            File::put($file->getRealPath(), $updated);
        }

        // Update config file
        $config = File::get(config_path('admin-theme.php'));
        $config = str_replace('your-admin-path', $admin_path, $config);
        File::put(config_path('admin-theme.php'), $config);

		$this->composer->dumpAutoloads();
        $this->info("App files were updated succsesfully!" . PHP_EOL);
    }
}
