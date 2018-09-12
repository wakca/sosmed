<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DokumenDesa extends Model
{
    protected $table = 'dokumen_desa';

    public $timestamps = false;

    public function desa()
    {
        return $this->belongsTo('App\Desa', 'desa');
    }
}
