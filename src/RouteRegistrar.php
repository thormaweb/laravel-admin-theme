<?php

namespace iVirtual\AdminTheme;

use Illuminate\Contracts\Routing\Registrar as Router;

class RouteRegistrar
{
    /**
     * The router implementation.
     *
     * @var Router
     */
    protected $router;

    /**
     * Create a new route registrar instance.
     *
     * @param  Router  $router
     * @return void
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * Register routes for transient tokens, clients, and personal access tokens.
     *
     * @return void
     */
    public function all()
    {

        $this->forLogin();

        $this->forAuth();

        $this->forAdmin();

        $this->forUsers();

    }

    /**
     * Register the routes needed for the Categories.
     *
     * @return void
     */
    public function forLogin()
    {

        $this->router->group([

            'middleware' => [

                'web',

                'guest'

            ],

            'namespace' => '\iVirtual\AdminTheme\Http\Controllers'

        ], function ($router) {

            $router->get(config('admin-theme.path.login'), [
                'uses' => 'AdminController@login',
            ])
                ->name('login');

            $router->get(config('admin-theme.path.login'), [
                'uses' => 'AdminController@login',
            ])
                ->name('login');


            $router->get(config('admin-theme.path.password_email'), [
                'uses' => 'AdminController@passwordEmail'
            ])
                ->name('ivi_admin_theme_password_email');

            $router->post(config('admin-theme.path.password_email'), [
                'uses' => '\App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail'
            ]);

            $router->get(config('admin-theme.path.password_reset'), [
                'uses' => 'AdminController@passwordReset'
            ])
                ->name('ivi_admin_theme_password_reset');

            $router->post(config('admin-theme.path.password_reset'), [
                'uses' => '\App\Http\Controllers\Auth\ResetPasswordController@reset'
            ]);

        });
    }

    /**
     * Register the routes needed for the Posts.
     *
     * @return void
     */
    public function forAuth()
    {

        $this->router->group([

            'namespace' => 'App\Http\Controllers\Auth',

            'middleware' => [

                'web'

            ]

        ], function ($router) {

            $router->get(config('admin-theme.path.logout'), [
                'uses' => 'LoginController@logout',
            ])
                ->name('logout');


            $router->post(config('admin-theme.path.login'), [
                'uses' => 'LoginController@login',
            ])
                ->middleware('guest');

        });
    }

    /**
     * Register the routes needed for the Tags.
     *
     * @return void
     */
    public function forAdmin()
    {

        $this->router->group([

            'prefix' => config('admin-theme.path.panel'),

            'middleware' => [

                'web',

                'auth'

            ],

            'namespace' => '\iVirtual\AdminTheme\Http\Controllers'

        ], function ($router) {

            $router->get('', [
                'uses' => 'AdminController@dashboard',
            ])
                ->name('ivi_admin_theme_dashboard');


            $router->get(config('admin-theme.path.profile'), [
                'uses' => 'AdminController@profile',
            ])
                ->name('profile');


            $router->patch(config('admin-theme.path.profile'), [
                'uses' => 'AdminController@updateProfile',
            ]);

        });
    }

    public function forUsers()
    {

        $this->router->group([

            'prefix' => config('admin-theme.path.panel') . '/' . config('admin-theme.path.user'),

            'middleware' => [

                'web',

                'auth',

                'permission:users-*'

            ],

            'namespace' => '\iVirtual\AdminTheme\Http\Controllers'

        ], function ($router) {


            $router->get('/', [
                'uses' => 'UserController@index',
            ])
                ->name('ivi_admin_theme_user_index');

            $router->group([

                'middleware' => ['permission:users-create']

            ], function ($router ) {

                $router->get('/' . config('admin-theme.path.create'), [
                    'uses' => 'UserController@create',
                ])
                    ->name('ivi_admin_theme_user_create');

                $router->post('/' . config('admin-theme.path.create'), [
                    'uses' => 'UserController@store',
                ]);
            });

            $router->group([

                'middleware' => ['permission:users-update']

            ], function ($router ) {

                $router->get('/{id}/' . config('admin-theme.path.edit'), [
                    'uses' => 'UserController@edit',
                ])
                    ->name('ivi_admin_theme_user_edit')
                    ->where('id', '[0-9]+');

                $router->patch('/{id}/' . config('admin-theme.path.edit'), [
                    'uses' => 'UserController@update',
                ])
                    ->where('id', '[0-9]+');

            });

            $router->group([

                'middleware' => ['permission:users-delete']

            ], function ($router ) {

                $router->get('/{id}/' . config('admin-theme.path.delete'), [
                    'uses' => 'UserController@delete',
                ])
                    ->name('ivi_admin_theme_user_delete')
                    ->where('id', '[0-9]+');

            });
        });
    }
}
