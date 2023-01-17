<?php

namespace JobMetric\GlobalVariable\Actions\Models\Setting;

use JobMetric\GlobalVariable\Data\Models\DispatchSettingData;
use JobMetric\GlobalVariable\Events\Actions\DispatchSettingEvent;
use JobMetric\GlobalVariable\Models\Setting;
use Cache;
use GlobalVariable;

class DispatchSettingAction
{
    /**
     * add user otp and send for user
     *
     * @param string $code
     * @param array $object
     * @param bool $has_event
     *
     * @return void
     * @static
     */
    public static function render(string $code, array $object, bool $has_event = true): void
    {
        Setting::ofCode($code)->get()->each(function ($item) {
            $item->delete();
        });

        foreach ($object as $index => $item) {
            if (substr($index, 0, strlen($code)) == $code) {
                $key = substr($index, (strlen($code) + 1), (strlen($index) - (strlen($code) + 1)));
                $value = is_array($item) ? json_encode($item, JSON_UNESCAPED_UNICODE) : $item;

                $setting = new Setting;
                $setting->code = $code;
                $setting->key = $key;
                $setting->value = $value;
                $setting->is_json = is_array($item);

                $setting->save();

                GlobalVariable::config()->set($code . '_' . $key, $value);
            }
        }

        if ($has_event) {
            event(new DispatchSettingEvent($code));
        }

        Cache::forget('global-setting');
    }
}
