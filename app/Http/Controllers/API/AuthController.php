<?php

namespace App\Http\Controllers\API;

use App\Services\Status;
use App\Services\Context;

class AuthController extends Controller
{
    public function login(Context $context, Status $status)
    {


        print_r($status->result(200));


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
