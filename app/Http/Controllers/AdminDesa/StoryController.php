<?php

namespace App\Http\Controllers\AdminDesa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Datatables;
use App\Story;
use App\Tag;
use Validator;
use App\Storytag;
use Auth;
use Image;

class StoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','admin_desa']);
    }

    private function getDesa()
    {
        return Auth::user()->des;
    }
    
    public function index()
    {
        return view('admin_desa.story',['data' => null, 'desa' => $this->getDesa()]);
    }
    
    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        $query = Story::select('stories.*')->where('desa', $this->getDesa()->id)->with('tags')->distinct();
        // return $query = Story::select('stories.*')->with('tags')->get();

        return Datatables::eloquent($query)
            ->addColumn('tagname', function (Story $story) {
                return $story->tags->pluck('name')->implode(', ');
            })
            ->addColumn('action', function(Story $story){

                if($story->reported == 'Y'){
                    // return 'reported';
                    return "<a href='javascript:void(0);' onclick='unreportStory(".$story->id.");' class='btn btn-xs btn-success'>Batalkan Report</a>";
                    
                } else {
                    // return 'unreported';
                    return "<a href='javascript:void(0);' onclick='reportStory(".$story->id.");' class='btn btn-xs btn-danger'>Report</a>";

                }

            })
            ->editColumn('content', function(Story $story){
                return strlen(strip_tags($story->content)) > 100 ?substr(strip_tags($story->content),0,100)."...":strip_tags($story->content);
            })
            ->rawColumns(['action'])->make(true);
    }
    
    public function edit($id){
        $story = Story::find($id);
        $tags = Tag::all();
        return view('admin_desa.story',['data' => 'edit', 'tags' => $tags, 'story' => $story]);
    }
    
    public function update(Request $request, $id){
        $removedfiles = $request->rfile;
        
        $validator = Validator::make($request->all(),[
            'title' => 'required|max:190',
            'content' => 'required',
            'tags' => 'required'
        ]);
        
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        
        if($removedfiles[0] != ''){
            foreach($removedfiles as $rfile){
                $imgid = explode('_',$rfile);
                if($imgid[0] == Auth::Id()){
                    $dest   = public_path('/images');
                    File::delete($dest.'/'.$rfile);
                }
            }
        }
        $content = $request->content;
        $dom = new \DomDocument();
        libxml_use_internal_errors(true);
        $dom->loadHtml('<?xml encoding="utf-8" ?>'.$content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
        $images = $dom->getElementsByTagName('img');

        foreach($images as $k => $img){
            $data = $img->getAttribute('src');
            // if the img source is 'data-url'
            if(preg_match('/data:image/', $data)){                
                // get the mimetype
                preg_match('/data:image\/(?<mime>.*?)\;/', $data, $groups);
                $mimetype = $groups['mime'];                
                // Generating a random filename
                $filename = Auth::Id().'_'.md5(time().$k.Auth()->Id());
                $filepath = "/images/$filename.$mimetype";    
                // @see http://image.intervention.io/api/
                $image = Image::make($data)
                  // resize if required
                  /* ->resize(300, 200) */
                  ->encode($mimetype, 100)  // encode file to the specified mimetype
                  ->save(public_path($filepath),50);                
                $new_src = asset($filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
            } // <!--endif
        }
        $content = $dom->saveHTML();
        
        $story = Story::where('id',$id)->update(['title' => $request->title,
                                                 'content' => $content
                                                 ]);
        Storytag::where('story_id',$id)->delete();
        foreach($request->tags as $tag){
            Storytag::create(['story_id' => $id, 'tag_id' => $tag]);
        }
        return response()->json(['status' => 'success']);
    }
    
    public function report($id){

        $story = Story::find($id);
        $story->reported = 'Y';

        if($story->save())
        {
            return response()->json([
                'message' => 'Berhasil mereport Story #'.$story->id,
                'status' => 'success'
            ]);
        }
    }

    public function unreport($id){

        $story = Story::find($id);
        $story->reported = 'N';

        if($story->save())
        {
            return response()->json([
                'message' => 'Berhasil membatalkan aksi report untuk Story #'.$story->id,
                'status' => 'success'
            ]);
        }
    }
    
    public function remove($image){
        $dest   = public_path('/images');
        File::delete($dest.'/'.$image);
        return response()->json(['status' => 'success']);
    }
}
