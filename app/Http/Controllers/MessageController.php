<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use Date;
use Auth;
use Config;
use App\User;
use Getter;
use Validator;
use App\Image;
use Intervention\Image\ImageManagerStatic as Img;

use Cache;
use App\Desa;

class MessageController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    
    public function index(){
        $id = Auth::user()->id;
        $profil = User::find($id);
        $users  = Message::where([['user_id',$id],['del_sender','N']])->orWhere([['recepient_id',$id],['del_receiver','N']])->orderBy('created_at','desc')->get()->unique('conversation_id');
        return view('messages',['profile'=>$profil,'users' => $users]);
    }
    
    public function read($username){
        $id = Auth::user()->id;
        $receiver = User::where('username',$username)->first();
        $profil = User::find($id);
        return view('viewmessage',['profile'=>$profil,'receiver'=>$receiver]);
    }
    
    public function listMessage($username){
        $id = Auth::Id();
        $receiver = User::where('username',$username)->first();
        $profil = User::find($id);
        $readed = Message::where([['user_id',$receiver->id],['recepient_id',$id]])->update(['read'=>'Y']);
        $message = Message::where([['user_id',$id],['recepient_id',$receiver->id],['del_sender','N']])->orWhere([['user_id',$receiver->id],['recepient_id',$id],['del_receiver','N']])->orderBy('created_at','asc')->get();
        return view('messages.list',['profile'=>$profil,'receiver'=>$receiver,'messages'=>$message]);
    }
    
    public function send(Request $request){
        $conversation_id = Getter::getMaxConversationId();
        if($conversation_id == 0){
            $conversation_id = 1;
        }
        else{
            $conversation_id = Getter::getConversationId($request->user_id,$request->recepient_id);
        }
        $files = $request->photos;
        $file_count = count($files);
        $uploadcount = 0;

        if($files[0] != ''){
            
            $message = Message::create(['message' => $request->message, 'user_id' => $request->user_id,'recepient_id' => $request->recepient_id, 'conversation_id' => $conversation_id,'has_image' => 'Y']);
   
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
                    Image::create(['image' => $filename, 'message_id' => $message->id, 'user_id' => $request->user_id]);
                    $uploadcount ++;
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
            $message = Message::create(['message' => $request->message, 'user_id' => $request->user_id,'recepient_id' => $request->recepient_id, 'conversation_id' => $conversation_id,'has_image' => 'N']);
            return response()->json(['has_image' => 'N']);
        }
    }
    
    public function delete($id){
        $message = Message::find($id);
        if($message->user_id == Auth::Id()){
            $message->update(['del_sender'=>'Y']);
        }
        else{
            $message->update(['del_receiver' => 'Y']);
        }
        return Response()->json(['status'=>'success']);
    }
    public function deleteAll($id){
        $user_id = Auth::Id();
        Message::where([['conversation_id',$id],['user_id',$user_id]])->update(['del_sender' => 'Y']);
        Message::where([['conversation_id',$id],['recepient_id',$user_id]])->update(['del_receiver' => 'Y']);
        return Response()->json(['status'=>'success']);
    }


    public function send_message(Request $request)
    {
        // return $request->all();

        $pesan = Cache::put('pesan', $request->input('pesan'), 60);
        $get_pesan = Cache::get('pesan');
        $desa_id = $request->input('desa_id');

        // return Cache::get('pesan');

        $desa = Desa::findOrFail($desa_id);

        if(Auth::check())
        {
            $pengurus = $desa->penduduk()->where('level', 2)->get();
            
            $conversation_id = Getter::getMaxConversationId();
            if($conversation_id == 0){
                $conversation_id = 1;
            }
            else{
                $conversation_id = Getter::getConversationId($request->user_id,$request->recepient_id);
            }
            
            foreach($pengurus as $recepient)
            {
                $message = Message::create(['message' => $get_pesan, 'user_id' => Auth::user()->id,'recepient_id' => $recepient->id, 'conversation_id' => $conversation_id,'has_image' => 'N']);
            }

            $data = [
                'status' => 'success',
                'message' => 'Pesan Anda telah berhasil dikirim ke Admin Desa'
            ];

            Cache::flush();
            
            // return response()->json($desa);
            return redirect()->back();
   
        }
        else
        {
            return redirect()->to('/login');
        }
    }
}
