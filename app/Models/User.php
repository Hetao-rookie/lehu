<?php

/**
 * 用户模型
 * 定义了用户表相关的操作。
 *
 * @author 古月(2016/03)
 */

namespace App\Models;

use Validator;

class User extends Model
{
    protected $table = 'users';

    protected $tableRoles = 'roles';

    protected $tableUserRole = 'user_role';

    /**
     * 创建用户
     * 用户创建依赖于角色，采用外键约束。
     * 故在用户创建之前，应对角色信息进行验证。
     *
     * @param array $user 用户信息
     *
     * @return result 成功返回创建后的用户   
     */
    public function post($user)
    {
        $user['password'] = bcrypt($user['password']);

        $user['status'] = isset($user['status']) ? $user['status'] : 0;

        $result = $this->transaction(function () use ($user) {

          $id = $this::table($this->table)->insertGetId($user);

          return $this->result(200, $id);

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
    public function search()
    {
    }

    /**
     * 用户验证
     */
    public function validate($data)
    {
        return  Validator::make($data, [
                'username' => "required|unique:$this->table|max:255",
                'password' => 'required|min:6',
                'role' => 'required',
            ]);
    }

    public function postToken()
    {
    }

    public function getToken()
    {
    }
}
