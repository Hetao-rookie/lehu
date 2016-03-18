<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Status;
use App\Services\Context;

class AuthController extends Controller
{
    // 用户登陆
    public function login(Context $context, Status $status)
    {
        $model = new User();

        $data = $context->data();

        $result = $model->get(['username' => $data['username']], true);

        if ($result->code != 200) {
            return $context->response($result);
        }

        $user = $result->data[0];

        if ($user->password != $model->encryptPassword($data['password'])) {
            $result = $status->result('invialidPasswordOrUser');

            return $context->response($result);
        }

        $result = $model->accessToken((array) $user);

        if ($result->code != 200) {
            return $context->response($result);
        }

        $user->access_token = $result->data[0];

        unset($user->password);

        return $context->response($status->result('success', $user));
    }

    // 用户注册
    public function register(Context $context, Status $status)
    {
        $data = $context->data();

        $userModel = new User();

        $result = $userModel->post($data);

        return $context->response($result);
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
