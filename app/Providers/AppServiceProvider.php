<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Force HTTPS in production
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        // Set storage path for Vercel
        if ($this->app->environment('production')) {
            $this->app->useStoragePath('/tmp/storage');
        }
    }
}
