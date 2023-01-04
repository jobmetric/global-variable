<?php

namespace JobMetric\GlobalVariable\Data\Models;

use Spatie\LaravelData\Data;

class DispatchSettingData extends Data
{
    public function __construct(
        public string $code,
        public array  $object,
        public bool   $has_event = true)
    {
    }
}
