<?php

namespace ThormaWeb\AdminTheme;

use Illuminate\Support\Facades\Facade;

class AdminThemeFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'thormaweb-admin-theme';
    }
}