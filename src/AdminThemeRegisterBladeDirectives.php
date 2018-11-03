<?php

namespace iVirtual\AdminTheme;

use Illuminate\Support\Facades\Blade;

class AdminThemeRegisterBladeDirectives
{
    /**
     * Handles the registration of the blades directives
     *
     * @return void
     */
    public function handle()
    {

        $this->registerDirectives();

        $this->registerClosingDirectives();

    }

    /**
     * Registers the directives with parenthesis
     * @return void
     */
    protected function registerDirectives()
    {

        Blade::directive('extendAdminTheme', function ($expression) {
            return "<?php echo \$__env->make('admin-theme::layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>";
        });

        Blade::directive('adminTheme', function($expression)
        {
            return "<?php \$__env->startComponent('admin-theme::components." . substr($expression, 1) . ") ?>";
        });

        Blade::directive('adminThemeMenu', function($expression)
        {
            return "<?php \$__env->startSection('admin-theme-section-menu') ?>";
        });

        Blade::directive('adminThemeContent', function($expression)
        {
            return "<?php \$__env->startSection('admin-theme-section-content') ?>";
        });

        /**
         * Form helpers.
         */

        Blade::directive('adminThemeInput', function($expression) {
            return "<?php \$__env->startComponent('admin-theme::components.input', $expression); echo \$__env->renderComponent(); ?>";
        });

        Blade::directive('adminThemeInputImages', function($expression) {
            return "<?php \$__env->startComponent('admin-theme::components.input_images', $expression); echo \$__env->renderComponent(); ?>";
        });

        Blade::directive('adminThemeTextarea', function($expression) {
            return "<?php \$__env->startComponent('admin-theme::components.textarea', $expression); echo \$__env->renderComponent(); ?>";
        });

        Blade::directive('adminThemeSelect', function($expression) {
            return "<?php \$__env->startComponent('admin-theme::components.select', $expression); echo \$__env->renderComponent(); ?>";
        });

        Blade::directive('adminThemeToggleSwitch', function($expression) {
            return "<?php \$__env->startComponent('admin-theme::components.toggle_switch', $expression); echo \$__env->renderComponent(); ?>";
        });

        Blade::directive('adminThemeDate', function($expression) {
            return "<?php \$__env->startComponent('admin-theme::components.date', $expression); echo \$__env->renderComponent(); ?>";
        });

        Blade::directive('adminThemeButton', function($expression) {
            return "<?php \$__env->startComponent('admin-theme::components.button', $expression); echo \$__env->renderComponent(); ?>";
        });

        Blade::directive('adminThemeDeletePopup', function($expression) {
            return "<?php \$__env->startComponent('admin-theme::components.delete_popup', $expression); echo \$__env->renderComponent(); ?>";
        });
    }

    /**
     * Registers the closing directives
     * @return void
     */
    protected function registerClosingDirectives()
    {

        Blade::directive('endAdminTheme', function ($expression) {
            return "<?php echo \$__env->renderComponent(); ?>";
        });

        Blade::directive('endAdminThemeMenu', function ($expression) {
            return "<?php echo \$__env->stopSection(); ?>";
        });

        Blade::directive('endAdminThemeContent', function ($expression) {
            return "<?php echo \$__env->stopSection(); ?>";
        });
    }
}
