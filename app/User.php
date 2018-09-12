<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use App\Notifications\PasswordReset;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'name', 'photo', 'jk', 'tgl_lahir', 'alamat', 'email', 'password', 'provinsi', 'kabupaten', 'kecamatan', 'desa', 'verified'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function prov(){
        return $this->belongsTo('App\Provinsi','provinsi');
    }
    
    public function kab(){
        return $this->belongsTo('App\Kabupaten','kabupaten');
    }
    
    public function kec(){
        return $this->belongsTo('App\Kecamatan','kecamatan');
    }
    
    public function des(){
        return $this->belongsTo('App\Desa','desa');
    }
    
    public function followers()
    {
        return $this->belongsToMany(
            self::class, 
            'follows',
            'following_id',
            'user_id'
        )->where('status','Y');
    }
    
    public function following()
    {
        return $this->belongsToMany(
            User::class,
            'follows',
            'user_id',
            'following_id'
        )->where('status','Y');
    }
    
    public function posts(){
        return $this->hasMany('App\Post');
    }
    
    /**
    * Send the password reset notification.
    *
    * @param  string  $token
    * @return void
    */
   public function sendPasswordResetNotification($token)
   {
       $this->notify(new PasswordReset($token));
   }

   public function asal_desa()
   {
       return $this->belongsTo('App\Desa', 'desa');
   }

   public function produk()
   {
       return $this->hasMany('App\ProdukUnggulan');
   }

   public function story()
   {
       return $this->hasMany('App\Story');
   }


}
