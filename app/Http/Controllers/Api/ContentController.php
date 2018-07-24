<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Desa;

use App\DokumenDesa;

use Google_Service_Drive_DriveFile;
use League\Flysystem\Filesystem;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Hypweb\Flysystem\GoogleDrive\GoogleDriveAdapter;

use Auth;

class ContentController extends Controller
{
    private function getDesa($id)
    {
        return Desa::findOrFail($id);
    }

    public function selayang_pandang($desa_id)
    {
        $desa = $this->getDesa($desa_id);
        $data = $desa->selayang_pandang;

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
            'data' => $desa->kabar_desa
        ]);
    }

    public function produk_unggulan($desa_id)
    {
        $desa = $this->getDesa($desa_id);

        return view('desa.content.produk_unggulan', [
            'data' => $desa->produk_unggulan
        ]);
    }

    public function produk_unggulan_by_user($user_id)
    {
        $user = Auth::user();
        $desa = $user->des;
        $data = $user->produk;

        return view('desa.content.produk_by_users', [
            'data' => $desa->produk_unggulan
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

    public function dokumen_desa($desa_id)
    {
        $desa = $this->getDesa($desa_id);

        return view('desa.content.dokumen_desa', [
            'desa' => $desa,
            'data' => $desa->dokumen
        ]);
    }

    public function dokumen_desa_by_tahun($desa_id, $tahun)
    {
        $desa = $this->getDesa($desa_id);

        return view('desa.content.dokumen_desa', [
            'desa' => $desa,
            'data' => $desa->dokumen->where('tahun', $tahun)
        ]);
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
}
