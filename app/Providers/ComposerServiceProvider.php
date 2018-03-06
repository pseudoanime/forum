<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use App\Channel;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->share('channels', Channel::all());
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
