<?php

namespace App\Http\Controllers\API;

use Mail;

class AuthController extends Controller
{
    public function login()
    {
        $data = [];
        // Mail::send('mails.welcome', $data, function ($message) {
        //   // $message->from('info', 'Laravel');
        //
        //   $message->to('297085213@qq.com');
        // });

        return $this->result();
        echo 'Hello';
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
