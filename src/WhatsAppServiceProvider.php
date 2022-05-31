<?php

namespace NotificationChannels\WhatsApp;

use Illuminate\Support\ServiceProvider;

class WhatsAppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->app->when(WhatsAppChannel::class)
            ->needs(Facebook::class)
            ->give(function () {
                $facebookConfig = config('services.facebook');

                return new Facebook(
                    $facebookConfig['key'],
                    $facebookConfig['secret'],
                    $facebookConfig['app_id']
                );
            });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
    }
}
