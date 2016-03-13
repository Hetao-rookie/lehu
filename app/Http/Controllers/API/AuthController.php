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

    public function register()
    {
      $user = $context->data();


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
