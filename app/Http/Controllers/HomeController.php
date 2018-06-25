<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;
use Session;
use App\User;
use App\Story;
use Date;
use Config;
use App\Tag;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(){
        $numpage = Config::get('global.story_number');
        $stories = Story::orderBy('created_at','desc')->paginate($numpage);
        $tags = Tag::all();
        return view('index', ['stories' => $stories, 'tags' => $tags]);    
    }
    
    public function beranda()
    {
        $numpage = Config::get('global.paginate_number');
        $user_id = Auth::Id();
        $profile = User::where('id',$user_id)->first();
        $id_desa = Auth::user()->desa;
        $user_desa = User::where('desa',$id_desa)->pluck('id')->toArray();
        $following = User::find($user_id)->following()->pluck('following_id')->toArray();
        $user = array_merge($user_desa,$following);
        $post = Post::whereIn('user_id',$user)->orWhere([['user_id','!=',$user_id],['recepient_id',$user_id]])->with('user')->orderBy('created_at','desc')->paginate($numpage);
        return view('home',['posts' => $post,'profile' => $profile]);
    }
}
