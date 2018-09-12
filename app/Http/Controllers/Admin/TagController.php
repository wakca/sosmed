<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Datatables;
use App\Tag;
use Validator;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }
    
    public function index()
    {
        return view('admin.tag',['data' => null]);
    }
    
    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        $query = Tag::query();

        return Datatables::eloquent($query)
            ->addColumn('action', function(Tag $tag){
                return "<a href='tag/".$tag->id."/edit' class='btn btn-xs btn-primary'>Edit</a> <a href='javascript:void(0);' onclick='deleteTag(".$tag->id.");' class='btn btn-xs btn-danger'>Hapus</a>";
            })
            ->rawColumns(['action'])->make(true);
    }
    
    public function create(){
        return view('admin.tag',['data' => 'create']);
    }
    
    public function save(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:190'
        ]);
        
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()->all()]);
        }
                
        $tag = Tag::create(['name' => $request->name]);
        return response()->json(['status' => 'success']);
    }
    
    public function edit($id){
        $tag = Tag::find($id);
        return view('admin.tag',['data' => 'edit', 'tag' => $tag]);
    }
    
    public function update(Request $request, $id){
         $validator = Validator::make($request->all(),[
            'name' => 'required|max:190'
        ]);
        
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()->all()]);
        }
                
        $tag = Tag::where('id',$id)->update(['name' => $request->name]);
        return response()->json(['status' => 'success']);
    }
    
    public function destroy($id){
        $tag = Tag::find($id);
        $tag->delete();
        return response()->json(['status' => 'success']);
    }
}
