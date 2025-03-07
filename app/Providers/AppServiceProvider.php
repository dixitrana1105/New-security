<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Message;
use App\Observers\MessageObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Automatically share pagination data
        view()->composer('*', function ($view) {
            if (request()->route() && method_exists(request()->route()->getController(), 'getPaginator')) {
                $view->with('paginator', request()->route()->getController()->getPaginator());
            }
        });
        Message::observe(MessageObserver::class);
    }
}
