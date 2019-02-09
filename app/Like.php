<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //
    protected $with = 'user';
    protected $fillable = ['post_id', 'user_id', 'page_id', 'status'];
    
    public function post(){
        return $this->belongsTo('App\Post','post_id');
    }
    
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
