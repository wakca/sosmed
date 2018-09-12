<?php

namespace App\Http\Controllers\Story;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Storycomment;
use App\Story;
use Auth;
use Redirect;
use DBFunction;

class StorycommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store(Request $request){
        $user_id    = Auth::Id();
        $story       = Story::find($request->story_id);
        $this->validate($request, [
        'content' => 'required'                           
        ]);
        
        Storycomment::create(['user_id' => $user_id, 'story_id' => $request->story_id, 'content' => $request->content]);
        if($story->user_id != $user_id){ //cek apakah pemilik post sama dengan yang comment
            DBFunction::saveNotification($request->story_id, $user_id, $story->user_id,7,'N','N');
            $comments = Storycomment::where([['story_id',$request->story_id],['user_id','!=',$story->user_id],['user_id','!=',$user_id]])->get();
            foreach($comments as $comment){
                DBFunction::saveNotification($request->story_id, $user_id, $comment->user_id,8,'N','N');
            }
        }
        else{
            $comments = Storycomment::where([['story_id',$request->story_id],['user_id','!=',$story->user_id]])->get();
            foreach($comments as $comment){
                DBFunction::saveNotification($request->story_id, $user_id, $comment->user_id,9,'N','N');
            }
        }
        $prevurl = app('url')->previous();
        return Redirect::to($prevurl."#comments");
    }
    
    public function edit($id){
        $comment = Storycomment::find($id);
        return Response()->json($comment);
    }
    
    public function update(Request $request,$id){
        Storycomment::find($id)->update(['content' => $request->content]);
        return Response()->json(['status' => 'success','content' => $request->content]);
    }
    
    public function destroy($id){
        $comment = Storycomment::find($id);
        $comment->delete();
        return Response()->json(['status'=>'success']);
    }
}
