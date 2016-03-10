<?php

namespace App\Providers;

use App\Services\Context;
use Illuminate\Http\Response;
use Illuminate\Support\ServiceProvider;

class ContextServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Services\Context', function ($app) {

          $response = new Response();

          return new Context($app->request, $response);
      });
    }
}
