<?php

namespace JobMetric\GlobalVariable\Actions\Models\Setting;

use JobMetric\GlobalVariable\Data\Models\DispatchSettingData;
use JobMetric\GlobalVariable\Events\Actions\DispatchSettingEvent;
use JobMetric\GlobalVariable\Models\Setting;
use Cache;

class DispatchSettingAction
{
    /**
     * add user otp and send for user
     *
     * @param DispatchSettingData $data
     *
     * @return void
     * @static
     */
    public static function render(DispatchSettingData $data): void
    {
        Setting::ofCode($data->code)->get()->each(function ($item) {
            $item->delete();
        });

        foreach ($data->object as $index => $item) {
            if (substr($index, 0, strlen($data->code)) == $data->code) {
                $key = substr($index, (strlen($data->code) + 1), (strlen($index) - (strlen($data->code) + 1)));

                $setting = new Setting;
                $setting->code = $data->code;
                $setting->key = $key;
                $setting->value = is_array($item) ? json_encode($item, JSON_UNESCAPED_UNICODE) : $item;
                $setting->is_json = is_array($item);

                $setting->save();
            }
        }

        if($data->has_event) {
            event(new DispatchSettingEvent($data->code));
        }

        Cache::forget('global-setting');
    }
}
