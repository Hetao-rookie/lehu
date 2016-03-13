<?php

namespace App\Http\Controllers\API;

use Mail;

class AuthController extends Controller
{
    public function login(Context $context)
    {

        $result = $this->context->result(200);

        // return response('Hello');
        // return $this->response($this->visitor);
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
