<?php

namespace App\Http\Controllers\API;

use Storage;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login()
    {
        echo 'Hello world';
        if (Storage::exists('permissions.json')) {
            $contents = Storage::get('permissions.json');
            echo '<pre>';
            print_r(json_decode($contents, true));
            echo '</pre>';
        } else {
            echo '该文献不存在';
        }
    }
}
