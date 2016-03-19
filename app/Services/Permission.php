<?php

/**
 * 权限服务
 * @author 古月
 */

namespace App\Services;

use App\Models\Model;

class Permisson
{
  protected $permissions;

  public function __construct(){
    $this->permissions = config('permissions');
  }

  public function check($permission){

  }

  public function bind(){

  }

  public function unbind(){

  }

  public function register(){

  }

}
