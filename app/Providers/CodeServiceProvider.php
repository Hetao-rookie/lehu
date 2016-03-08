<?php

namespace App\Providers;

use App\Services\Code;
use Illuminate\Support\ServiceProvider;

class CodeServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind('App\Services\Code', function ($app) {
          return new Code();
      });
    }
    
}
