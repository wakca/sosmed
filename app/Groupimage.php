<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groupimage extends Model
{
    protected $fillable = ['user_id', 'message_id', 'image'];
    
    public function sender(){
        return $this->belongsTo('App\User','user_id');
    }
    
    public function message(){
        return $this->belongsTo('App\Groupmessage','message_id');
    }
}
