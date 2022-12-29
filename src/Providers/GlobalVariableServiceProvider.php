<?php

namespace JobMetric\GlobalVariable\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use JobMetric\GlobalVariable\GlobalVariableService;

class GlobalVariableServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'JobMetric\GlobalVariable\Http\Controller';

    public function register()
    {
        $this->app->bind('GlobalVariableService', function ($app) {
            return new GlobalVariableService;
        });
    }

    public function boot()
    {
        // publish config
        $this->publishes([realpath(__DIR__.'/../../config/config.php') => config_path('global-variable.php')], 'config');

        // publish assets
        $this->publishes([realpath(__DIR__.'/../../assets') => public_path('vendor/global-variable')], 'public');

        // publish translations
        $this->loadTranslationsFrom(realpath(__DIR__.'/../../lang'), 'global-variable');

        // publish route
        Route::prefix('global')->name('global.')->namespace($this->namespace)->group(realpath(__DIR__ . '/../../routes/route.php'));
    }
}
