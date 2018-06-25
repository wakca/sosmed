<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comment;
use Validator;
use Datatables;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }
    
    public function index()
    {
        return view('admin.comment',['data' => null]);
    }
    
    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        $query = Comment::with('user')->select('comments.*');

        return Datatables::eloquent($query)
            ->editColumn('content', function(Comment $comment){
                return strlen(strip_tags($comment->content)) > 100 ?substr(strip_tags($comment->content),0,100)."...":strip_tags($comment->content);
            })
            ->addColumn('action', function(Comment $comment){
                return "<a href='comment/".$comment->id."/edit' class='btn btn-xs btn-primary'>Edit</a> <a href='javascript:void(0);' onclick='deleteComment(".$comment->id.");' class='btn btn-xs btn-danger'>Hapus</a>";
            })
            ->rawColumns(['action'])->make(true);
        
    }
    
    public function edit($id){
        $comment = Comment::find($id);
        return view('admin.comment',['data' => 'edit', 'comment' => $comment]);
    }
    
    public function update(Request $request, $id){        
         $validator = Validator::make($request->all(),[
            'content' => 'required',
        ]);
        
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        
        $comment = Comment::where('id',$id)->update(['content' => $request->content]);

        return response()->json(['status' => 'success']);
    }
    
    public function destroy($id){
        $comment = Comment::find($id);
        $comment->delete();
        return Response()->json(['status'=>'success']);
    }
}
