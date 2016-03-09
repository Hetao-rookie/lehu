<?php

namespace App\Services;

use Storage;

class Coder
{
    protected $codes;

    protected $response = false;

    public function __construct()
    {
        $json = Storage::get('app/codes.json');

        $this->codes = json_decode($json, true);
    }

    protected function codeExists($status){

    }

    protected function statusExists($status){

    }

    public function code()
    {

    }

    public function status(){

    }

}
