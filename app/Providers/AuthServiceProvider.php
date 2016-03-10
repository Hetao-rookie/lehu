<?php

namespace App\Providers;

use Closure;
use App\Http\Models\Visitor;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     */
    public function boot()
    {

        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.
        //
        $this->app['auth']->viaRequest('api',function () {

            $user_token = $request->header('X-USER-TOKEN');

            $resource = $request->segment(2);

            $method = $request->method();

            return new Visitor('common');
        });
    }
}
