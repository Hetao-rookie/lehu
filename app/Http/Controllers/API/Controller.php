<?php

namespace App\Http\Controllers\API;

use App\Services\Context;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected $_parent;

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
