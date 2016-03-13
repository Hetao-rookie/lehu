<?php

/**
 * 上下文服务
 *
 * 在接口业务逻辑中，有很多重复和相同的操作，
 * 上下文服务中对常用操作进行了封装，以简化业务逻辑的开发。
 *
 * @author 古月(2016/03)
 */

namespace App\Services;

class Context extends Status
{
    public $request;

    public $response;

    public $guest;

    public function __construct($request, $response)
    {
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
