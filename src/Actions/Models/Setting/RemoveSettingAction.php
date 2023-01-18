<?php

namespace JobMetric\GlobalVariable\Actions\Models\Setting;

use Cache;
use GlobalVariable;
use JobMetric\GlobalVariable\Events\Actions\RemoveSettingEvent;
use JobMetric\GlobalVariable\Models\Setting;

class RemoveSettingAction
{
    /**
     * remove setting
     *
     * @param string $code
     * @param bool $has_event
     *
     * @return void
     * @static
     */
    public static function render(string $code, bool $has_event = true): void
    {
        Setting::ofCode($code)->get()->each(function ($item) {
            GlobalVariable::configuration()->unset($item->code . '_' . $item->key);

            $item->delete();
        });

        if ($has_event) {
            event(new RemoveSettingEvent($code));
        }

        Cache::forget('global-setting');
    }
}
