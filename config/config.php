<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Logo & favicon
    |--------------------------------------------------------------------------
    |
    | Address settings of logo and favicon files for the website
    |
    */

    "logo" => env("GLOBAL_VARIABLE_LOGO", ''),
    "favicon" => env("GLOBAL_VARIABLE_FAVICON", ''),

    /*
    |--------------------------------------------------------------------------
    | Cache Time
    |--------------------------------------------------------------------------
    |
    | Data caching time in seconds
    |
    */

    'cache_time' => env("GLOBAL_VARIABLE_CACHE_TIME", 0),

    /*
    |--------------------------------------------------------------------------
    | PWA parameters
    |--------------------------------------------------------------------------
    |
    | PWA settings for manifest.json file data
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

    /*
    |--------------------------------------------------------------------------
    | Default Template Name
    |--------------------------------------------------------------------------
    |
    | Here you can specify which of the templates you want
    | to consider as the default for the website.
    |
    */

    'template' => env('GLOBAL_VARIABLE_TEMPLATE', 'default'),

    /*
    |--------------------------------------------------------------------------
    | Title mode
    |--------------------------------------------------------------------------
    |
    | Here you can choose how to display the title of the page
    | header, you can use the following modes in it.
    |
    | default: base | title
    | base: base
    | title: title
    |
    */

    'title_mode' => env('GLOBAL_VARIABLE_TITLE_MODE', 'default'),

];
