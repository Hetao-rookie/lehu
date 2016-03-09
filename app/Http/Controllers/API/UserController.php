<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function login()
    {
        $user = $this->data();

        return $this->response('Hello login');
    }

    public function register()
    {
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
