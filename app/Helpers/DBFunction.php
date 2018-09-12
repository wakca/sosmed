<?php

namespace App\Helpers;
use App\Like;
use Auth;
use App\Comment;
use App\Post;
use App\User;
use App\Follows;
use Config;
use Route;
use App\Notification;
use App\Notifgroup;
use Date;

class DBFunction
{
    public static function saveNotification($post_id, $user_id, $target_id, $type, $read, $delete){
        $current_time = Date::now()->toDateTimeString(); 
        $notif = Notification::where([['post_id',$post_id],['user_id',$user_id],['target_id',$target_id],['type',$type]])->first();
        if(count($notif) == 0){
            Notification::create(['post_id' => $post_id, 'user_id' => $user_id, 'target_id' => $target_id, 'type' => $type, 'tgl_notif' => $current_time]);
        }
        else{
            Notification::where([['post_id',$post_id],['user_id',$user_id],['target_id',$target_id],['type',$type]])->update(['read' => $read, 'delete' => $delete, 'tgl_notif' => $current_time]);
        }
        return true;
    }
    
    public static function saveNotifgroup($user_id, $group_id, $read){
        $notif = Notifgroup::where([['group_id',$group_id],['user_id',$user_id]])->first();
        if(count($notif) == 0){
            Notifgroup::create(['group_id' => $group_id, 'user_id' => $user_id, 'read' => $read]);
        }
        else{
            Notifgroup::where([['group_id',$group_id],['user_id',$user_id]])->update(['read' => $read]);
        }
        return true;
    }
}