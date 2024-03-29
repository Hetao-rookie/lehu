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

class Context
{
    public $request;

    public $response;

    public $guest;

    public function __construct($request, $response)
    {
        $this->request = $request;

        $this->response = $response;

        // $this->guset = $request->guest;
    }
    /**
     * 获取GET参数.
     *
     * @return array GET请求参数
     */
    public function params($field = false)
    {
        if ($field !== false) {
            if (isset($_GET[$field])) {
                return $_GET[$field];
            }

            return false;
        }

        return $_GET;
    }

    /**
     * 获取请求数据
     * 只接收JSON格式.
     *
     * @return array 请求数据数组
     */
    public function data()
    {
        return json_decode(file_get_contents('php://input'), true);
    }

    /**
     * 获取请求文件.
     */
    public function file()
    {
    }

    /**
     * 响应函数
     * 以JSON格式输出。
     *
     * @param string $result     响应结果
     * @param int    $statusCode HTTP状态码
     *
     * @return Response
     */
    public function response($result = '', $statusCode = 200)
    {
        return response(json_encode($result), $statusCode)->header('Content-Type', 'application/json');
    }
}
