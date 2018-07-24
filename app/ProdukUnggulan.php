<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdukUnggulan extends Model
{
    protected $table = 'produk_unggulan';

    public $timestamps = false;

    public function des()
    {
        return $this->belongsTo('App\Desa', 'desa');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
