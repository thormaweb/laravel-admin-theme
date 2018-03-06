<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Admin Panel URI
    |--------------------------------------------------------------------------
    |
    | Here you can define a new URI for prefixing all your panels urls.
    | Modify this if you don't want to use the default /admin route.
    | Tip: think what is easiest to remember for your main users.
    */
    'path' => [

        'panel' => 'your-admin-path', // This is your main admin dashboard URI

        'login' => 'login',
        'logout' => 'logout',
        'register' => 'register',
        'profile' => 'profile',
        'password_reset' => 'password/reset',
        'password_email' => 'password/email',

        'user' => 'users', // This is base URI in dashboard for manage the users CRUD
        'create' => 'create',
        'view' => 'view',
        'update' => 'update',
        'delete' => 'delete'

    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Master Layout
    |--------------------------------------------------------------------------
    |
    | Here you can define a new master layout for your panel.
    | Modify this if you don't want to use the default layouts.admin_theme path.
    */
    'master_layout' => 'layouts.admin_theme',

    /*
    |--------------------------------------------------------------------------
    | Panel Client Logo Path
    |--------------------------------------------------------------------------
    |
    | Set here the path to your client/project logo file
    | The logo file should have a size of 512px x 512px
    */
    'logo' => '/vendor/ivirtual/admin-theme/images/logo.png',

    /*
    |--------------------------------------------------------------------------
    | User Default Avatar Path
    |--------------------------------------------------------------------------
    |
    | Set here the path for the default avatar file, before the user choose his own
    | The file should have a size of 250 x 250
    */
    'avatar' => '/vendor/ivirtual/admin-theme/images/avatar.png',

    'date_formats' => [

        // Moment library js
        'moment' => 'YYYY-M-D h:mm:ss ',

        // date_parse_from_format function
        'laravel' => 'Y-j-n G:i:s',

        'carbon' => 'Y-d-m H:i:s'

    ],

    /*
    |--------------------------------------------------------------------------
    | Default Color's
    |--------------------------------------------------------------------------
    |
    | Here you can override the default colors for the Admin Theme
    */

    'colors' => [

        'primary' => '',

        'primary_fonts' => '',

        'secondary' => '',

        'secondary_fonts' => '',

        'shadow' => ''

	],

    /*
    |--------------------------------------------------------------------------
    | Extras
    |--------------------------------------------------------------------------
    |
    | Other configurations
	*/

	'phone' => '4545-4545', // Phone and email in the footer of the dashboard
	'email' => 'your@app.com',
];
