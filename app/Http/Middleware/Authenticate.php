<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Models\Visitor;

class Authenticate
{
    protected $request;

    protected $visitor;

    protected function authPermissions()
    {
        return $this->request;
    }

    protected function authAccessToken()
    {
        // $user_token = $request->header('X-USER-TOKEN');
      //
      // $resource = $request->segment(2);
      //
      // $method = $request->method();
      // $request->visitor = new Visitor();

      return $this->authPermissions();
    }

    protected function auth()
    {
        return $this->authAccessToken();
    }

    public function handle($request, Closure $next)
    {
        $this->request = $request;

        return $next($this->auth());
    }
}
