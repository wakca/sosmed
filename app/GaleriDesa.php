<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GaleriDesa extends Model
{
    protected $table = 'galeri_desas';

    public $timestamps = false;

    public function desa()
    {
        return $this->belongsTo('App\Desa', 'desa');
    }
}
