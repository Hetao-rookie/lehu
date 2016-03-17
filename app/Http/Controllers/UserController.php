<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Status;
use App\Services\Context;
class UserController extends Controller
{

    public function post(){

    }

    public function put(){

    }

    public function get(Context $context){

      $model = new User();

      $params = $context->params();

      $result = $model->get($params);

      return $context->response($result);

    }

    public function delete(){

    }

}
