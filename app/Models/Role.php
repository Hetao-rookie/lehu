<?php

namespace App\Models;



class Role extends Model
{
    protected $table_user = 'roles';

    protected $table_user_role;

    protected $table_role = 'roles'

    protected $fillable = [
     'id',
     'name',
     'ident',
     'description',
     'status',
    ];

    public $timestamps = true;

    public function post($role)
    {
        $result = $this->transaction(function () use ($role) {

          // DB::table('roles_permissions')->insert($role['permissions']);

          $role = $this->create($role);
          // print_r($role->toArray());
          return $this->code(200, $role->toArray());

        });

        return $this->code(200, $result);;
    }

    public function put()
    {
    }

    public function delete()
    {
    }

    public function get($params)
    {
    }
}
