<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Models\Visitor;

class Authenticate
{

    public function handle($request, Closure $next)
    {
        $user_token = $request->header('X-USER-TOKEN');

        $resource = $request->segment(2);

        $method = $request->method();

        $request->visitor = new Visitor();

        return $next($request);
    }
}
