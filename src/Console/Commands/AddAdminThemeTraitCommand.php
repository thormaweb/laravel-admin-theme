<?php

namespace iVirtual\AdminTheme\Console\Commands;

use Traitor\Traitor;
use Illuminate\Console\Command;
use iVirtual\AdminTheme\Traits\AdminThemeUserTrait;

class AddAdminThemeUserTraitCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'admin-theme:add-user-trait';

    /**
     * Trait added to User model
     *
     * @var string
     */
    protected $targetTrait = AdminThemeUserTrait::class;

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {

        if (!class_exists('App\User')) {
            $this->error("Class App\User does not exist.");
            return;
        }

        if ($this->alreadyUsesAdminThemeUserTrait('App\User')) {
            $this->error("Class App\User already uses AdminThemeUserTrait.");
        }

        Traitor::addTrait($this->targetTrait)->toClass('App\User');

        $this->info("AdminThemeUserTrait added successfully to User class");
    }

    /**
     * @param  string $model
     * @return bool
     */
    protected function alreadyUsesAdminThemeUserTrait($model)
    {
        return in_array(AdminThemeUserTrait::class, class_uses($model));
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return "Add AdminThemeUserTrait to User class";
    }
}
