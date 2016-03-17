<?php

/**
 * 权限服务
 * @author 古月
 */

namespace App\Services;

class Permisson
{
  protected $permissions;

  public function __construct(){
    $this->permissions = config('permissions');
  }

  public check($permission){

  }

  public bind(){

  }

  public unbind(){
    
  }

}
