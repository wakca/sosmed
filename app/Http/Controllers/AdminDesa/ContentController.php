<?php

namespace App\Http\Controllers\AdminDesa;

use App\OrganisasiDesa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Google_Service_Drive_DriveFile;
use League\Flysystem\Filesystem;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Hypweb\Flysystem\GoogleDrive\GoogleDriveAdapter;
use App\Traits\ImageUploader;

use Image;
use File;

use App\DokumenDesa;
use App\GaleriDesa;

use Auth;

class ContentController extends Controller
{
    use ImageUploader;

    public function __construct()
    {
        $this->middleware(['auth','admin_desa']);
    }


    private function getDesa()
    {
        return Auth::user()->des;
    }

    private function content($slug)
    {
        $konten = [
            'selayang_pandang' => $this->getDesa()->selayang_pandang,
            'profil_desa' => $this->getDesa()->profil_desa,
            'produk_unggulan' => $this->getDesa()->produk_unggulan,
            'galeri_desa' => $this->getDesa()->galeri_desa,
            'organisasi_desa' => $this->getDesa()->organisasi_desa,
            'dokumen_desa' => $this->getDesa()->dokumen,
            'proyek_desa' => $this->getDesa()->proyek_desa,
            'kabar_desa' => $this->getDesa()->kabar_desa,
        ];

//        switch ($slug) {
//            case 'selayang_pandang' : return ;
//
//            default : return ;
//        }

        return $konten[$slug];
        // return $this->getDesa();
    }

    public function edit($slug)
    {
        $data = $this->content($slug);
        if($slug == 'organisasi_desa'){
            $data = $this->getDesa()->organisasi_desa()->paginate(10);
        }
//        dd($data);
        $option = [
            'data'=>$data,
            'desa'=>$this->getDesa()
        ];

        return view('admin_desa.content.'.$slug, $option);
    }

    public function index()
    {
        $konten = [
            [
                'slug' => 'selayang_pandang',
                'judul' => 'Selayang Pandang',
                'data' => $this->getDesa()->selayang_pandang
            ],
            [
                'slug' => 'profil_desa',
                'judul' => 'Profil Desa',
                'data' => $this->getDesa()->profil_desa
            ],
            [
                'slug' => 'galeri_desa',
                'judul' => 'Galeri Desa',
                'data' => $this->getDesa()->galeri_desa
            ],
            [
                'slug' => 'organisasi_desa',
                'judul' => 'Organisasi Desa',
                'data' => $this->getDesa()->organisasi_desa
            ],
            [
                'slug' => 'dokumen_desa',
                'judul' => 'Dokumen Desa',
                'data' => count($this->getDesa()->dokumen)
            ],
            [
                'slug' => 'proyek_desa',
                'judul' => 'Proyek Desa',
                'data' => count($this->getDesa()->proyek_desa)
            ]
        ];

        return view('admin_desa.content.index', [
            'konten' => $konten
        ]);
    }

    public function selayang_pandang(Request $request)
    {
        $model = $this->getDesa()->selayang_pandang;

        if(!$model)
        {
            $model = new \App\SelayangPandang;
            $model->desa = $this->getDesa()->id;
        }

        
        $content = $request->konten;
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
                $filepath = "images/$filename.$mimetype";    
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
        $model->konten = $content;

        if($model->save())
        {
            return redirect()->route('admin_desa.content');
        }
    }
    
