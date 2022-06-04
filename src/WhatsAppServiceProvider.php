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
            ->needs(WhatsApp::class)
            ->give(static function () {
                $whatsApp = new WhatsApp(config('services.whatsapp.access-token'));

                return $whatsApp
                    ->setGraphApiVersion(config('services.whatsapp.api-version', '14.0'))
                    ->setSenderNumber(config('services.whatsapp.phone-number'));
            });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
    }
}
