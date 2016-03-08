<?php

namespace App\Providers;

use App\Services\API;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class APIServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

      $this->app->bind('App\Services\API', function ($app) {
          return new API($app->request);
      });

    }

}
