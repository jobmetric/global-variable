<?php

namespace JobMetric\GlobalVariable\Providers;

use Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use JobMetric\GlobalVariable\GlobalVariableService;
use JobMetric\GlobalVariable\Http\Middleware\SetConfig;
use JobMetric\GlobalVariable\Models\Setting;
use JobMetric\GlobalVariable\Object\Config;
use Illuminate\Support\Facades\Schema;
use GlobalVariable;

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

    /**
     * boot provider
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPublishables();

        // set translations
        $this->loadTranslationsFrom(realpath(__DIR__.'/../../lang'), 'global-variable');

        // set route
        Route::prefix('global')->name('global.')->namespace($this->namespace)->group(realpath(__DIR__.'/../../routes/route.php'));

        $this->setSetting();
    }

    /**
     * Register publishables
     *
     * @return void
     */
    private function registerPublishables(): void
    {
        // publish config
        $this->publishes([
            realpath(__DIR__.'/../../config/config.php') => config_path('global-variable.php')
        ], 'config');

        // publish assets
        $this->publishes([
            realpath(__DIR__.'/../../assets') => public_path('vendor/global-variable')
        ], 'public');

        // publish views
        $this->publishes([
            realpath(__DIR__.'/../../resources/views') => resource_path('views/vendor/global-variable')
        ], 'views');

        // publish migration
        if (!$this->migrationExists('create_settings_table')) {
            $this->publishes([
                realpath(__DIR__.'/../../database/migrations/create_settings_table.php.stub') => database_path('migrations/'.date('Y_m_d_His', time()).'_create_settings_table.php')
            ], 'migrations');
        }
    }

    /**
     * set all setting in config object
     *
     * @return void
     */
    private function setSetting(): void
    {
        $settings = Cache::remember('global-setting', config('global-variable.cache_time'), function () {
            $data = [];
            if(Schema::hasTable((new Setting)->getTable())) {
                $results = Setting::all();

                foreach ($results as $setting) {
                    /**
                     * @var $setting Setting
                     */

                    if ($setting->is_json) {
                        $data[$setting->code.'_'.$setting->key] = json_decode($setting->value, true);
                    } else {
                        $data[$setting->code.'_'.$setting->key] = $setting->value;
                    }
                }
            }

            return $data;
        });

        GlobalVariable::configuration()->setAll($settings);
    }

    private function migrationExists($migration)
    {
        $path = database_path('migrations/');
        $files = scandir($path);

        $position = false;
        foreach ($files as &$value) {
            $position = strpos($value, $migration);
            if ($position !== false) {
                return true;
            }
        }

        return false;
    }
}
