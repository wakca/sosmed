<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;
use File;
use Session;
use App\User;
use Date;
use Getter;
use App\Comment;
use App\Like;
use Config;
use DBFunction;
use App\Photo;
use Validator;
use Intervention\Image\ImageManagerStatic as Image;

class PostController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function show($id){
        $post       = Post::find($id);
        $profile    = $post->user()->first();
        $numpage    = Config::get('global.paginate_number');
        $comments   = Comment::where('post_id',$id)->with('user')->orderBy('created_at','desc')->paginate($numpage);
        return view('post', ['post' => $post, 'comments' => $comments, 'profile' => $profile]);
    }
    
    public function store(Request $request){
        
        $files = $request->photos;
        $file_count = count($files);
        $uploadcount = 0;

        if($files[0] != ''){

            $post = Post::create(['content' => $request->content, 'user_id' => auth()->user()->id,'recepient_id' => $request->recepient_id,'has_image' => 'Y']);

            if($request->user_id != $request->recepient_id){
                DBFunction::saveNotification($post->id,$request->user_id,$request->recepient_id,6,'N','N');
            }
            foreach($files as $file){
                $validator = Validator::make(array('photos'=>$file), [ 
                    'photos' => 'required|image|mimes:jpeg,jpg,png,gif|max:2048|dimensions:max_width=1920'
                ]);
                if($validator->passes()){
                    $dest = public_path('/photos');
                    $imgname  = md5(time().$uploadcount.$request->user_id);
                    $filename = $imgname.'.'.$file->getClientOriginalExtension();
                    $filename_small = 'small_'.$imgname.'.'.$file->getClientOriginalExtension();

                    $img = Image::make($file->getRealPath());
                    $img->fit(428,428,function ($constraint) {
                        $constraint->upsize();
                    });
                    $img->save($dest.'/'.$filename_small,50);
                    $img2 = Image::make($file->getRealPath());
                    $img2->save($dest.'/'.$filename,50);
                    Photo::create(['photo' => $filename, 'post_id' => $post->id, 'user_id' => $request->user_id]);
                    $uploadcount ++;
                }
                else{
                     return response()->json(['error'=>$validator->errors()->all()]);
                }
            }
            if($uploadcount == $file_count){
                return response()->json(['success'=>'done']);
            } 
            else {
                return response()->json(['error'=> ($file_count-$uploadcount).' gagal diupload.']);
            }
        }
        else{
            $post = Post::create(['content' => $request->content, 'user_id' => $request->user_id,'recepient_id' => $request->recepient_id,'has_image' => 'N']);
            if($request->user_id != $request->recepient_id){
                DBFunction::saveNotification($post->id,$request->user_id,$request->recepient_id,6,'N','N');
            }
            return response()->json(['has_image' => 'N']);
        }
    }
    
    public function edit($id){
        $post = Post::find($id);
        return Response()->json($post);
    }
    
    public function update(Request $request,$id){
        Post::find($id)->update(['content' => $request->content]);
        return Response()->json(['status' => 'success','content' => $request->content]);
    }
    
    public function destroy($id){
        $post = Post::find($id);
        if($post->has_image == 'Y'){
            $dest   = public_path('/photos');
            $photos = Photo::where('post_id',$id)->get();
            foreach($photos as $photo){
                File::delete($dest.'/'.$photo->photo);
                File::delete($dest.'/small_'.$photo->photo);
            }
        }
        $post->delete();
        return Response()->json(['status'=>'success']);
    }
    
    public function getNewPosts($id,$user_id = 0){
        if($user_id != 0){
            $post = Post::where([['id','>',$id],['user_id',$user_id],['recepient_id',$user_id]])->orWhere([['id','>',$id],['user_id','!=',$user_id],['recepient_id',$user_id]])->orderBy('created_at','desc')->get();
        }
        else{
            $user_id = Auth::Id();
            $id_desa = Auth::user()->desa;
            $user_desa = User::where('desa',$id_desa)->pluck('id')->toArray();
            $following = User::find($user_id)->following()->pluck('following_id')->toArray();
            $user = array_merge($following,$user_desa);
            $post = Post::where('id','>',$id)->whereIn('user_id',$user)->orderBy('created_at','desc')->get();
        }
        return view('posts.new',['posts' => $post]);
    }
    
    public function getNumLikes($id){
        $like = Like::where([['post_id', $id],['status','Y']])->count();
        return Response()->json(['numLikes' => $like]);
    }
    
    public function getNumComments($id){
        $comment = Comment::where('post_id', $id)->count();
        return Response()->json(['numComments' => $comment]);
    }
    
    public function getNewComment($id, $lastCommentId){
        $comment = Comment::where([['id','>',$lastCommentId],['post_id',$id]])->orderBy('created_at','desc')->get();
        return view('comments.new',['comments' => $comment]);
    }
    
    public function getRecComments($id){
        $numpage = Config::get('global.paginate_number');
        $comments = Comment::where('post_id',$id)->with('user')->orderBy('created_at','desc')->paginate($numpage);
        return view('comments.new',['comments' => $comments]);       
    }
    
    public function getLikers($id){
        $numpage = Config::get('global.likers_number');
        $likes   = Like::where([['post_id',$id],['status','Y']])->with('user')->orderBy('updated_at','desc')->get();
        return view('posts.likers',['post_id' => $id, 'likes' => $likes]);
    }
}
