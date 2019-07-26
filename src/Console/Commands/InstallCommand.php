<?php

namespace ThormaWeb\AdminTheme\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Question\Question;

class InstallCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'admin-theme:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install process for Admin Theme';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info('>> Welcome to the Admin Theme installation process! <<');

        if ($this->confirm('We only recommend installing Admin Theme in a fresh laravel project. Is this a brand new project?')) {

            $this->createEnvFile();

            if (strlen(config('app.key')) === 0) {
                $this->call('key:generate');
                $this->line('~ Secret key properly generated.');
            }

            $this->line(PHP_EOL . '1) Publishing Admin Theme assets, migrations and config files...');
            $this->call('vendor:publish', ['--provider' => 'ThormaWeb\AdminTheme\AdminThemeServiceProvider',]);

            $this->line(PHP_EOL . '2) Publishing Permissions migrations and config file');
            $this->call('vendor:publish', ['--provider' => 'Spatie\Permission\PermissionServiceProvider',]);

            $this->line(PHP_EOL . '3) Publishing Media Library migrations and config file');
            $this->call('vendor:publish', ['--provider' => 'Spatie\MediaLibrary\MediaLibraryServiceProvider']);

            $this->line(PHP_EOL . '4) Amending some app core files to work with Admin Theme...');
            $this->call('admin-theme:amend-files');

            $this->info('>> Exelent! Every thing is ready. Now if you want we can configure your database. <<');


            if ($this->confirm('Do you want to config and migrate the database?', false)) {

                $credentials = $this->requestDatabaseCredentials();
                $this->updateEnvironmentFile($credentials);

                $this->migrateDatabaseWithFreshCredentials($credentials);
                $this->info('~ Database successfully migrated.');
                $this->info('~ Now please dump the composer autoload so the class AdminThemeSeeder can be found:');
                $this->line('composer dump-autoload');
                $this->info('~ Finally fill in your admin user credentials in that class at databse/AdminThemeSeeder.php, and run:');
                $this->line('php artisan db:seed');
            }

            $this->call('cache:clear');

            $this->info('>> The installation process is complete. Enjoy! <<');
        } else {
            $this->line(PHP_EOL . 'You can still use this package but require a custome installation process. Please refere to documentation!');
        }

    }

    /**
     * Create the initial .env file.
     */
    protected function createEnvFile()
    {
        if (! file_exists('.env')) {
            copy('.env.example', '.env');
            $this->line('.env file successfully created');
        }
    }

    /**
     * Update the .env file from an array of $key => $value pairs.
     *
     * @param  array $updatedValues
     * @return void
     */
    protected function updateEnvironmentFile($updatedValues)
    {
        $envFile = $this->laravel->environmentFilePath();
        foreach ($updatedValues as $key => $value) {
            file_put_contents($envFile, preg_replace(
                "/{$key}=(.*)/",
                "{$key}={$value}",
                file_get_contents($envFile)
            ));
        }
    }

    /**
     * Request the local database details from the user.
     *
     * @return array
     */
    protected function requestDatabaseCredentials()
    {
        return [
            'DB_DATABASE' => $this->ask('Database name'),
            'DB_PORT' => $this->ask('Database port', 3306),
            'DB_USERNAME' => $this->ask('Database user'),
            'DB_PASSWORD' => $this->askHiddenWithDefault('Database password (leave blank for no password)'),
        ];
    }

    /**
     * Migrate the db with the new credentials.
     *
     * @param array $credentials
     * @return void
     */
    protected function migrateDatabaseWithFreshCredentials($credentials)
    {
        foreach ($credentials as $key => $value) {
            $configKey = strtolower(str_replace('DB_', '', $key));
            if ($configKey === 'password' && $value == 'null') {
                config(["database.connections.mysql.{$configKey}" => '']);
                continue;
            }
            config(["database.connections.mysql.{$configKey}" => $value]);
        }
        $this->call('migrate:fresh');
    }
    /**
     * Prompt the user for optional input but hide the answer from the console.
     *
     * @param  string  $question
     * @param  bool    $fallback
     * @return string
     */
    public function askHiddenWithDefault($question, $fallback = true)
    {
        $question = new Question($question, 'null');
        $question->setHidden(true)->setHiddenFallback($fallback);
        return $this->output->askQuestion($question);
    }
}
