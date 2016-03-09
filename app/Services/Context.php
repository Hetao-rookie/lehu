<?php

namespace App\Services;

use App\Services\Coder;

class Context extends Coder
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;

        $this->response = true;
    }

    public function params()
    {
        return $_GET;
    }

    public function data()
    {
        return json_decode(file_get_contents('php://input'), true);
    }

    public function file()
    {

    }

    public function response($result = '',$statusCode = 200)
    {
        return response($result, $statusCode)->header('Content-Type', 'application/json');
    }

}