    public function organisasi_desa(Request $request)
    {
        $model = new OrganisasiDesa();
        if($request->has('id_organisasi')){
            $model = OrganisasiDesa::findOrfail($request->get('id_organisasi'));
        }
        $model->desa = $this->getDesa()->id;

        $content = $request->konten;
        $dom = new \DomDocument();
        libxml_use_internal_errors(true);
        $dom->loadHtml('<?xml encoding="utf-8" ?>'.$content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

//        return dd($images[0]->getAttribute('src'));
//
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

        $model->judul = $request->input('judul');
        $model->konten = $content;

        if($model->save())
        {
            return redirect('/admin_desa/konten_desa/edit/organisasi_desa');
        }
    }

    public function organisasi_desa_update(Request $request){
//        $model = $this->getDesa()->organisasi_desa;
//
//        if(!$model)
//        {
            $model = new OrganisasiDesa();
            if($request->has('id_organisasi')){
                $model = OrganisasiDesa::findOrfail($request->get('id_organisasi'));
            }
            $model->desa = $this->getDesa()->id;
//        }

        $content = $request->get('konten');
        $dom = new \DomDocument();
        libxml_use_internal_errors(true);
        $dom->loadHtml('<?xml encoding="utf-8" ?>'.$content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

//        return dd($images[0]->getAttribute('src'));
//
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

        $model->judul = $request->input('judul');
        $model->konten = $content;

        if($model->save())
        {
            return redirect('/admin_desa/konten_desa/edit/organisasi_desa');
        }
    }

    public function kabar_desa(Request $request)
    {
        $model = $this->getDesa()->kabar_desa;

        if(!$model)
        {
            $model = new \App\KabarDesa;
            $model->desa = $this->getDesa()->id;
        }
        $model->konten = $request->input('konten');

        if($model->save())
        {
            return redirect()->route('admin_desa.content');
        }
    }

    public function produk_unggulan(Request $request)
    {
        $model = $this->getDesa()->produk_unggulan;

        if(!$model)
        {
            $model = new \App\ProdukUnggulan;
            $model->desa = $this->getDesa()->id;
        }
        $model->konten = $request->input('konten');

        if($model->save())
        {
            return redirect()->route('admin_desa.content');
        }
    }

    public function galeri_desa(Request $request)
    {
        if ($request->hasFile('link')) {
            // Load new Model
            $model = new GaleriDesa;
            
            $file = $request->file('link');

            $randomNumber = rand(000,999);

            $filename = $randomNumber.$file->getClientOriginalName();

            $destinationPath = 'uploads/galeri_desa/'.$this->getDesa()->id.'/';
            // $pengumuman->gambar = $destinationPath.'/'.$filename;

            $file->move(public_path($destinationPath), $filename);

            $finalDest = $destinationPath.'/'.$filename;
            $filePath = public_path($finalDest);
            // Upload using a stream...
            Storage::disk('google')->put($filename, fopen($filePath, 'r+'));
            
            $model->desa = $this->getDesa()->id;
            $model->judul = $request->input('judul');
            $model->keterangan = $request->input('keterangan');
            $model->link = $finalDest;

            if($model->save())
            {
                return redirect()->back();
            }
        }
        
    }

    public function galeri_desa_update(Request $request)
    {
        // return $request->all();

        $id = $request->input('id_galeri');
        $model = GaleriDesa::findOrFail($id);
        $model->judul = $request->input('judul');
        $model->keterangan = $request->input('keterangan');
        if ($request->hasFile('link')) {
            File::delete(public_path($model->link));
            // Load new Model
            
            $file = $request->file('link');

            $randomNumber = rand(000,999);

            $filename = $randomNumber.$file->getClientOriginalName();

            $destinationPath = 'uploads/galeri_desa/'.$this->getDesa()->id.'/';
            // $pengumuman->gambar = $destinationPath.'/'.$filename;

            $file->move(public_path($destinationPath), $filename);

            $finalDest = $destinationPath.'/'.$filename;
            $filePath = public_path($finalDest);
            // Upload using a stream...
            Storage::disk('google')->put($filename, fopen($filePath, 'r+'));
            
            $model->desa = $this->getDesa()->id;
            $model->judul = $request->input('judul');
            $model->keterangan = $request->input('keterangan');
            $model->link = $finalDest;

            if($model->save())
            {
                return redirect()->back();
            }
        }

        if($model->save())
        {
            return redirect()->back();
        }


        
    }

    public function proyek_desa(Request $request)
    {
//         return $request->all();
        $model = new \App\ProyekDesa;
        $model->desa = $this->getDesa()->id;

        $content = $request->keterangan;
        $dom = new \DomDocument();
        libxml_use_internal_errors(true);
        $dom->loadHtml('<?xml encoding="utf-8" ?>'.$content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

//        return dd($images[0]->getAttribute('src'));
//
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
//        return dd($dom->saveHTML());
        $model->konten = $content;
        $model->tahun = $request->tahun;
        $model->judul = $request->judul;

        if($model->save())
        {
            return redirect('/admin_desa/konten_desa/edit/proyek_desa');
        }
    }

    public function proyek_desa_update(Request $request)
    {
        // return $request->all();
        $model =  \App\ProyekDesa::findOrFail($request->id_proyek);
        $model->desa = $this->getDesa()->id;
        
        $content = $request->keterangan;
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

        $model->konten = $content;
        $model->tahun = $request->tahun;
        $model->judul = $request->judul;

        if($model->save())
        {
            return redirect()->back();
        }
    }

    public function profil_desa(Request $request)
    {
//        $this->validate($request, [
//            'nama'=>'required',
//            'nip'=>'required',
//            'nama_kades'=>'required',
//        ]);

//        dd($request->all());

        $model = $this->getDesa()->profil_desa;
        $desa = $this->getDesa();
        $desa->nip = $request->get('nip');
        $desa->nama_kades = $request->get('nama_kades');
        $desa->map = $request->get('map');
        if(!$model)
        {
            $model = new \App\ProfilDesa;
            $model->desa = $this->getDesa()->id;
        }

        $content = $request->konten;
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
//        dd($request->all());
        $model->konten = $content;

        if($request->hasFile('foto_desa')){

            $desa->foto_desa = $this->uploadImage($request->file('foto_desa'));
        }

        if($request->hasFile('foto_kades')){

            $desa->foto_kades = $this->uploadImage($request->file('foto_kades'));
        }

        if($request->has('link_web')){
            $desa->link_web = strpos($request->get('link_web'), 'http') !== false ? $request->get('link_web') : 'http://'.$request->get('link_web');
        }

        if($model->save() && $desa->save())
        {
            return redirect('/admin_desa/konten_desa/edit/profil_desa');
        }
    }

    public function dokumen_desa(Request $request)
    {
        
        if ($request->hasFile('link')) {
            // Load new Model
            $model = new DokumenDesa;
            
            $file = $request->file('link');

            $randomNumber = rand(000,999);

            $filename = $randomNumber.$file->getClientOriginalName();

            $destinationPath = 'uploads/pengumuman';
            // $pengumuman->gambar = $destinationPath.'/'.$filename;

            $file->move(storage_path($destinationPath), $filename);

            $filePath = storage_path($destinationPath.'/'.$filename);
            // Upload using a stream...
            Storage::disk('google')->put($filename, fopen($filePath, 'r+'));
            
            $model->desa = $this->getDesa()->id;
            $model->tahun = $request->input('tahun');
            $model->judul = $request->input('judul');
            $model->keterangan = $request->input('keterangan');
            $model->link = $filename;

            if($model->save())
            {
                File::delete($filePath);
                return redirect()->back();
            }
        }
    }

    public function dokumen_desa_update(Request $request)
    {
        $id = $request->input('id_desa');
        $model = DokumenDesa::findOrFail($id);
        $model->tahun = $request->input('tahun');
        $model->judul = $request->input('judul');
        $model->keterangan = $request->input('keterangan');
        
        if ($request->hasFile('link')) {
            // Load new Model
            
            $file = $request->file('link');

            $randomNumber = rand(000,999);

            $filename = $randomNumber.$file->getClientOriginalName();

            $destinationPath = 'uploads/pengumuman';
            // $pengumuman->gambar = $destinationPath.'/'.$filename;

            $file->move(storage_path($destinationPath), $filename);

            $filePath = storage_path($destinationPath.'/'.$filename);
            // Upload using a stream...
            Storage::disk('google')->put($filename, fopen($filePath, 'r+'));
            
            $model->desa = $this->getDesa()->id;
            $model->tahun = $request->input('tahun');
            $model->judul = $request->input('judul');
            $model->keterangan = $request->input('keterangan');
            $model->link = $filename;

            if($model->save())
            {
                File::delete($filePath);
                return redirect()->back();
            }
        }

        if($model->save())
        {
            return redirect()->back();
        }
    }

    public function delete_dokumen($id)
    {
        $dokumen = DokumenDesa::findOrFail($id);

        $filename = $dokumen->link;
        // Now find that file and use its ID (path) to delete it
        $dir = '/';
        $recursive = false; // Get subdirectories also?
        $contents = collect(Storage::cloud()->listContents($dir, $recursive));
        $file = $contents
            ->where('type', '=', 'file')
            ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
            ->where('extension', '=', pathinfo($filename, PATHINFO_EXTENSION))
            ->first(); // there can be duplicate file names!
        $deletingFile = Storage::cloud()->delete($file['path']);

        if($deletingFile)
        {
            $dokumen->delete();

            return response()->json([
                'message' => 'Berhasil menghapus Dokumen',
                'status' => 'success'
            ]);
        }
        
    }

    public function delete_galeri($id)
    {
        $galeri = GaleriDesa::findOrFail($id);

        $proses = File::delete(public_path($galeri->link));

        if($proses)
        {
            $galeri->delete();

            return response()->json([
                'message' => 'Berhasil menghapus Dokumen',
                'status' => 'success'
            ]);
        }

        // if($deletingFile)
        // {
        //     $galeri->delete();

        //     return response()->json([
        //         'message' => 'Berhasil menghapus Dokumen',
        //         'status' => 'success'
        //     ]);
        // }
        
    }

    public function delete_organisasi($id)
    {
        $organisasi = OrganisasiDesa::findOrFail($id);

//        $proses = File::delete(public_path($galeri->link));

        if($organisasi->delete()){
            return response()->json([
                'message' => 'Berhasil menghapus Dokumen',
                'status' => 'success'
            ]);
        }




    }

    public function delete_proyek($id)
    {
        $proyek = \App\ProyekDesa::findOrFail($id);

        $proyek->delete();

        return response()->json([
            'message' => 'Berhasil menghapus Proyek',
            'status' => 'success'
        ]);
        
    }

    public function data_dokumen($id)
    {
        $dokumen = DokumenDesa::findOrFail($id);

        return $dokumen;
        
    }

    public function data_galeri($id)
    {
        $data = GaleriDesa::findOrFail($id);

        return $data;
        
    }

    public function data_proyek($id)
    {
        $data = \App\ProyekDesa::findOrFail($id);

        return $data;
        
    }
    public function data_organisasi($id)
    {
        $data = OrganisasiDesa::findOrFail($id);

        return $data;

    }

    public function open_dokumen($id)
    {
        $dokumen = DokumenDesa::findOrFail($id);

        $filename = $dokumen->link;
        $dir = '/';
        $recursive = false; // Get subdirectories also?
        $contents = collect(Storage::disk('google')->listContents($dir, $recursive));
        $file = $contents
        ->where('type', '=', 'file')
        ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
        ->where('extension', '=', pathinfo($filename, PATHINFO_EXTENSION))
        ->first(); // there can be duplicate file names!
        $readStream = Storage::disk('google')->getDriver()->readStream($file['path']);
        return response()->stream(function () use ($readStream) {
            fpassthru($readStream);
        }, 200, [
            'Content-Type' => $file['mimetype'],
            //'Content-disposition' => 'attachment; filename="'.$filename.'"', // force download?
        ]);
    }

    public function delete_file($model, $id)
    {
        
    }
}
