<?php

namespace App\Providers;

use App\Services\Context;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class ContextServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

      $this->app->bind('App\Services\Context', function ($app) {
          return new Context($app->request);
      });

    }

}
