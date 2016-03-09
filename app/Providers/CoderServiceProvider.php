<?php

namespace App\Providers;

use App\Services\Coder;
use Illuminate\Support\ServiceProvider;

class CoderServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind('App\Services\Coder', function ($app) {
          return new Coder();
      });
    }

}
