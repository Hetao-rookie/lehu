<?php

namespace App\Http\Models;

use DB;
use App\Services\Status;
use Illuminate\Database\Eloquent\Model as BasicModel;

class Model extends BasicModel
{
    protected $_parent;

    /**
     * 构造函数
     * 赋值模型基类额外继承对象，通过魔术方法调用，
     * 状态服务提供给模型标准的函数返回格式。
     */
    public function __construct()
    {
        $this->_parent = new Status();
    }

    /**
     * 模型事务处理
     * 支持DB和Eloquent.
     *
     * @param function $callback 事务处理的回调
     *
     * @return mixed
     */
    public function transaction($callback)
    {
        DB::beginTransaction();

        try {
            $result = $callback($this);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return $e->getMessage();
        }

        return $result;
    }

    public function __call($method, $args)
    {
        if (is_callable(array($this->_parent, $method))) {
            return call_user_func_array(array($this->_parent, $method), $args);
        }

        return call_user_func_array(array($this, $method), $args);
    }
}
