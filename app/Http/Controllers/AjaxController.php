<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Date;
use Input;

class AjaxController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function ajaxTime(Request $request){
        $data = json_decode($request->getContent(), true);
        $data2 = json_decode($data['time'],true);
        dd($data2);
        
        $time = str_replace('_',' ',$time);
        return Date::parse($time)->ago();
    }
}
