<?php

namespace App\Http\Controllers\API;

use App\Services\Context;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected $_parent;

    /**
     * 构造函数
     * 赋值控制器基类额外继承对象，通过魔术方法调用
     *
     * @param App\Service\Context $context 自动依赖注入上下文对象
     */
    public function __construct(Context $context)
    {
        $this->_parent = $context;
    }

    public function __call($method, $args)
    {
        if (is_callable(array($this->_parent, $method))) {
            return call_user_func_array(array($this->_parent, $method), $args);
        }

        return call_user_func_array(array($this, $method), $args);
    }

    public function __get($name)
    {
        return $this->_parent->$name;
    }
}
