<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Services\Status;
use App\Services\Context;

class AuthController extends Controller
{
    public function login(Context $context, Status $status)
    {
        return $context->response($status->result('Success'));
    }

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

    public function forgot()
    {
    }

    public function reset()
    {
    }

    public function email()
    {
    }

    public function sms()
    {
    }
}
