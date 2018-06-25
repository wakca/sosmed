<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groupmember extends Model
{
    protected $fillable = ['user_id', 'group_id'];
    
    public function group(){
        return $this->belongsTo('App\Groupchat','group_id');
    }
    
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
