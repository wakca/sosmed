<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    //
    protected $table = "desa";
    protected $casts = ['id' => 'string'];
    protected $fillable = ['admin_id'];
    
    public function kecamatan(){
        return $this->belongsTo('App\Kecamatan','id_kecamatan');
    }
    
    public function user(){
        return $this->hasMany('App\User','desa');
    }
    
    public function stories(){
        return $this->hasMany('App\Stories','desa');
    }
    
}
