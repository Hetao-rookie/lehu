<?php
/**
 * 编码器.
 *
 * 用于处理系统的响应结果，
 * 封装了相应的函数提供给模型或控制器使用，以简化业务逻辑的代码。
 * 集中处理程序的操作日志，同时能向用户提供所有状态信息的文档，方便用户调用API时查询。
 *
 * @author 古月(2016/03)
 */

namespace App\Services;

use Storage;

class Status
{
    /**
     * 响应结果
     * 存放请求过程中产生的处理结果.
     *
     * @var stdClass
     */
    protected $reuslt;

    /**
     * 状态数组.
     *
     * @var array
     */
    protected $statuses;

    /**
     * 构造函数
     * 解析状态存储文件，获取系统定义的状态集，
     * 将获取到的结果保存在对象属性中，供后续函数获取状态信息使用.
     *
     * @TODO 将状态码放入缓存中，通过查找算法实现快速获取状态信息
     */
    public function __construct()
    {
        if (!Storage::exists('status.json')) {
            throw new \Exception('status.json file is not exists in /storage/app foulder.');
        }

        $context = Storage::get('status.json');

        if (!$this->statuses = json_decode($context, true)) {
            throw new \Exception('status.json file is improperly formatted.');
        }

        $this->result = new stdClass();
    }

    /**
     * 响应结果函数
     * 识别状态码，返回状态信息.
     * 响应状态时，根据状态名称，从本地化文件中读取状态消息。
     *
     * @param int/string     $status 状态编码或别名
     * @param [array/string] $data   返回的数据
     *
     * @return stdClass 返回结果对象
     */
    public function result($status, $data)
    {
        $this->result->code = $this->getCode($status);
        $this->result->message = $this->getMessage($status);
        $this->result->data = $data;
    }
    /**
     * 获取状态码
     *
     * @param int/string $status 状态码或状态名称
     *
     * @return int 状态码
     */
    protected function getCode($status)
    {
        if (!$this->statusExists($status)) {
            return false;
        }

        if (is_string($status)) {
            return $this->statuses[$status];
        }

        return $status;
    }
    /**
     * 状态存在检查
     * 状态不存在时记录状态信息到日志.
     *
     * @param int/string $status 状态码或名称
     *
     * @return bool
     */
    protected function statusExists($status)
    {
        if (is_string($status)) {
            if (array_key_exists($status, $this->statuses)) {
                return true;
            }
            $this->report($status);
        }

        if (is_int($status)) {
            if (in_array($status, $this->statuses)) {
                return true;
            }
            $this->report($status);
        }

        return false;
    }

    /**
     * 获取状态消息
     * 状态消息存放在本地化文件中，
     * 状态消息不存在，返回状态名称.
     *
     * @param string $key 状态名称
     *
     * @return string 状态消息
     */
    protected function getMessage($name)
    {
        return trans("status.$name");
    }

    /**
     * 状态报告
     * 状态列表改动，造成状态代码丢失，
     * 在程序执行时，报告相关状态信息。
     *
     * @param int/string $status 状态码或状态别名
     */
    protected function report($status)
    {
    }
}