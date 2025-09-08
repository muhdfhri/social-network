<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\TimeHelper;

class ChatifyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Override the message view
        $this->loadViewsFrom(resource_path('views/vendor/Chatify'), 'Chatify');
        
        // Publish views
        $this->publishes([
            __DIR__.'/../../resources/views/vendor/Chatify' => resource_path('views/vendor/Chatify'),
        ], 'chatify-views');
    }
}
