<?php

namespace JobMetric\GlobalVariable\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use JobMetric\GlobalVariable\Events\Document\InitDocument;
use JobMetric\GlobalVariable\Listeners\Template\InitThemeListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        InitDocument::class => [
            InitThemeListener::class,
        ],
    ];
}
