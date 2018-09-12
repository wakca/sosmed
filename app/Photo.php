<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['post_id', 'user_id', 'photo'];
    
    public function post(){
        return $this->belongsTo('App\Post','post_id');
    }
    
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
