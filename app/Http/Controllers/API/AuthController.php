<?php

namespace App\Http\Controllers\API;

class AuthController extends Controller
{
    public function login()
    {
        echo '<br><hr>';
        print_r($this->visitor);
        return $this->response('Login');
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
