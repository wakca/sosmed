<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    //
    protected $table = "kecamatan";
    protected $casts = ['id' => 'string'];

    public function kab(){
        return $this->belongsTo('App\Kabupaten','id_kecamatan');
    }
    
    public function des(){
        return $this->hasMany('App\Desa','id_kecamatan');
    }
    
    public function user(){
        return $this->hasMany('App\User','kecamatan');
    }
}
