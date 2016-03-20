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
        $this->initializeUser($user, true);

        $validateResult = $this->validateUser();

        if ($validateResult !== true) {
            return $this->result('validateError', $validateResult);
        }

        // $this->unbind('POST_POST',$post['type']);

        // $this->bind('USER_POST',$role);

        // $this->check('USER_POST',$this->user['role']);

        $role = $this->validateRole();

        if ($role === false) {
            return $this->result('roleNotExists');
        }

        $result = $this->transaction(function () {

          $this->processPassword();

          $id = $this->table($this->getTable('USER'))->insertGetId($this->user);

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

    public function generateToken()
    {
        return $this->id();
    }

    /**
     * 获取用户.
     *
     * @param array $params 用户获取条件配置参数
     *
     * @return result 用户集
     */
    public function get($params, $password = false)
    {
        $result = $this->resource($this->getTable('USER'), $params);

        if ($result->code == 200 && !$password) {
            foreach ($result->data as $key => $item) {
                unset($item->password);
            }

            return $result;
        }

        return $result;
    }

    // 搜索用户
    // 根据传入参数搜索用户
    // 可以检索用户ID，用户名，邮箱
    public function search()
    {
    }

    /**
     * 初始化用户
     * 合并配置文件新用户设置，设置时间戳.
     *
     * @param array $user 用户数据
     * @param bool  $post 调用方法
     */
    protected function initializeUser($user, $post = false)
    {
        $initialized = [
         'role' => config('site.user.role', 'member'),
         'status' => config('site.user.status', 0),
         'updated_at' => date('Y-m-d H:i:s'),
        ];

        if ($post) {
            $initialized['created_at'] = date('Y-m-d H:i:s');
        }

        $this->user = array_merge($initialized, $user);
    }

    protected function validateUser()
    {
        $table = $this->getTable('USER');

        $validator = Validator::make($this->user, [
                'username' => "required|unique:$table|max:255",
                'password' => 'required|min:6',
                'mail' => "required|unique:$table|max:255",
                'role' => 'required',
            ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        return true;
    }

    protected function validateRole()
    {
        return true;
    }

    protected function processPassword()
    {
        $this->user['password'] = $this->encryptPassword($this->user['password']);
    }

    public function encryptPassword($password)
    {
        return md5($password);
    }

    public function accessToken($user)
    {
        $this->user = $user;
        if ($this->storeAccessToken()) {
            return $this->user['access_token'];
        }

        throw new \Exception('Store Access Token Error', 1);
    }

    protected function storeAccessToken()
    {
        return $this->table($this->getTable('ACCESSTOKEN'))->insert($this->getAccessTokenRow());
    }

    protected function getAccessTokenRow()
    {
        $row['user_id'] = $this->user['id'];
        $row['access_token'] = $this->user['access_token'] = $this->generateAccessToken($this->user);
        
        return $row;
    }

    public function generateAccessToken($user)
    {
        return md5($user['password']);
    }
}
