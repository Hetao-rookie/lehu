<?php

namespace App\Services;

class Context extends Coder
{
    public $request;

    public $response;

    public $visitor;

    public function __construct($request, $response)
    {
        $this->visitor = $request->visitor;

        unset($request->visitor);

        $this->request = $request;

        $this->response = $response;

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

    public function response($result = '', $statusCode = 200)
    {
        return response(json_encode($result), $statusCode)->header('Content-Type', 'application/json');
    }
}
