<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follows extends Model
{
    //
    protected $table = "follows";
    protected $fillable = ['user_id', 'following_id' , 'status'];
}
