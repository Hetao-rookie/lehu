<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Services\Status;
use App\Services\Context;

class AuthController extends Controller
{
    // 用户登陆
    public function login(Context $context, Status $status)
    {

        return $context->response($status->result('Success'));
    }

    // 用户注册
    public function register(Context $context, Status $status)
    {
        $data = $context->data();

        $model = new User();

        $validator = $model->validate($data);

        if ($validator->fails()) {
            return $context->response($status->result(200,$validator->errors()));
        }

        $user = $model->post($data);

        return $context->response($user);
    }

    // 忘记密码
    public function forgot()
    {
    }

    // 重置密码
    public function reset()
    {
    }

    // 发送邮件
    public function email()
    {
    }

    public function sms()
    {
    }

}
