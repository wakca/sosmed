<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groupmessage extends Model
{
    protected $fillable = ['user_id', 'group_id', 'message', 'has_image'];
    
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    
    public function group(){
        return $this->belongsTo('App\User','group_id');
    }
}
