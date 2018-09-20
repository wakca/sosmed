<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProyekDesa extends Model
{
    protected $table = 'proyek_desa';

//    public $timestamps ;
    protected $fillable = ['desa', 'judul', 'tahun', 'konten'];

    public function desa()
    {
        return $this->belongsTo('App\Desa', 'desa');
    }
}
