<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groupchat extends Model
{
    protected $fillable = ['admin_id', 'name'];
    
    public function admin(){
        return $this->belongsTo('App\User','admin_id');
    }
    
    public function member(){
        return $this->hasMany('App\Groupmember','group_id');
    }
    
    public function messages(){
        return $this->hasMany('App\Groupmessage','group_id');
    }
    
    public function notif(){
        return $this->hasMany('App\Notifgroup','group_id');
    }
}
