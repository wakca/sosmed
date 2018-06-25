<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use Auth;
use Config;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $user_id        = Auth::Id();
        $limit_number   = Config::get('global.notif_number');
        $notifs         = Notification::where([['target_id',$user_id],['delete','N']])->orderBy('tgl_notif','desc')->paginate($limit_number);
        Notification::where([['target_id',$user_id],['delete','N']])->update(['read'=>'Y']);
        return view('notifications',['notifs' => $notifs]);
    }
    
    public function read($id){
        $notif = Notification::find($id);
        $notif->timestamps = false;
        $notif->update(['read' => 'Y']);
        return Response()->json(['status' => 'success']);
    }
}
