<?php

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use JobMetric\GlobalVariable\Actions\Models\Setting\DispatchSettingAction;
use JobMetric\GlobalVariable\Actions\Models\Setting\RemoveSettingAction;

if(!function_exists('dispatchSetting')) {
    /**
     * dispatch setting
     *
     * @param string $code
     * @param array  $object
     * @param bool   $has_event
     *
     * @return void
     */
    function dispatchSetting(string $code, array $object, bool $has_event = true): void
    {
        DispatchSettingAction::render($code, $object, $has_event);
    }
}

if(!function_exists('removeSetting')) {
    /**
     * remove setting
     *
     * @param string $code
     * @param bool   $has_event
     *
     * @return void
     */
    function removeSetting(string $code, bool $has_event = true): void
    {
        RemoveSettingAction::render($code, $has_event);
    }
}

if(!function_exists('theme')) {
    /**
     * Get the evaluated view contents for the given view.
     *
     * @param string|null     $view
     * @param Arrayable|array $data
     * @param array           $mergeData
     *
     * @return View|Factory
     */
    function theme(string|null $view = null, Arrayable|array $data = [], array $mergeData = []): View|Factory
    {
        if(is_null($view)) {
            abort(404, "Not set the first param in the theme function yet.");
        }

        $template = config('global-variable.default');
        $view_dir = implode('/', explode('.', $view));

        if(file_exists(resource_path("views/templates/{$template}/{$view_dir}.blade.php"))) {
            return view("templates.{$template}.{$view}", $data, $mergeData);
        } else {
            if(file_exists(resource_path("views/templates/default/{$view_dir}.blade.php"))) {
                return view("templates.default.{$view}", $data, $mergeData);
            } else {
                abort(404, "View file '{$view}' not found.");
            }
        }
    }
}
