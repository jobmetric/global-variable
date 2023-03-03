<?php

namespace JobMetric\GlobalVariable\Listeners\Template;

use GlobalVariable;

class InitThemeListener
{
    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(): void
    {
        GlobalVariable::document()->addScript('vendor/global-variable/global-variable.js');

        $template = config('global-variable.template');

        $file_path = resource_path('views/templates/'.$template.'/init.php');
        if(file_exists($file_path)) {
            require_once $file_path;

            $func_init_template = $template.'_init_template';
            if(function_exists($func_init_template)) {
                $func_init_template();
            }
        }
    }
}
