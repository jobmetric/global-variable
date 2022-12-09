<?php

namespace JobMetric\GlobalVariable\Providers;

use Illuminate\Support\ServiceProvider;
use JobMetric\GlobalVariable\GlobalVariableService;

class GlobalVariableServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('GlobalVariableService', function ($app) {
            return new GlobalVariableService;
        });
    }
}
