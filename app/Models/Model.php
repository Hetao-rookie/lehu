<?php

namespace App\Models;

use DB;
use App\Services\Status;

class Model extends DB
{
    protected $status;

    protected $resorces;

    public function __construct()
    {
        $this->status = new Status();

        $this->resorces = config('resorces');
    }

    /**
     * 生成资源ID
     * ID生成可能会有冲撞问题。
     *
     * @return string ID
     */
    public function getID()
    {
        return substr(sha1(uniqid(mt_rand(1, 1000000))), 8, 24);
    }

    public function getTable($resource)
    {
        return $this->resorces[$resource];
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

            return $this->result(1003, $e->getMessage());
        }

        return $result;
    }

    /**
     * 结果响应函数.
     *
     * @param int/string $status 状态码或状态名
     * @param mixed      $data   打印数据
     *
     * @return stdClass 响应结果
     */
    public function result($status, $data = null)
    {
        return $this->status->result($status, $data);
    }
    /**
     * 单个资源查询构造函数
     * 针对单表数据查询构造，用于GET请求输出.
     *
     * @param stirng $table  数据表
     * @param array  $params 请求参数
     *
     * @return array 请求结果
     */
    public function resource($table, $params)
    {
        $query = DB::table($table);

        foreach ($params as $k => $v) {
            switch ($k) {
                case 'order':
                case 'order_by':
                  $query = $query->orderBy($params['order_by'], $params['order']);
                  break;
                case 'fields':
                  $query = $query->select($v);
                  break;
                case 'distinct':
                  $query = $query->distinct();
                  break;
                case 'limit':
                  $query = $query->limit($v);
                  break;
                case 'page':
                  $query = $query->offset();
                  break;
                case 'per_page':
                  $query = $query->distinct();
                  break;
                default:
                  $query = $query->where($k, $v);
            }
        }

        if (isset($params['count'])) {
            return $this->resourceResult($query->count($params['count']));
        }

        return $this->resourceResult($query->get());
    }

    protected function resourceResult($result)
    {
        if (count($result) > 0) {
            return $this->result('success', $result);
        }

        return $this->result('noQueryResult');
    }
}
