<?php

namespace App\Providers;

use App\Services\Log;
use Illuminate\Support\ServiceProvider;

class LogServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind('App\Services\Log', function () {
          return new Log();
      });
    }
}
