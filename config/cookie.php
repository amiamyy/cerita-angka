<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Cookie Settings
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default cookie settings that will be used
    | by your application. These settings can be overridden for specific
    | cookies by using the "cookie" helper method when creating them.
    |
    */

    'path' => '/',

    'domain' => env('COOKIE_DOMAIN'),

    'secure' => env('COOKIE_SECURE'),

    'http_only' => true,

    'same_site' => 'lax',

    /*
    |--------------------------------------------------------------------------
    | Cookie Encryption
    |--------------------------------------------------------------------------
    |
    | By default, Laravel encrypts all cookies. However, you may configure
    | specific cookies to be exempt from encryption if needed.
    |
    */

    'except' => [

    ],

];