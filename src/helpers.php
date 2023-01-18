<?php

use JobMetric\GlobalVariable\Actions\Models\Setting\DispatchSettingAction;
use JobMetric\GlobalVariable\Actions\Models\Setting\RemoveSettingAction;

if (!function_exists('dispatchSetting')) {
    /**
     * dispatch setting
     *
     * @param string $code
     * @param array $object
     * @param bool $has_event
     *
     * @return void
     */
    function dispatchSetting(string $code, array $object, bool $has_event = true): void
    {
        DispatchSettingAction::render($code, $object, $has_event);
    }
}

if (!function_exists('removeSetting')) {
    /**
     * remove setting
     *
     * @param string $code
     * @param bool $has_event
     *
     * @return void
     */
    function removeSetting(string $code, bool $has_event = true): void
    {
        RemoveSettingAction::render($code, $has_event);
    }
}
