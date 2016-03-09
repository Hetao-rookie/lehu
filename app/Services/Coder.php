<?php

namespace App\Services;

use Storage;

class Coder
{
    protected $status;

    public function __construct()
    {
        if (Storage::exists('status.json')) {
            $context = Storage::get('status.json');
            if (!$this->status = json_decode($context, true)) {
                throw new \Exception('status.json file is improperly formatted.');
            }
        } else {
            throw new \Exception('status.json file is not exists in /storage/app foulder.');
        }
    }

    public function status($code, $data)
    {
        $result = $this->newResult();
        $result->code = $code;
        $result->data = $data;
        $result->message = $this->getMessageByStatus($code);
    }

    public function code($code, $data)
    {
        $result = $this->newResult();
        $result->code = $code;
        $result->data = $data;
        $result->message = $this->getMessageByCode($code);
    }

    protected function getStatus($param)
    {
        if (is_int($param)) {
            return $this->getMessageByCode($param);
        } elseif (is_string($param)) {
            return $this->getStatusByString($param);
        } else {
            throw new \Exception('the param must be int or string.');
        }
    }

    protected function getStatusByCode($code)
    {
        foreach ($this->status as $k => $v) {
            if ($code == $k) {
                return $v;
            }
        }
        throw new \Exception("the code : $code is not defined.");
    }

    protected function getStatusByString($str)
    {
        $string = strtolower($str);
        foreach ($this->status as $k => $v) {
            $message = str_replace(' ', strtolower($v->message));
            if ($message == $string) {
                return $v;
            }
        }
        throw new \Exception("the status : $str is not defined.");
    }

    protected function newResult()
    {
        $result = new stdClass();
        $result->code = '';
        $result->data = [];
        $result->message = '';
        $result->cause = '';
    }
}
