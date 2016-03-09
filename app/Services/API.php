<?php

namespace App\Services;

use App\Services\Coder;

class API extends Coder;
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

    public function response($statusCode = 200, $result = '')
    {
        return response($result, $statusCode)->header('Content-Type', 'application/json');
    }

}
