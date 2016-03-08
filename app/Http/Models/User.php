<?php

namespace App\Http\Models;

class User extends Basic
{
    protected $table = 'users';

    protected $fillable = [
     'username',
     'password',
     'role',
     'status',
     'avatar',
     'email',
    ];

    protected $guarded = ['password'];

    public $timestamps = true;

    public function post($user)
    {
        $result = $this->transaction(function () use ($user) {

        $this->create($user);

        return true;
    });

        return $result;
    }

    public function put()
    {
    }

    public function delete()
    {
    }

    public function get()
    {
    }
}
