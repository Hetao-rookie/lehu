<?php

namespace App\Http\Controllers\API;

use Storage;
use App\Services\API;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    protected $api;

    public function __construct(API $api)
    {
        $this->api = $api;
    }

    public function login()
    {
      $user = $this->api->data();
      


    }

    public function register()
    {

    }

    public function forgot(){

    }

    public function reset(){

    }

    public function email(){

    }

    public function sms(){

    }
}
