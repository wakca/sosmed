<?php

namespace App\Http\Controllers\Api;

use App\Story;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StoryController extends Controller
{
    public function get_story()
    {
        $data = Story::all()->toArray();
        return response()->json(['status'=>'sukses', 'res'=>$data],200);
    }
}
