<?php

namespace App\Http\Controllers;

use App\User;
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
        
        $time = str_replace('_',' ',$data2);
        return Date::parse($time)->ago();
    }

    public function query_user(Request $request)
    {
        $query = $request->get('query');
        $user = '';
        if($query){
            $user = User::where('username', 'like', '%'.$query.'%' )->get()->toArray();
        }

        return json_encode($user);
    }

    public function query_user_name(Request $request)
    {
        $query = $request->get('query');
        $user = '';
        if($query){
            $user = User::where('username', 'like', '%'.$query.'%' )->first();
        }

        return $user->name;
    }
}
