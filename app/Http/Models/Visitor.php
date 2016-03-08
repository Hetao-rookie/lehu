<?php
namespace App\Http\Models;

class Visitor
{

  public $id;

  public $username;

  public $role;

  public $permissions;

  public function __construct($role){
    $this->role = $role;
  }

}
