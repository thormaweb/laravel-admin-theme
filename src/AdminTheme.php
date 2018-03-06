<?php

namespace iVirtual\AdminTheme;

use Illuminate\Support\Facades\Route;

class AdminTheme
{
    /**
     * Get a AdminTheme route registrar.
     *
     * @param  $callback
     * @return void
     */
    public static function routes($callback = null)
    {
        $callback = $callback ?: function ($router) {
            $router->all();
        };

        Route::group([], function ($router) use ($callback) {
            $callback(new RouteRegistrar($router));
        });
    }

    /**
     * Generate list of options for the select component.
     *
     * @param $options
     * @param string $key
     * @param string $value
     * @return array
     */
    public static function generateSelectOptions($options, $key = 'id', $value = 'value')
    {
        $array = [];

        foreach ($options as $option) {

            $array = array_add($array, $option->{$key}, $option->{$value});
        }

        return $array;
    }
}
