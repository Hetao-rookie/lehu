<?php

namespace App\Http\Models;

class User extends Model
{
    protected $table = 'users';

    // 可填充字段
    protected $fillable = [
     'username',
     'password',
     'role',
     'status',
     'avatar',
     'email',
    ];

    // 不允许导出字段
    protected $guarded = ['password'];

    // 开启自动生成时间戳
    public $timestamps = true;

    // 创建用户
    // 创建用户过程使用事务
    // 绑定用户到角色到用户的关系表中，
    // 执行成功则返回创建后的用户数组。
    public function post($user)
    {
        $result = $this->transaction(function () use ($user) {

        $this->create($user);

        return true;
    });

        return $result;
    }

    // 更新用户
    // 更新用户信息时如果变更了角色
    // 则需要使用事务改写角色用户关系表，
    // 用户更新成功返回 True。
    public function put()
    {
    }

    // 删除用户
    // 使用事务删除用户，处理用户与角色的关系，
    // 删除成功返回 True。
    public function delete()
    {
    }

    // 获取用户
    // 根据传入参数定义获取用户的方式
    // 可以配置分页，排序和字段

    public function get()
    {
    }

    // 搜索用户
    // 根据传入参数搜索用户
    // 可以检索用户ID，用户名，邮箱
    public function search(){

    }
}
