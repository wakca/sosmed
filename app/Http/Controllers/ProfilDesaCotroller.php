<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Provinsi;
use App\Desa;
use App\Story;

class ProfilDesaCotroller extends Controller
{
    public function index($id_desa)
    {
        // return view('desa.profile');
        $desa = Desa::findOrFail($id_desa);

        return view('desa.profile', [
            'desa' => $desa
        ]);
    }

    public function selayang_pandang($id_desa)
    {
        $desa = Desa::findOrFail($id_desa);

        return view('desa.selayang_pandang', [
            'desa' => $desa,
            'data' => $desa->selayang_pandang
        ]);

    }

    public function organisasi($id_desa)
    {
        $desa = Desa::findOrFail($id_desa);

        return view('desa.organisasi', [
            'desa' => $desa,
            'data' => $desa->organisasi
        ]);

    }


    public function dokumen($id_desa)
    {
        $desa = Desa::findOrFail($id_desa);

        return view('desa.dokumen', [
            'desa' => $desa,
            'data' => $desa->dokumen
        ]);

    }

    public function story($id_desa)
    {
        $desa = Desa::findOrFail($id_desa);
        $stories = $desa->stories()->orderBy('created_at','desc')->paginate(5);

        return view('desa.story', [
            'desa' => $desa,
            'stories' => $stories
        ]);
    }

    public function produk($id_desa)
    {
        $desa = Desa::findOrFail($id_desa);
        $produk = $desa->produk_unggulan()->orderBy('created_at','desc')->paginate(8);

        return view('desa.produk', [
            'desa' => $desa,
            'produk' => $produk
        ]);
    }

    public function peta($id_desa)
    {
        $desa = Desa::findOrFail($id_desa);
        $provinsi = Provinsi::all();


        return view('desa.peta', [
            'desa' => $desa,
            'provinsi' => $provinsi
        ]);
    }
}
