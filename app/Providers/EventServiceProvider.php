<?php

namespace App\Providers;

use App\Models\MUser;
use App\Models\MCategory;
use App\Models\MCategoryTranslation;
use App\Models\MCode;
use App\Models\MContent;
use App\Models\MContentTranslation;
use App\Models\MItemStory;
use App\Models\MItemStoryTranslation;


use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\ModelObserver;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        MUser::observe(ModelObserver::class);
        MCategory::observe(ModelObserver::class);
        MCategoryTranslation::observe(ModelObserver::class);
        MCode::observe(ModelObserver::class);
        MContent::observe(ModelObserver::class);
        MContentTranslation::observe(ModelObserver::class);
        MItemStory::observe(ModelObserver::class);
        MItemStoryTranslation::observe(ModelObserver::class);
    }
}
