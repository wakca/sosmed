<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','superadmin']);
    }
    
    public function index(){
        $data = Provinsi::with('user')->orderBy('nama','asc')->get();
        $user = User::where('provinsi','!=','0')->get()->count();
        return view('admin.index',['data' => $data, 'user' => $user]);
    }
}
