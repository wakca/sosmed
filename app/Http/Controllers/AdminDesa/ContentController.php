<?php

namespace App\Http\Controllers\AdminDesa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
                'data' => count($this->getDesa()->selayang_pandang)
            ],
            [
                'slug' => 'profil_desa',
                'judul' => 'Profil Desa',
                'data' => count($this->getDesa()->profil_desa)
            ],
            [
                'slug' => 'produk_unggulan',
                'judul' => 'Produk Unggulan',
                'data' => count($this->getDesa()->produk_unggulan)
            ],
            [
                'slug' => 'galeri_desa',
                'judul' => 'Galeri Desa',
                'data' => count($this->getDesa()->galeri_desa)
            ],
            [
                'slug' => 'organisasi_desa',
                'judul' => 'Organisasi Desa',
                'data' => count($this->getDesa()->organisasi_desa)
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
                'data' => count($this->getDesa()->kabar_desa)
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

    public function galeri_desa()
    {

        return view('desa.content.galeri_desa', [
            'data' => $this->getDesa()->galeri_desa
        ]);
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
}
