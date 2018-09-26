<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrganisasiDesa extends Model
{
    protected $table = 'organisasi_desa';

    protected $fillable = ['desa','judul', 'kontent'];
//    public $timestamps = false;

    public function desa()
    {
        return $this->belongsTo('App\Desa', 'desa');
    }
}
