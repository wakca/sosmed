<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Follows;
use DBFunction;

class FollowsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function follow($id){
        $user_id = Auth::user()->id;
        if($id == $user_id)
        return null;
        $follow = Follows::where([['user_id',$user_id] ,['following_id',$id]])->first();
        if(isset($follow)){
            if($follow->status == 'Y'){
                Follows::find($follow->id)->update(['status' => 'N']);
                DBFunction::saveNotification(0,$user_id,$id,3,'N','Y');
                return Response()->json(['status' => 'unfollow']);
            }
            else{
                Follows::find($follow->id)->update(['status' => 'Y']);
                DBFunction::saveNotification(0,$user_id,$id,3,'N','N');
                return Response()->json(['status' => 'following']);
            }
        }
        else{
            Follows::create(['user_id' => $user_id, 'following_id' => $id, 'status' => 'Y']);
            DBFunction::saveNotification(0,$user_id,$id,3,'N','N');
            return Response()->json(['status' => 'following']);
        }
    }
    public function suggest(){
        return view('follows.random');
    }
}
