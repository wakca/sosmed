<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;

class AccountController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function edit(){
        $id = Auth::user()->id;
        $account = User::find($id);
        return view('account.edit',['account' => $account]);
    }
    
    public function update(Request $request){
        $id = Auth::user()->id;

        $this->validate($request, [
            'email' => 'required|email|max:255|unique:users,email,'.$id,
            'password' => ($request->password != '' ?'required|min:6|confirmed':''),
        ]);
        
        if($request->password != ''){
            $password = bcrypt($request->password);
        }
        else{
            $password = Auth::user()->password;
        }
        User::where('id',$id)->update([
                      'email' => $request->email,
                      'password' => $password,
                      ]);
        Session::flash('message','Account Berhasil diupdate!');
        Session::flash('alert-class','alert-info');
        return redirect()->route('account.edit');  
    }
}
