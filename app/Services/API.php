<?php

namespace App\Services;

use App\Services\Code;

class API extends Code
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
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

    public function code($code, $result = [])
    {
    }

    public function status($status, $result = [])
    {

    }
}
