<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use Auth;
use DBFunction;
use App\Post;

class LikeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store($id){
        $user_id = Auth::user()->id;
        $post    = Post::find($id);
        $like    = Like::where([['user_id',$user_id],['post_id', $id]])->first();
        
        if(isset($like)){
            if($like->status == 'Y'){
                Like::find($like->id)->update(['status' => 'N']);
                if($post->user_id != $user_id){
                    DBFunction::saveNotification($id,$user_id,$post->user_id,2,'N','Y');
                }
                return Response()->json(['status' => 'unlike']);
            }
            else{
                Like::find($like->id)->update(['status' => 'Y']);
                if($post->user_id != $user_id){
                    DBFunction::saveNotification($id,$user_id,$post->user_id,2,'N','N');
                }
                return Response()->json(['status' => 'liked']);
            }
        }
        else{
            Like::create(['user_id' => $user_id, 'post_id' => $id, 'status' => 'Y']);
            if($post->user_id != $user_id){
                DBFunction::saveNotification($id,$user_id,$post->user_id,2,'N','N');
            }
            return Response()->json(['status' => 'liked']);
        }
    }
}
