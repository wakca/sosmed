<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $table = "stories";
    protected $fillable = ['desa', 'user_id', 'cat_id', 'title', 'slug', 'content', 'tags', 'status', 'views'];
    
    public function desa(){
        return $this->belongsTo('App\Desa', 'desa');
    }
    
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    
    public function comment(){
        return $this->hasMany('App\Storycomment','story_id');
    }

    public function image()
    {
        return $this->hasMany('App\Storyimage', 'story_id');
    }
    
    public function tags(){
        return $this->belongsToMany(\App\Tag::class);
    }
}
