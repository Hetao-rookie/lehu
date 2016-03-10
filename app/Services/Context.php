<?php

namespace App\Services;


use App\Services\Coder;

class Context extends Coder
{
    public $request;

    public $response;

    public $visitor;

    public function __construct($request,$response)
    {
        $this->request = $request;

        $this->response = $response;


        // $this->visitor = 'IMVISITOR';

        // echo $request->get('visitor');

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
