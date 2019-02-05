<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Config;
use Auth;
use App\Post;

class PostController extends Controller
{
    public function get_status()
    {
        $numpage = Config::get('global.story_number');
        $list_post = Post::orderBy('created_at', 'desc')->paginate($numpage);
        return response()->json([
            'list_post'=>$list_post
        ], 201);
//        $list_post =
    }
}
