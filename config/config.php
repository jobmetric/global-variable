<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Logo & favicon
    |--------------------------------------------------------------------------
    |
    | logo and favicon asset path
    |
    */

    "logo" => env("GLOBAL_VARIABLE_LOGO", ''),
    "favicon" => env("GLOBAL_VARIABLE_FAVICON", ''),

    /*
    |--------------------------------------------------------------------------
    | PWA parameters
    |--------------------------------------------------------------------------
    |
    | pwa parameters for website
    |
    */

    'pwa' => [
        "theme_color" => env("GLOBAL_VARIABLE_THEME_COLOR", '#fff'),
        "background_color" => env("GLOBAL_VARIABLE_BACKGROUND_COLOR", '#fff'),
        "display" => env("GLOBAL_VARIABLE_DISPLAY", 'standalone'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Datatable
    |--------------------------------------------------------------------------
    |
    | All datatable plugin settings
    |
    */

    "page_limit" => env("GLOBAL_VARIABLE_PAGE_LIMIT", 10),

];
