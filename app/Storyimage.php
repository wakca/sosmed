<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Storyimage extends Model
{
    protected $table = 'storyimages';

    protected $fillable = ['story_id', 'image'];
    
    public function story(){
        return $this->belongsTo('App\Story', 'story_id');
    }
    
}
