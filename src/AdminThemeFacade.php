<?php

namespace iVirtual\AdminTheme;

use Illuminate\Support\Facades\Facade;

class AdminThemeFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ivirtual-admin-theme';
    }
}