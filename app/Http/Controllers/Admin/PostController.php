<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use Datatables;
use Auth;
use App\Photo;
use File;
use Validator;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }
    
    public function index()
    {
        return view('admin.post',['data' => null]);
    }
    
    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        $post = \DB::table("posts")
          ->select("posts.*",
                    \DB::raw("(SELECT users.name FROM users
                                WHERE users.id = posts.user_id
                                GROUP BY users.id,users.name) as postuser"),
                    \DB::raw("(SELECT count(comments.post_id) FROM comments
                                WHERE comments.post_id = posts.id
                                GROUP BY comments.post_id) as numcomments"),
                    \DB::raw("(SELECT count(likes.post_id) FROM likes
                                WHERE likes.post_id = posts.id
                                GROUP BY likes.post_id) as numlikes"))->get();
        
        return Datatables::of($post)
        ->editColumn('numcomments',function($post){
          return empty($post->numcomments)?"0":$post->numcomments;  
        })
        ->editColumn('numlikes',function($post){
          return empty($post->numlikes)?"0":$post->numlikes;  
        })
        ->editColumn('content',function($post){
            return strlen(strip_tags($post->content)) > 100 ?substr(strip_tags($post->content),0,100)."...":strip_tags($post->content);
        })
        ->addColumn('action', function($post){
            return "<a href='post/".$post->id."/edit' class='btn btn-xs btn-primary'>Edit</a> <a href='javascript:void(0);' onclick='deletePost(".$post->id.");' class='btn btn-xs btn-danger'>Hapus</a>";
        })
        ->rawColumns(['action'])->make(true);
        
    }
    
    public function edit($id){
        $post = Post::find($id);
        return view('admin.post',['data' => 'edit', 'post' => $post]);
    }
    
    public function update(Request $request, $id){        
         $validator = Validator::make($request->all(),[
            'content' => 'required',
        ]);
        
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        
        $post = Post::where('id',$id)->update(['content' => $request->content]);

        return response()->json(['status' => 'success']);
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

}
