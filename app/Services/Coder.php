<?php
/**
 * 编码器对象
 * 用于处理系统的响应结果，
 * 封装了相应的函数提供给模型或控制器使用，以简化业务逻辑的代码。
 * 集中处理程序的操作日志，同时能向用户提供所有状态信息的文档，方便用户调用API时查询。
 *
 * @author 古月(2016/03/06)
 */
namespace App\Services;

use Storage;

class Coder
{
    protected $status;

    /**
     * 构造函数
     * 解析状态存储文件，获取系统定义的状态集，
     * 将获取到的结果保存在对象属性中，供后续函数获取状态信息使用.
     *
     * @TODO 将状态码放入缓存中，定义查找算法实现快速获取状态信息
     */
    public function __construct()
    {
        if (Storage::exists('status.json')) {
            $context = Storage::get('status.json');
            if (!$this->status = json_decode($context, true)) {
                throw new \Exception('status.json file is improperly formatted.');
            }
        } else {
            throw new \Exception('status.json file is not exists in /storage/app foulder.');
        }
    }

    /**
     * 返回状态
     * 识别状态码，返回状态信息.
     *
     * @param string         $str  状态字符串
     * @param [array|string] $data 返回的数据
     *
     * @return object 返回结果对象
     */
    public function status($str, $data)
    {
        $result = $this->newResult();
        $result->code = $code;
        $result->data = $data;
        $result->message = $this->getStatusByString($str);
    }

    /**
     * 返回状态
     * 识别状态码，返回状态信息.
     *
     * @param int            $code 状态字符串
     * @param [array|string] $data 返回的数据
     *
     * @return object 返回结果对象
     */
    public function code($code, $data)
    {
        $result = $this->newResult();
        $result->code = $code;
        $result->data = $data;
        $result->message = $this->getMessageByCode($code);
    }

    /**
     * 获取状态对象
     * 此处是获取定义在JSON文件中的状态对象
     * 根据传入的状态值或者状态码进行匹配.
     *
     * @param string|int $param 状态值或状态编码
     *
     * @return object 匹配返回状态对象
     */
    protected function getStatus($param)
    {
        if (is_int($param)) {
            return $this->getMessageByCode($param);
        } elseif (is_string($param)) {
            return $this->getStatusByString($param);
        } else {
            throw new \Exception('the param must be int or string.');
        }
    }

    /**
     * 根据状态码获取状态对象
     *
     * @param int $code 状态码
     *
     * @return object 状态对象
     */
    protected function getStatusByCode($code)
    {
        foreach ($this->status as $k => $v) {
            if ($code == $k) {
                return $v;
            }
        }
        throw new \Exception("the code : $code is not defined.");
    }

    /**
     * 根据状态值获取状态对象
     *
     * @param string $str 状态值
     *
     * @return object 状态对象
     */
    protected function getStatusByString($str)
    {
        $string = strtolower($str);
        foreach ($this->status as $k => $v) {
            $message = str_replace(' ', strtolower($v->message));
            if ($message == $string) {
                return $v;
            }
        }
        throw new \Exception("the status : $str is not defined.");
    }

    /**
     * 获取一个新响应结果对象
     * 在这里定义了标准的响应字段
     * 返回一个PHP标准对象
     *
     * @return object 标准响应结果对象
     */
    protected function newResult()
    {
        $result = new stdClass();
        $result->code = '';
        $result->message = '';
        $result->data = [];
    }
}
