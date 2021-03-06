<?php

namespace App\Http\Controllers;

use App\OrganisasiDesa;
use App\PesanWarga;
use App\ProyekDesa;
use Illuminate\Http\Request;

use App\Provinsi;
use App\Desa;
use App\Story;

use Auth;
use Cache;

class ProfilDesaController extends Controller
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
        $list_organisasi = OrganisasiDesa::where('desa', '=', $id_desa)->paginate(10);
        return view('desa.organisasi', [
            'desa' => $desa,
            'list_organisasi' => $list_organisasi
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

    public function proyek($id_desa)
    {
        $desa = Desa::findOrFail($id_desa);
        $proyek = $desa->proyek_desa()->orderBy('created_at','desc')->paginate(10);

        return view('desa.proyek', [
            'desa' => $desa,
            'list_proyek' => $proyek
        ]);
    }

    public function detail_proyek($id_desa, $id_proyek)
    {
        $desa = Desa::findOrFail($id_desa);
        $proyek = ProyekDesa::findOrFail($id_proyek);
        return view('desa.detail_proyek', [
            'desa' => $desa,
            'proyek' => $proyek
        ]);
    }

    public function kontak($id_desa, Request $request)
    {
        $desa = Desa::findOrFail($id_desa);
        $provinsi = Provinsi::all();


        return view('desa.kontak', [
            'desa' => $desa,
            'provinsi' => $provinsi
        ]);
    }

    public function simpanSubmitKontak($id_desa, Request $request)
    {
        $this->validate($request, [
            'nama_lengkap'=>'required|min:2',
            'email'=>'required|email',
            'subjek'=>'required',
            'pesan'=>'required'
        ]);
//        dd($request->all());
        $pesan = new PesanWarga();
        if($request->get('id')){
            $pesan = PesanWarga::findOrFail($request->get('id'));
        }

        $pesan->nama_lengkap = $request->get('nama_lengkap');
        $pesan->email = $request->get('email');
        $pesan->subjek = $request->get('subjek');
        $pesan->pesan = $request->get('pesan');
        $pesan->desa_id = $id_desa;

        if($pesan->save()){
            return redirect()->route('profil_desa.kontak', $id_desa)->with('sukses', 'Berhasil Mengirim Pesan Ke Desa. Silahkan cek email anda untuk respon pada setiap desa!');
        }
    }

    public function kirim_pesan(Request $request)
    {
        // return $request->all();

        $pesan = Cache::put('pesan', $request->input('pesan'), 60);
        $desa_id = $request->input('desa_id');

        // return Cache::get('pesan');

        $desa = Desa::findOrFail($desa_id);

        if(Auth::check())
        {
            return 'Anda sudah login';
        }
        else
        {
            return redirect()->route('login');
            return 'Anda belum Login';
        }


    }

    public function detail_organisasi($id_desa, $id_proyek)
    {
        $desa = Desa::findOrFail($id_desa);
        $organisasi= OrganisasiDesa::findOrFail($id_proyek);
        return view('desa.detail_organisasi', [
            'desa' => $desa,
            'organisasi' => $organisasi
        ]);
    }
}
