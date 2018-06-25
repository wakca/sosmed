<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provinsi;
use App\Kabupaten;
use App\Kecamatan;
use App\Desa;

class LocationController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function getKab($id){
        $kab = Kabupaten::where('id_provinsi',$id)->orderBy('nama','asc')->get();
        return response()->json($kab);
    }
    
    public function getKec($id){
        $kec = Kecamatan::where('id_kabupaten',$id)->orderBy('nama','asc')->get();
        return response()->json($kec);
    }
    
    public function getDesa($id){
        $desa = Desa::where('id_kecamatan',$id)->orderBy('nama','asc')->get();
        return response()->json($desa);
    }
}
