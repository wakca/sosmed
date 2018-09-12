<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = ['user_id', 'recepient_id', 'content', 'num_share', 'has_image','privacy'];
    
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
    
    public function comments(){
        return $this->hasMany('App\Comment');
    }
    
    public function likes(){
        return $this->hasMany('App\Like');
    }
    
    public function numcomments(){
        return $this->comments->count();
    }
    
    public function numlikes(){
        return $this->likes->count();
    }
}
