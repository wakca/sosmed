<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PesanWarga extends Model
{
    protected $table = 'pesan_warga';
    protected $fillable = ['nama_lengkap', 'email', 'subjek', 'pesan'];

    public function desa()
    {
        return $this->hasOne('App\Desa', 'id', 'desa_id');
    }
}
