<?php

namespace App\Services;

use Storage;

class Code
{
    protected $codes;

    public function __construct()
    {
        $json = Storage::get('app/codes.json');

        $this->codes = json_decode($json, true);
    }

    public function statusExists($status){

    }

    public function set()
    {

    }

}
