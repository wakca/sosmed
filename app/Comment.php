<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $with = ['user'];
    //
    protected $fillable = ['user_id', 'page_id', 'post_id', 'content'];
    
    public function post(){
        return $this->belongsTo('App\Post');
    }
    
    public function user(){
        return $this->belongsTo('App\User');
    }
}
