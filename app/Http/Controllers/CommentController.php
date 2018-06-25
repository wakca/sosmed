<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Comment;
use App\Post;
use DBFunction;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(Request $request){
        $user_id    = Auth::Id();
        $post       = Post::find($request->post_id);
        
        Comment::create(['user_id' => $user_id, 'post_id' => $request->post_id, 'content' => $request->content]);
        if($post->user_id != $user_id){ //cek apakah pemilik post sama dengan yang comment
            DBFunction::saveNotification($request->post_id, $user_id, $post->user_id,1,'N','N');
            $comments = Comment::where([['post_id',$request->post_id],['user_id','!=',$post->user_id],['user_id','!=',$user_id]])->get();
            foreach($comments as $comment){
                DBFunction::saveNotification($request->post_id, $user_id, $comment->user_id,5,'N','N');
            }
        }
        else{
            $comments = Comment::where([['post_id',$request->post_id],['user_id','!=',$post->user_id]])->get();
            foreach($comments as $comment){
                DBFunction::saveNotification($request->post_id, $user_id, $comment->user_id,4,'N','N');
            }
        }
        return Response()->json(['status' => 'success']);
    }
    
    public function edit($id){
        $comment = Comment::find($id);
        return Response()->json($comment);
    }
    
    public function update(Request $request,$id){
        Comment::find($id)->update(['content' => $request->content]);
        return Response()->json(['status' => 'success','content' => $request->content]);
    }
    
    public function destroy($id){
        $comment = Comment::find($id);
        $post_id = $comment->post_id;
        $comment->delete();
        return Response()->json(['status'=>'success','post_id' => $post_id]);
    }
}
