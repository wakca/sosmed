<?php

namespace App\Http\Controllers\Story;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Story;
use App\Storycomment;
use Auth;
use Validator;
use Image;
use Config;
use File;
use App\Tag;
use App\Storytag;
use App\Storyimage;


class StoryController extends Controller
{

    public function index(){
        $numpage = Config::get('global.paginate_number');
        $profile = User::where('id',Auth::Id())->first();
        $stories = Story::where('user_id',Auth::Id())->orderBy('created_at','desc')->simplePaginate($numpage);
        return view('story', ['data' => 'null','profile' => $profile, 'stories' => $stories]);
    }
    
    public function tag($tag){
        $numpage = Config::get('global.story_number');
        $tag = Tag::where('name',$tag)->first();
        $stories = $tag->stories()->orderBy('created_at','desc')->paginate($numpage);
        $tags = Tag::all();
        return view('tag', ['stories' => $stories, 'tags' => $tags]); 
    }
    
    public function view($slug){
        $numpage = Config::get('global.paginate_number');
        $story = Story::where('slug',$slug)->first();
        $profile = User::where('id',$story->user->id)->first();
        $comments = Storycomment::where('story_id',$story->id)->orderBy('created_at','asc')->simplePaginate($numpage);
        $random = Story::where('slug','!=',$slug)->inRandomOrder()->take(5)->get();
        return view('story',['data' => 'view', 'story' => $story, 'profile' => $profile, 'random' => $random, 'comments' => $comments]);
    }
    
    public function create(){
        $profile = User::where('id',Auth::Id())->first();
        $tags = Tag::all();
        return view('story', ['data' => 'create','tags' => $tags, 'profile' => $profile]);
    }
    
    public function save(Request $request){        
        $validator = Validator::make($request->all(),[
            'title' => 'required|max:190',
            'content' => 'required',
            'tags' => 'required',
        ]);
        
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()->all()]);
        }
    
        $content = $request->content;
        $dom = new \DomDocument();
        libxml_use_internal_errors(true);
        $dom->loadHtml('<?xml encoding="utf-8" ?>'.$content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
        $images = $dom->getElementsByTagName('img');

        $gambar = [];

        foreach($images as $k => $img){
            $data = $img->getAttribute('src');
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

                array_push($gambar, $filepath);
                
                $new_src = asset($filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
            } // <!--endif
        }
        $content = $dom->saveHTML();
        $story = Story::create(['title' => $request->title, 'content' => $content,  'desa' => Auth::user()->desa, 'user_id' => Auth::Id()]);
        $slug = $story->id."-".str_slug($request->title,"-");                    
        Story::where('id',$story->id)->update(['slug' => $slug]);

        foreach($gambar as $list_gambar){
            Storyimage::create(['story_id' => $story->id, 'image' => $list_gambar]);
        }

        foreach($request->tags as $tag){
            Storytag::create(['story_id' => $story->id, 'tag_id' => $tag]);
        }
        return response()->json(['status'=>'success']);
    }
    
    public function edit($id){
        $story = Story::find($id);
        $profile = User::where('id',Auth::Id())->first();
        $tags = Tag::all();
        return view('story',['data' => 'edit', 'tags' => $tags, 'profile' => $profile, 'story' => $story]);
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

        $gambar = [];

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

                array_push($gambar, $filepath);

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

        Storyimage::where('story_id',$id)->delete();
        foreach($gambar as $list_gambar){
            Storyimage::create(['story_id' => $id, 'image' => $list_gambar]);
        }

        Storytag::where('story_id',$id)->delete();
        foreach($request->tags as $tag){
            Storytag::create(['story_id' => $id, 'tag_id' => $tag]);
        }
        return response()->json(['status' => 'success']);
    }
    
    public function destroy($id){
        $story = Story::find($id);
        $content = $story->content;
        $dom = new \DomDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML('<?xml encoding="utf-8" ?>'.$content,  LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');
        $dest   = public_path('/images');
        foreach($images as $k => $img){
            $data = $img->getAttribute('src');
            if(preg_match('/images/', $data)){
                $data = explode('images',$data);
                $image = str_replace("/","",$data[1]);
                File::delete($dest.'/'.$image);
            }
        }
        $story->delete();
        return response()->json(['status' => 'success']);
    }
    
    public function remove($image){
        $dest   = public_path('/images');
        File::delete($dest.'/'.$image);
        return response()->json(['status' => 'success']);
    }
}
