<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Groupchat;
use App\Groupmember;
use Auth;
use App\User;
use DBFunction;

class GroupchatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $id = Auth::Id();
        $profil = User::find($id);
        $groupchat = Groupmember::where('user_id',Auth::Id())->join('groupchats','groupmembers.group_id','=','groupchats.id')->with('group')->orderBy('groupchats.created_at','desc')->get();
        return view('groupchat',['profile'=>$profil, 'groupchats' => $groupchat]);
    }
    
    public function autocomplete(Request $request){
        $data = User::select('id','username','name')->where([['name','like','%'.$request->groupmember.'%'],['id','!=',Auth::Id()]])->get();
        return response()->json($data);
    }
    
    public function create(Request $request){
        $groupchat = Groupchat::create(['name' => $request->groupname, 'admin_id' => Auth::Id()]);
        for($i = 0;$i < sizeof($request->groupmember);$i++){
            $groupmember = Groupmember::create(['user_id' => $request->groupmember[$i],'group_id' => $groupchat->id]);
        }
        $groupmember = Groupmember::create(['user_id' => Auth::Id(),'group_id' => $groupchat->id]);
        return response()->json(['success'=>true]);
    }
    
    public function edit($id){
        $groupchat = Groupchat::find($id);
        $groupmember = Groupmember::where([['group_id',$id],['user_id','!=',Auth::Id()]])->with('user')->get();
        return response()->json(['group' => $groupchat, 'member' => $groupmember]);
    }
    
    public function update(Request $request, $id){
        $groupchat = Groupchat::where('id',$id)->update(['name' => $request->egroupname]);
        for($i = 0;$i < sizeof($request->removedgroupmember);$i++){
            Groupmember::where([['group_id',$id],['user_id',$request->removedgroupmember[$i]]])->delete();
        }
        
        for($j = 0;$j < sizeof($request->groupmember);$j++){
            Groupmember::where('group_id',$id)->create(['user_id' => $request->groupmember[$j],'group_id' => $id]);
        }
        return response()->json(['success'=>true]);
    }
    
    public function view($id){
        $user_id = Auth::Id();
        $profil = User::find($user_id);
        $groupchat = Groupchat::find($id);
        DBFunction::saveNotifgroup($user_id,$id,'Y');
        return view('viewgroupchat',['profile'=>$profil,'groupchat' => $groupchat]);
    }
    
    public function delete($id){
        $admin_id  = Auth::Id();
        $groupchat = Groupchat::find($id);
        if($groupchat->admin_id == $admin_id){
            $groupchat->delete();
            return response()->json(['status'=>'success']);
        }
        else{
            return response()->json(['status'=>'error']);
        }
    }
    
    public function leave($id){
        $user_id  = Auth::Id();
        $groupmember = Groupmember::where([['user_id',$user_id],['group_id',$id]])->first();
        $groupmember->delete();
        return response()->json(['status' => 'success']);
    }
    
}
