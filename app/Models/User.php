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
    /**
     * 操作用户.
     * 添加用户时，该变量为插入数据，
     * 在编辑用户时，作为更新数据。
     *
     * @var array
     */
    protected $user;

    /**
     * 添加用户
     * 用户创建依赖于角色，采用外键约束。
     * 故在用户创建之前，应对角色信息进行验证。
     *
     * @param array $user 用户信息
     *
     * @return result 成功返回创建后的用户
     */
    public function post($user)
    {
        $this->initializeUser($user,'post');

        $validateResult = $this->validateUser();

        if ($validateResult !== true) {
            return $this->result('validateError', $validateResult);
        }

        if (!$this->validateRole()) {
            return $this->result('roleNotExists');
        }

        $result = $this->transaction(function () {

          $this->setPassword();

          $id = $this::table($this->tables['USER'])->insertGetId($this->user);

          return $this->result('success', $id);

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
    public function delete($params, $remove = false)
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

    protected function initializeUser($user, $scenario = 'put')
    {
        $initialized = [
         'role' => config('site.user.role', 'member'),
         'status' => config('site.user.status', 0),
         'updated_at' => time(),
        ];

        if ($scenario == 'post') {
            $initialized['created_at'] = time();
        }

        $this->user = array_merge($initialized, $user);
    }

    protected function validateUser()
    {
        $table = $this->tables['USER'];

        $validator = Validator::make($this->user, [
                'username' => "required|unique:$table|max:255",
                'password' => 'required|min:6',
                'role' => 'required',
            ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        return true;
    }

    protected function validateRole()
    {
        $table = $this->tables['ROLE'];

        // $role = $this::table($table)->where('ident', $this->user['role'])->first();

        return true;
    }

    protected function setPassword()
    {
        $this->user['password'] = bcrypt($this->user['password']);
    }
}
