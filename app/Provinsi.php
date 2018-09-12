<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    //
    protected $table = "provinsi";
    protected $casts = ['id' => 'string'];

    public function kab(){
        return $this->hasMany('App\Kabupaten','id_provinsi');
    }
    
    public function user(){
        return $this->hasMany('App\User','provinsi');
    }
}
