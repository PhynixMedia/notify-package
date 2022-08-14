<?php

namespace Notify\App;

use Illuminate\Support\ServiceProvider;

class NotifyServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
//        $this->app->register(InvoiceEventServiceProvider::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__ . '/routes/web.php';
        include __DIR__ . '/routes/api.php';

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        //register the view
        $this->mergeConfigFrom(__DIR__ . '/config/notify-app.php', 'notify-app');
        $this->publishes([
            __DIR__ . '/config/notify-app.php' => config_path('notify-app.php'),
            __DIR__ . '/views' => resource_path('views/vendor/notify/'),
        ]);

        //register the view
        $this->loadViewsFrom(resource_path('views/vendor/notify'), 'notify-app');

    }

}
