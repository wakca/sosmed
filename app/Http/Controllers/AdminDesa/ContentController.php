<?php

namespace App\Http\Controllers\AdminDesa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Google_Service_Drive_DriveFile;
use League\Flysystem\Filesystem;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Hypweb\Flysystem\GoogleDrive\GoogleDriveAdapter;

use File;

use App\DokumenDesa;
use App\GaleriDesa;

use Auth;

class ContentController extends Controller
{
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

        return $konten[$slug];
        // return $this->getDesa();
    }

    public function edit($slug)
    {
        $data = $this->content($slug);

        return view('admin_desa.content.'.$slug,[
            'data' => $data, 
        ]);
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
                'slug' => 'produk_unggulan',
                'judul' => 'Produk Unggulan',
                'data' => $this->getDesa()->produk_unggulan
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
            ],
            [
                'slug' => 'kabar_desa',
                'judul' => 'Kabar Desa',
                'data' => $this->getDesa()->kabar_desa
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

        $model->konten = $request->input('konten');

        if($model->save())
        {
            return redirect()->route('admin_desa.content');
        }
    }

    public function organisasi_desa(Request $request)
    {
        $model = $this->getDesa()->organisasi_desa;

        if(!$model)
        {
            $model = new \App\OrganisasiDesa;
            $model->desa = $this->getDesa()->id;
        }
        $model->konten = $request->input('konten');

        if($model->save())
        {
            return redirect()->route('admin_desa.content');
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

    public function proyek_desa()
    {
        return view('desa.content.proyek_desa', [
            'data' => $this->getDesa()->proyek
        ]);
    }

    public function profil_desa(Request $request)
    {
        $model = $this->getDesa()->profil_desa;

        if(!$model)
        {
            $model = new \App\ProfilDesa;
            $model->desa = $this->getDesa()->id;
        }
        $model->konten = $request->input('konten');

        if($model->save())
        {
            return redirect()->route('admin_desa.content');
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

    public function data_dokumen($id)
    {
        $dokumen = DokumenDesa::findOrFail($id);

        return $dokumen;
        
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
