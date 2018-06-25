<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['post_id', 'user_id', 'target_id', 'type', 'read','tgl_notif'];
    
    public function post(){
        return $this->belongsTo('App\Post','post_id');
    }
    
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    
    public function target(){
        return $this->belongsTo('App\User','taget_id');
    }
    
}
