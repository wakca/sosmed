<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfilDesa extends Model
{
    protected $table = 'profil_desa';

    public $timestamps = false;

    public function desa()
    {
        return $this->belongsTo('App\Desa', 'desa');
    }
}
