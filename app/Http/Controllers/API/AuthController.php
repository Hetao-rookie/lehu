<?php

namespace App\Http\Controllers\API;

class AuthController extends Controller
{
    public function login()
    {
        return $this->response($this->visitor);
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
