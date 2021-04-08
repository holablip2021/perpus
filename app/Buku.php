<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    //
    protected $table = 'buku';

    public function buku_rak()
    {
        return $this->hasMany('App\Rak', 'id', 'rak_id');
    }
    
    
    
}
