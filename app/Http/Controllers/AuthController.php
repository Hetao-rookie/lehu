<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Status;
use App\Services\Context;

class AuthController extends Controller
{
    // 用户登陆
    public function login(Context $context)
    {
        $mode = $context->params('mode');
        $context->guest = $context->data();

        if ($mode == 'mail') {
            return $this->loginByMail($context);
        } else {
            return $this->loginByUsername($context);
        }
    }

    protected function loginByUsername($context)
    {
        $model = new User();

        $status = new Status();

        $result = $model->get(['username' => $context->guest['username']], true);

        if ($result->code != 200) {
            return $context->response($result);
        }

        $user = $result->data[0];

        if ($user->password != $model->encryptPassword($context->guest['password'])) {
            $result = $status->result('invialidPasswordOrUsername');

            return $context->response($result);
        }

        $user->access_token = $model->accessToken((array) $user);

        unset($user->password);

        return $context->response($status->result('success', $user));
    }

    protected function loginByMail()
    {
      
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
    public function sendRegisterMail()
    {
    }

    public function sendRegisterSMS()
    {
    }

    public function sendForgotPasswordMail()
    {
    }

    public function sendForgotPasswordSMS()
    {
    }
}
