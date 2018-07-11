<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrganisasiDesa extends Model
{
    protected $table = 'organisasi_desa';

    public $timestamps = false;

    public function desa()
    {
        return $this->belongsTo('App\Desa', 'desa');
    }
}
