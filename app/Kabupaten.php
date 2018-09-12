<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    //
    protected $table = "kabupaten";
    protected $casts = ['id' => 'string'];

    public function prov(){
        return $this->belongsTo('App\Provinsi','id_provinsi');
    }
    
    public function kec(){
        return $this->hasMany('App\Kecamatan','id_kabupaten');
    }
    
    public function user(){
        return $this->hasMany('App\User','kabupaten');
    }
}
