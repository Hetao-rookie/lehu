<?php

namespace App\Http\Controllers\API;

use App\Services\Coder;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected $coder;

    public function __construct()
    {
        $this->coder = new Coder();
    }

}
