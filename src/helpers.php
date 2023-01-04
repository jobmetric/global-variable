<?php

use JobMetric\GlobalVariable\Data\Models\DispatchSettingData;
use JobMetric\GlobalVariable\Actions\Models\Setting\DispatchSettingAction;

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
        $data = new DispatchSettingData($code, $object, $has_event);
        
        DispatchSettingAction::render($data);
    }
}