<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $table = 'role';

    public function getUserRole()
    {
        return $this->hasMany('App\Users', 'role_id', 'id');
    }

    
}
