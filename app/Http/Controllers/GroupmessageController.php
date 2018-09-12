<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Groupmessage;
use Date;
use App\Groupchat;
use App\Groupmember;
use Image;
use Auth;
use App\User;
use App\Groupimage;
use Validator;
use Intervention\Image\ImageManagerStatic as Img;
use DBFunction;

class GroupmessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function post(Request $request){
        $files = $request->photos;
        $file_count = count($files);
        $uploadcount = 0;
        
        //save notif group
        $members = Groupmember::where([['group_id',$request->group_id],['user_id','!=',Auth::Id()]])->get();
        foreach($members as $member){
            DBFunction::saveNotifgroup($member->user_id,$request->group_id,'N');
        }
            
        if($files[0] != ''){
            
            $message = Groupmessage::create(['message' => $request->message, 'user_id' => $request->user_id, 'group_id' => $request->group_id,'has_image' => 'Y']);

            foreach($files as $file){
                $validator = Validator::make(array('photos'=>$file), [ 
                    'photos' => 'required|image|mimes:jpeg,jpg,png|max:2048|dimensions:max_width=1920'
                ]);
                if($validator->passes()){
                    $dest = public_path('/photos');
                    $imgname  = md5(time().$uploadcount.$request->user_id);
                    $filename = $imgname.'.'.$file->getClientOriginalExtension();
                    $filename_small = 'small_'.$imgname.'.'.$file->getClientOriginalExtension();

                    $img = Img::make($file->getRealPath());
                    $img->fit(150,150,function ($constraint) {
                        $constraint->upsize();
                    });
                    $img->save($dest.'/'.$filename_small,50);
                    $img2 = Img::make($file->getRealPath());
                    $img2->save($dest.'/'.$filename,50);
                    Groupimage::create(['image' => $filename, 'message_id' => $message->id, 'user_id' => $request->user_id]);
                    $uploadcount++;
                }
                else{
                     return response()->json(['error'=>$validator->errors()->all()]);
                }
            }
            if($uploadcount == $file_count){
                return response()->json(['success'=>'done']);
            } 
            else {
                return response()->json(['error'=> ($file_count-$uploadcount).' gagal diupload.']);
            }
        }
        else{
            $message = Groupmessage::create(['message' => $request->message, 'user_id' => $request->user_id, 'group_id' => $request->group_id,'has_image' => 'N']);
            return response()->json(['has_image' => 'N']);
        }
    }
    
    public function listMessage($id){
        $user_id = Auth::Id();
        $profil = User::find($user_id);
        $message = Groupmessage::where('group_id',$id)->orderBy('created_at','asc')->get();
        return view('groupchat.list',['profile'=>$profil,'messages'=>$message]);
    }
    
}
