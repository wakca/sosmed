<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Konten;

use Auth;
use Image;

class KontenController extends Controller
{
    public function index()
    {
        $data = Konten::all();

        return view('admin.konten.index', [
            'data' => $data
        ]);
    }

    public function edit($slug)
    {
        $konten = Konten::where('slug', $slug)->first();

        return view('admin.konten.edit', [
            'konten' => $konten
        ]);
    }

    public function save(Request $request)
    {

        $id = $request->input('id');
        
        $konten = Konten::findOrFail($id);


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

        $konten->content = $content;

        if($konten->save())
        {
            $request->session()->flash('alert-success', 'Berhasil menyimpan Konten Desa');
            return redirect()->route('admin.konten.index');
        }
    }
}
