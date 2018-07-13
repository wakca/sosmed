<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Desa;

class ContentController extends Controller
{
    private function getDesa($id)
    {
        return Desa::findOrFail($id);
    }

    public function selayang_pandang($desa_id)
    {
        $desa = $this->getDesa($desa_id);
        $data = $desa->selayang_pandang->konten;

        return view('desa.content.selayang_pandang', [
            'data' => $data
        ]);
    }

    public function organisasi_desa($desa_id)
    {
        $desa = $this->getDesa($desa_id);
        $data = $desa->organisasi_desa;

        return view('desa.content.organisasi_desa', [
            'data' => $desa->organisasi_desa
        ]);
    }

    public function kabar_desa($desa_id)
    {
        $desa = $this->getDesa($desa_id);

        return view('desa.content.kabar_desa', [
            'data' => $desa->kabar_desa->konten
        ]);
    }

    public function produk_unggulan($desa_id)
    {
        $desa = $this->getDesa($desa_id);

        return view('desa.content.produk_unggulan', [
            'data' => $desa->produk_unggulan->konten
        ]);
    }

    public function galeri_desa($desa_id)
    {
        $desa = $this->getDesa($desa_id);
        $data = $desa->galeri_desa;

        return view('desa.content.galeri_desa', [
            'data' => $desa->galeri_desa
        ]);
    }

    public function proyek_desa($desa_id)
    {
        $desa = $this->getDesa($desa_id);

        return view('desa.content.proyek_desa', [
            'data' => $desa->proyek
        ]);
    }

    public function profil_desa($desa_id)
    {
        $desa = $this->getDesa($desa_id);

        return view('desa.content.profil_desa', [
            'desa' => $desa,
            'data' => $desa->profil
        ]);
    }
}
