<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    //
    protected $table = "desa";
    protected $casts = ['id' => 'string'];
    protected $fillable = ['admin_id'];
    public $timestamps = false;
    
    public function kecamatan(){
        return $this->belongsTo('App\Kecamatan','id_kecamatan');
    }
    
    public function user(){
        return $this->hasMany('App\User','desa');
    }
    
    public function stories(){
        return $this->hasMany('App\Story','desa');
    }

    public function pengurus(){
        return $this->belongsTo('App\User', 'admin_id', 'username');
    }

    public function penduduk()
    {
        return $this->hasMany('App\User', 'desa');
    }

    public function selayang_pandang()
    {
        return $this->hasOne('App\SelayangPandang', 'desa');
    }

    public function dokumen()
    {
        return $this->hasMany('App\DokumenDesa', 'desa');
    }

    public function galeri_desa()
    {
        return $this->hasMany('App\GaleriDesa', 'desa');
    }

    public function organisasi_desa()
    {
        return $this->hasMany('App\OrganisasiDesa', 'desa', 'id');
    }

    public function profil_desa()
    {
        return $this->hasOne('App\ProfilDesa', 'desa');
    }

    public function produk_unggulan()
    {
        return $this->hasMany('App\ProdukUnggulan', 'desa');
    }

    public function proyek_desa()
    {
        return $this->hasMany('App\ProyekDesa', 'desa');
    }

    public function kabar_desa()
    {
        return $this->hasOne('App\KabarDesa', 'desa');
    }
    
}
