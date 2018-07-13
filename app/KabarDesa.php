<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KabarDesa extends Model
{
    protected $table = 'kabar_desa';

    public $timestamps = false;

    public function des()
    {
        return $this->belongsTo('App\Desa', 'desa');
    }
}
