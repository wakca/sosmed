<?php

namespace App\Http\Controllers\AdminDesa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Provinsi;
use App\User;

use App\Desa;
use Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','admin_desa']);
    }
    
    public function index(){
        $desa = Auth::user()->des;

        return view('admin_desa.index',[
            'desa' => $desa, 
        ]);
    }
}
