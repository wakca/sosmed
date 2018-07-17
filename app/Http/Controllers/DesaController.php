<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DesaController extends Controller
{
    public function index()
    {
        return view('desa.index', ['desa' => null]);
    }

    public function suggest(Request $request)
    {
        return response()->json($request->src);
    }
}
