<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\Context;
use App\Http\Models\Visitor;

class Authenticate
{
    public $context;

    public function __construct(Context $context)
    {
      $this->context = $context;
    }

    public function handle($request, Closure $next)
    {
        $user_token = $request->header('X-USER-TOKEN');

        $resource = $request->segment(2);

        $method = $request->method();

        // $request->set('visitor','FROMAUTH');

        echo 'I m AuthMiddleware <br>';

        return $next($request);
    }
}
