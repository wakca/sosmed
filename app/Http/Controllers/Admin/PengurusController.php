<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Provinsi;
use App\Kabupaten;
use App\Kecamatan;
use App\Desa;
use Datatables;
use Validator;
use Image;
use File;

class PengurusController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }
    
    public function index()
    {   
        return view('admin.pengurus',['data' => null]);
    }

    public function kabupaten($id_provinsi)
    {   
        $provinsi = Provinsi::where('id', $id_provinsi)->first();

        return view('admin.kabupaten',['data' => null, 'provinsi' => $provinsi]);
    }
    
    public function kecamatan($id_kabupaten)
    {   
        $kabupaten = Kabupaten::where('id', $id_kabupaten)->first();

        return view('admin.kecamatan',['data' => null, 'kabupaten' => $kabupaten]);
    }

    public function desa($id_kecamatan)
    {   
        $kecamatan = Kecamatan::where('id', $id_kecamatan)->first();

        return view('admin.desa',['data' => null, 'kecamatan' => $kecamatan]);
    }

    public function dataProvinsi()
    {
        $provinsi = \DB::table("provinsi")
                    ->select("*")->get();
        
        return Datatables::of($provinsi)
            ->addColumn('action', function($user){
                return "<a href='/admin/pengurus/kabupaten/".$user->id."' class='btn btn-xs btn-primary'>Pilih</a>";
            })
            ->rawColumns(['action'])->make(true);
    }

    public function dataKabupaten($id_provinsi)
    {
        $kabupaten = \DB::table('kabupaten')
        ->where('id_provinsi', $id_provinsi);
        
        return Datatables::of($kabupaten)
            ->addColumn('action', function($kabupaten){
                return "<a href='/admin/pengurus/kecamatan/".$kabupaten->id."' class='btn btn-xs btn-primary'>Pilih</a>";
            })
            ->rawColumns(['action'])->make(true);
    }

    public function dataKecamatan($id_kabupaten)
    {
        $kecamatan = \DB::table('kecamatan')
        ->where('id_kabupaten', $id_kabupaten);
        
        return Datatables::of($kecamatan)
            ->addColumn('action', function($kecamatan){
                return "<a href='/admin/pengurus/desa/".$kecamatan->id."' class='btn btn-xs btn-primary'>Pilih</a>";
            })
            ->rawColumns(['action'])->make(true);
    }

    public function dataDesa($id_kecamatan)
    {
        $desa = \DB::table('desa')
        ->where('id_kecamatan', $id_kecamatan);
        // $desa = Desa::find($id_kecamatan);
        return Datatables::of($desa)
            ->addColumn('action', function($desa){
                return "<a href='/admin/pengurus/kecamatan/".$desa->id."' class='btn btn-xs btn-primary'>Pilih Pengurus</a>";
            })
            ->addColumn('pengurus',function($desa){
                // return $label = '11';
                if($desa->admin_id)
                {
                    $pengurus = \App\User::where('id', $desa->admin_id)->first();
                    return "<a class='btn btn-xs btn-info'>".$pengurus->name ." / @".$pengurus->username."</a>";
                } else {
                    return "<badge class='badge badge-danger'>Belum memiliki Pengurus</badge>";
                }
            })
            ->rawColumns(['action', 'pengurus'])->make(true);
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
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
                                GROUP BY follows.user_id) as numfollowing"))->get();
        
        
        
        return Datatables::of($user)
            ->editColumn('numposts',function($user){
              return empty($user->numposts)?"0":$user->numposts;  
            })
            ->editColumn('numfollowers',function($user){
              return empty($user->numfollowers)?"0":$user->numfollowers;  
            })
            ->editColumn('numfollowing',function($user){
              return empty($user->numfollowing)?"0":$user->numfollowing;  
            })
            ->addColumn('action', function($user){
                return "<a href='user/".$user->id."/edit' class='btn btn-xs btn-primary'>Edit</a> <a href='javascript:void(0);' onclick='deleteUser(".$user->id.");' class='btn btn-xs btn-danger'>Hapus</a>";
            })
            ->rawColumns(['action'])->make(true);
        
    }
    
    public function edit($id){
        $user = User::find($id);
        $provinsi = Provinsi::all();
        return view('admin.user',['data' => 'edit', 'user' => $user, 'provinsi' => $provinsi]);
    }
    
    public function update(Request $request, $id){        
        $validator = Validator::make($request->all(), [
            'photo' => ($request->photo != '' ?'image|mimes:jpeg,jpg,png|max:2048|dimensions:max_width=1920':''),
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
            'email' => 'required|email|max:255|unique:users,email,'.$id,
            'password' => ($request->password != '' ?'required|min:6|confirmed':''),
        ]);
        
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        
        if($request->password != ''){
            $password = bcrypt($request->password);
        }
        else{
            $password = User::find($id)->password;
        }
        
        $tgl_lahir = $request->thn.'-'.$request->bln.'-'.$request->tgl;
        $previmage = User::find($id)->photo;
        $dest = public_path('/photos');
        $image = $request->photo;
        if($image != ''){
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $img = Image::make($image->getRealPath());
            $img->fit(300,300,function ($constraint) {
                $constraint->upsize();
            });
            $img->save($dest.'/'.$imagename,50);
        }
        else{
            $imagename = $previmage;
        }
        if($previmage != '' && $image != ''){
            File::delete($dest.'/'.$previmage);
        }
        
        User::where('id',$id)->update([
                      'name' => $request->name,
                      'photo' => $imagename,
                      'jk' => $request->jk,
                      'tgl_lahir' => $tgl_lahir,
                      'provinsi' => $request->provinsi,
                      'kabupaten' => $request->kabupaten,
                      'kecamatan' => $request->kecamatan,
                      'desa' => $request->desa,
                      'alamat' => $request->alamat,
                      'email' => $request->email,
                      'password' => $password]);
        
        return response()->json(['status' => 'success']);
    }
    
    public function destroy($id){
        $user = User::find($id);
        $user->delete();
        return Response()->json(['status'=>'success']);
    }
}
