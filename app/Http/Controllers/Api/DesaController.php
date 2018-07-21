<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Desa;

class DesaController extends Controller
{
    public function search($query)
    {
        $desa = Desa::where('id', $query)->orWhere('nama', 'LIKE' ,'%'.$query.'%')->get();


        $data = [
            'query' => $query,
            'desa' => $desa
        ];

        return view('desa.content.suggest', $data);
        
    }
}
