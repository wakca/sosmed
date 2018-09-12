<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['user_id', 'recepient_id', 'conversation_id', 'message', 'has_image', 'read','del_sender','del_receiver'];
    
    public function sender(){
        return $this->belongsTo('App\User','user_id');
    }
    
    public function receiver(){
        return $this->belongsTo('App\User','recepient_id');
    }
}
