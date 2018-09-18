<?php

namespace App\Http\Controllers;

use App\Traits\ImageUploader;
use Illuminate\Http\Request;
use App\User;
use App\Provinsi;
use Auth;
use Illuminate\Support\Facades\Storage;
use Session;
use Intervention\Image\ImageManagerStatic as Image;
use IndoTgl;
use File;
use App\Follows;
use Config;
use App\Post;

class ProfileController extends Controller
{
    use ImageUploader;
    public function __construct()
    {
        $this->middleware('auth', ['except'=>['show', 'media', 'posts']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
        $numpaginate= Config::get('global.paginate_number');
        $profil     = User::where('username','=',$username)->with('prov.kab.kec.des')->first();
        if(!isset($profil))
        abort(404);
        $follower   = $profil->followers()->get();
        $following  = $profil->following()->get();
        $follow = Follows::where('following_id', '=', $profil->id)->first();
//        dd();

        if(Auth::check()){
            $follow     = Follows::where([['user_id', Auth::user()->id], ['following_id',$profil->id]])->first();
        }
        $posts      = Post::where([['user_id',$profil->id],['recepient_id',$profil->id]])->orWhere([['user_id','!=',$profil->id],['recepient_id',$profil->id]])->orderBy('created_at','desc')->paginate($numpaginate);
        return view('profile',['profile' => $profil, 'follow' => $follow, 'follower' => $follower, 'following' => $following,'posts' => $posts]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $id = Auth::user()->id;
        $profil = User::find($id);
        $provinsi = Provinsi::all();
        return view('profile.edit',['profil' => $profil,'provinsi' => $provinsi]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'photo' => 'image|mimes:jpeg,jpg,png|max:2048|dimensions:max_width=1920',
            'tgl' => 'required',
            'bln' => 'required',
            'thn' => 'required',
            'name' => 'required|max:255',
            'jk' => 'required',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'alamat' => 'required|max:255',
        ]);
        
        $id = Auth::user()->id;
        $tgl_lahir = $request->thn.'-'.$request->bln.'-'.$request->tgl;
        $previmage = Auth::user()->photo;
        $dest = public_path('/photos');
        $imagename = '';
        if($request->hasFile('photo')){
            $image = $request->file('photo');
            $img = Image::make($image->getRealPath());
            $img->fit(300,300,function ($constraint) {
                $constraint->upsize();
            });
            $ext = $image->getClientOriginalExtension();
//            dd($img);
            $namaFoto = \Webpatser\Uuid\Uuid::generate()->string.'.'.$ext;
            if(Storage::disk('google')->put($namaFoto, $img->encode())){
                $imagename = $namaFoto;

            }
        }
//        $image = $request->photo;
//        if($image != ''){
//            $imagename = time().'.'.$image->getClientOriginalExtension();
//            $img = Image::make($image->getRealPath());
//            $img->fit(300,300,function ($constraint) {
//                $constraint->upsize();
//            });
//            $img->save($dest.'/'.$imagename,50);
//        }
//        else{
//            $imagename = $previmage;
//        }
//        if($previmage != '' && $image != ''){
//            File::delete($dest.'/'.$previmage);
//        }
//        dd($imagename);
        User::where('id',$id)->update([
                      'name' => $request->name,
                      'photo' => $imagename,
                      'jk' => $request->jk,
                      'tgl_lahir' => $tgl_lahir,
                      'provinsi' => $request->provinsi,
                      'kabupaten' => $request->kabupaten,
                      'kecamatan' => $request->kecamatan,
                      'desa' => $request->desa,
                      'alamat' => $request->alamat]);
        Session::flash('message','Profile Berhasil diupdate! Silahkan klik beranda untuk update status terbaru.');
        Session::flash('alert-class','alert-info');
        return redirect()->route('profile.edit');
    }

    public function followers($username){
        $limit      = Config::get('global.follow_number');
        $user_id    = User::where('username',$username)->pluck('id')->first();
        $followers  = User::find($user_id)->followers()->orderBy('follows.updated_at','desc')->paginate($limit);
        $profile    = User::where('username',$username)->first();

        return view('followers',['followers' => $followers, 'profile' => $profile]);
    }
    
    public function following($username){
        $limit      = Config::get('global.follow_number');
        $user_id    = User::where('username',$username)->pluck('id')->first();
        $following  = User::find($user_id)->following()->orderBy('follows.updated_at','desc')->paginate($limit);
        $profile    = User::where('username',$username)->first();
        return view('following',['following' => $following, 'profile' => $profile]);
    }
    
    public function posts($username){
        $numpaginate= Config::get('global.paginate_number');
        $profil     = User::where('username','=',$username)->with('prov.kab.kec.des')->first();
        if(!isset($profil))
        abort(404);
        $follower   = $profil->followers()->get();
        $following  = $profil->following()->get();
        $follow = null;
        if(Auth::check()){
            $follow     = Follows::where([['user_id', Auth::user()->id], ['following_id',$profil->id]])->first();
        }

        $posts      = Post::where('user_id',$profil->id)->orderBy('created_at','desc')->paginate($numpaginate);
        return view('myposts',['profile' => $profil, 'follow' => $follow, 'follower' => $follower, 'following' => $following,'posts' => $posts]);

    }
    
    public function media($username){
        $numpaginate= Config::get('global.paginate_number');
        $profil     = User::where('username','=',$username)->with('prov.kab.kec.des')->first();
        if(!isset($profil))
        abort(404);
        $follower   = $profil->followers()->get();
        $following  = $profil->following()->get();
        $follow = null;
        if(Auth::check()){
            $follow     = Follows::where([['user_id', Auth::user()->id], ['following_id',$profil->id]])->first();
        }

        $posts      = Post::where([['user_id',$profil->id],['has_image','Y']])->orderBy('created_at','desc')->paginate($numpaginate);
        return view('media',['profile' => $profil, 'follow' => $follow, 'follower' => $follower, 'following' => $following,'posts' => $posts]);

    }
    
    public function search(Request $request){
        $provinsi   = Provinsi::all();
        $key        = $request->keyword;
        $limit      = Config::get('global.follow_number');
        $results    = User::where('username','like','%'.$key.'%')->orWhere('name','like','%'.$key.'%')->orderBy('name','asc')->paginate($limit);
        return view('search',['results' => $results, 'provinsi'=>$provinsi, 'oldprov' => '', 'oldkab' => '', 'oldkec' => '','olddes'=>'','oldkey' => $key,'oldjk' => '']);
    }
    
    public function advancedSearch(Request $request){
        $provinsi = Provinsi::all();
        $prov       = $request->provinsi;
        $kab        = $request->kabupaten;
        $kec        = $request->kecamatan;
        $des        = $request->desa;
        $key        = $request->keyword;
        $jk         = $request->jk;
            
        $limit      = Config::get('global.follow_number');
        $results    = User::where(function($query) use ($key){
                                if(!empty($key)){
                                    $query->where('username','like','%'.$key.'%')
                                    ->orWhere('name','like','%'.$key.'%');
                                }
                            })
                            ->where(function($query) use ($prov,$kab,$kec,$des,$jk){
                                if(!empty($prov)){
                                    $query->where('provinsi',$prov);
                                }
                                if(!empty($kab)){
                                    $query->where('kabupaten',$kab);
                                }
                                if(!empty($kec)){
                                    $query->where('kecamatan',$kec);
                                }
                                if(!empty($des)){
                                    $query->where('desa',$des);
                                }
                                if(!empty($jk)){
                                    $query->where('jk',$jk);
                                }
                            })
                            ->orderBy('name','asc')->paginate($limit);
        return view('search',['results' => $results,'provinsi'=>$provinsi,'oldprov' => $prov, 'oldkab' => $kab, 'oldkec' => $kec,'olddes'=>$des,'oldkey' => $key,'oldjk' => $jk]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
