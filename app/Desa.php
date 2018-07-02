<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    //
    protected $table = "desa";
    protected $casts = ['id' => 'string'];
    protected $fillable = ['admin_id'];
    public $timestamps = false;
    
    public function kecamatan(){
        return $this->belongsTo('App\Kecamatan','id_kecamatan');
    }
    
    public function user(){
        return $this->hasMany('App\User','desa');
    }
    
    public function stories(){
        return $this->hasMany('App\Stories','desa');
    }

    public function pengurus(){
        return $this->belongsTo('App\User', 'admin_id');
    }

    public function penduduk()
    {
        return $this->hasMany('App\User', 'desa');
    }
    
}
