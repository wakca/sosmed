<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class DesaController extends Controller
{
    public function index()
    {
        $desa = null;

        if(Auth::check())
        {
            $desa = Auth::user()->des;
        }

        return view('desa.index', ['desa' => $desa]);
    }

    public function suggest(Request $request)
    {
        return response()->json($request->src);
    }
}
