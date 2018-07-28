<?php

namespace App\Http\Controllers\Desa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\ProdukUnggulan as Produk;

use Image;
use File;
use Validator;

use Auth;
use Config;

class ProdukController extends Controller
{

    private function getUser()
    {
        return Auth::user();
    }

    public function index()
    {

        $produk = $this->getUser()->produk;
        $desa = $this->getUser()->des;

        return view('desa.produk.index', [
            'produk' => $produk,
            'desa' => $desa
        ]);
    }

    public function view($slug){
        $numpage = Config::get('global.paginate_number');
        $story = Story::where('slug',$slug)->first();
        $profile = User::where('id',$story->user->id)->first();
        $comments = Storycomment::where('story_id',$story->id)->orderBy('created_at','asc')->simplePaginate($numpage);
        $random = Story::where('slug','!=',$slug)->inRandomOrder()->take(5)->get();
        return view('story',['data' => 'view', 'story' => $story, 'profile' => $profile, 'random' => $random, 'comments' => $comments]);
    }

    public function detail($id)
    {
        $numpage = Config::get('global.paginate_number');
        $random = Produk::where('id','!=',$id)->inRandomOrder()->take(5)->get();

        $produk = Produk::findOrFail($id);

        return view('desa.produk.detail', [
            'produk' => $produk,
            'random' => $random
        ]);
    }

    public function create()
    {
        return view('desa.produk.create');
    }

    public function save(Request $request){     
        
        // return $request->all();

        $validator = Validator::make($request->all(),[
            'nama' => 'required|max:190',
            'konten' => 'required',
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
                $filepath = "/produk_unggulan/$filename.$mimetype";    
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
        $produk = new Produk;
        $produk->desa = Auth::user()->des->id;
        $produk->user_id = Auth::user()->id;
        $produk->konten = $request->input('konten');
        $produk->nama = $request->input('nama');

        if($produk->save())
        {
            return redirect()->route('desa.produk');
            // return response()->json(['status'=>'success']);
        }
    }
    
    public function edit($id){
        $produk = Produk::find($id);
        return view('desa.produk.edit', [
            'produk' => $produk
        ]);
    }
    
    public function update(Request $request){

        $removedfiles = $request->rfile;
        
        $validator = Validator::make($request->all(),[
            'nama' => 'required|max:190',
            'konten' => 'required',
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
        
        
        $produk = Produk::findOrFail($request->input('id'));
        $produk->desa = Auth::user()->des->id;
        $produk->user_id = Auth::user()->id;
        $produk->konten = $request->input('konten');
        $produk->nama = $request->input('nama');

        if($produk->save())
        {
            return redirect()->route('desa.produk');
            // return response()->json(['status'=>'success']);
        }
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
