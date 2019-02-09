<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['user_id', 'recepient_id', 'content', 'num_share', 'has_image','privacy'];
    protected $with = ['user', 'comments', 'likes', 'photos', 'receive'];


    
    public function user(){
        return $this->hasOne('\App\User', 'id', 'user_id');
    }
    
    public function comments(){
        return $this->hasMany('App\Comment', 'post_id', 'id');
    }
    
    public function likes(){
        return $this->hasMany('App\Like', 'post_id', 'id');
    }
    
    public function numcomments(){
        return $this->comments->count();
    }
    
    public function numlikes(){
        return $this->likes->count();
    }

    public function photos()
    {
        return $this->hasMany('App\Photo', 'post_id', 'id' );
    }

    public function receive()
    {
        return $this->hasOne('App\User', 'id', 'recepient_id');
    }
}
