<?php

namespace App\Http\Middleware;

use Closure;
use App\Post;
use Auth;
use App\Comment;
use App\Story;
use App\Storycomment;

class CheckOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $type)
    {
        $id = $request->route()->parameter('id');
        if($type == "post"){
            $data = Post::find($id);
            if(Auth::Id() != $data->user_id){
                return redirect()->back();
            }
            return $next($request);
        }
        else if($type == "story"){
            $data = Story::find($id);
            if(Auth::Id() != $data->user_id){
                return redirect()->back();
            }
            return $next($request);
        }
        else if($type == "comment"){
            $data = Comment::find($id);
            if(Auth::Id() == $data->user_id){
                return $next($request);
            }
            else if(Auth::Id() == $data->post->user_id){
                return $next($request);
            }
            else{
                return redirect()->back();
            }
            return $next($request);
        }
        else if($type == "storycomment"){
            $data = Storycomment::find($id);
            if(Auth::Id() == $data->user_id){
                return $next($request);
            }
            else if(Auth::Id() == $data->story->user_id){
                return $next($request);
            }
            else{
                return redirect()->back();
            }
            return $next($request);
        }
        else{
            return redirect()->back();
        }
    }
}
