<?php

namespace App\Http\Controllers\AdminDesa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Datatables;

use Auth;

class UserController extends Controller
{
    private function getDesa()
    {
        return Auth::user()->des;
    }

    public function index()
    {
        return view('admin_desa.user',['data' => null]);
    }

    public function anyData()
    {
        $user = \DB::table("users")
                    ->select("users.*",
                    \DB::raw("(SELECT count(posts.user_id) FROM posts
                                WHERE posts.user_id = users.id
                                GROUP BY posts.user_id) as numposts"),
                    \DB::raw("(SELECT count(follows.following_id) FROM follows
                                WHERE follows.following_id = users.id AND follows.status = 'Y'
                                GROUP BY follows.following_id) as numfollowers"),
                    \DB::raw("(SELECT count(follows.user_id) FROM follows
                                WHERE follows.user_id = users.id AND follows.status = 'Y'
                                GROUP BY follows.user_id) as numfollowing"))
                                ->where('desa', $this->getDesa()->id)->get();
        
        
        
        return Datatables::of($user)
            ->editColumn('username',function($user){
                // return $this->getDesa()->admin_id;
                if($this->getDesa()->admin_id == $user->id)
                {
                    return "<a href='/".$user->username."' class='btn btn-xs btn-info'><i class='fa fa-check'></i>@".$user->username."</a>";
                } else {
                    return "@".$user->username;
                } 
            })
            ->editColumn('numposts',function($user){
              return empty($user->numposts)?"0":$user->numposts;  
            })
            ->editColumn('numfollowers',function($user){
              return empty($user->numfollowers)?"0":$user->numfollowers;  
            })
            ->editColumn('numfollowing',function($user){
              return empty($user->numfollowing)?"0":$user->numfollowing;  
            })
            // ->addColumn('action', function($user){
            //     return "<a href='user/".$user->id."/edit' class='btn btn-xs btn-primary'>Edit</a> <a href='javascript:void(0);' onclick='deleteUser(".$user->id.");' class='btn btn-xs btn-danger'>Hapus</a>";
            // })
            ->rawColumns(['action', 'username'])->make(true);
        
    }
}
