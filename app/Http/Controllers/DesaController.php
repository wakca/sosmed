<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ProdukUnggulan as Produk;
use App\Story;

use Auth;

class DesaController extends Controller
{
    public function index()
    {
        return \App\Desa::first();

        $desa = null;

        $produk = Produk::orderBy('created_at', 'DESC')->take(5)->get();
        $stories = Story::orderBy('created_at', 'DESC')->take(5)->get();

        if(Auth::check())
        {
            $desa = Auth::user()->des;
        }

        return view('desa.index', [
            'desa' => $desa,
            'produk' => $produk,
            'stories' => $stories,
        ]);
    }

    public function suggest(Request $request)
    {
        return response()->json($request->src);
    }
}
