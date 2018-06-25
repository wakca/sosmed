<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Storytag extends Model
{
    protected $table = "story_tag";
    protected $fillable = ['story_id', 'tag_id'];
}
