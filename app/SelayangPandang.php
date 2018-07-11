<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SelayangPandang extends Model
{
    protected $table = 'selayang_pandang';

    public $timestamps = false;

    public function desa()
    {
        return $this->belongsTo('App\Desa', 'desa');
    }
}
