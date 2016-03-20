<?php

namespace App\Models;



class Permission extends Model
{
  protected $permissions;

  public function __construct(){
    $this->permissions = config('permissions');
  }

  public function get(){
    
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
