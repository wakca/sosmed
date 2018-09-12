<?php

namespace App\Helpers;
use App\Like;
use Auth;
use App\Comment;
use App\Post;
use App\User;
use App\Follows;
use Config;
use Route;
use App\Notification;
use App\Photo;
use App\Image;
use App\Groupimage;
use App\Groupmessage;
use App\Message;
use App\Groupmember;
use DB;
use App\Notifgroup;
use App\Story;

class Getter
{
    public static function getNumLikes($id){      
        return Like::where([['post_id', $id],['status','Y']])->count();   
    }

    public static function checkDetail($user)
    {
        if($user){

            if(!$user->alamat){
//                dd($user->alamat);
                return true;
            }

            return false;
        }
        return false;
    }
    
    public static function getNumComments($id){      
        return Comment::where('post_id', $id)->count();   
    }
    
    public static function isLike($id){
        $user_id = Auth::Id();
        return Like::where([['post_id', $id],['user_id',$user_id],['status','Y']])->count();   
    }
    
    public static function isFollowing($id,$user_id){
        $following = Follows::where([['user_id',$user_id],['following_id',$id],['status','Y']])->first();
        return isset($following);
    }
    
    public static function getNumPosts($id){
        return Post::where('user_id',$id)->count();
    }
    
    public static function getNumFollowers($id){
        return User::find($id)->followers()->count();
    }
    
    public static function getNumFollowing($id){
        return User::find($id)->following()->count();
    }

    public static function getSuggestFollows(){
        if(auth()->check()){
            $username   = Route::current()->parameters('username');
            $limit      = Config::get('global.limit_number');
            $following  = User::find(auth()->user()->id)->following()->pluck('following_id')->toArray();
            $user       = array_prepend($following,auth()->user()->id);
            if($username != null){
                return User::whereNotIn('id',$user)->where([['name','!=',''],['username','!=',$username]])->inRandomOrder()->take($limit)->get();
            }
            else{
                return User::whereNotIn('id',$user)->where('name','!=','')->inRandomOrder()->take($limit)->get();
            }
        }else{
            $username   = Route::current()->parameters('username');
            $limit      = Config::get('global.limit_number');
            $following  = User::find($username)->following()->pluck('following_id')->toArray();
            $user       = array_prepend($following,$username);
            if($username != null){
                return User::whereNotIn('id',$user)->where([['name','!=',''],['username','!=',$username]])->inRandomOrder()->take($limit)->get();
            }
            else{
                return User::whereNotIn('id',$user)->where('name','!=','')->inRandomOrder()->take($limit)->get();
            }
        }

    }
    
    public static function getSummaryPost($content){
        $nContent = substr($content,0,50);
        return $nContent."...";
    }
    
    public static function getRecepientName($id){
        $user = User::where('id',$id)->select('name','username')->first();
        return "<a href='/".$user->username."'>".$user->name."</a>";
    }
    
    public static function getNumNotif($id){
        $notif = Notification::where([['target_id',$id],['read','N'],['delete','N']])->count();
        if($notif != 0){
            return "<span class='badge red'>".$notif."</span>";
        }
        return null;
    }
    
    public static function getNumMessages($id){
        $message = Message::where([['recepient_id',$id],['read','N'],['del_receiver','N']])->count();
        if($message != 0){
            return "<span class='badge red'>".$message."</span> ";
        }
        return null;
    }
    
    public static function getNumGroupMessages($id){
        $group  = Notifgroup::where([['user_id',$id],['read','N']])->count();
        if($group != 0){
            return "<span class='badge red'>".$group."</span> ";
        }
        return null;
    }
    
    public static function getPostImages($id){
        $html = "<p></p>";
        $photos = Photo::where('post_id',$id)->get();
        if(count($photos) == 1){
            $class = "";
        }
        else if(count($photos) == 2){
            $class = "width-2";
        }
        else{
            $class = "width-3";
        }
        foreach($photos as $photo){
            $html.= "<a href='/photos/".$photo->photo."' data-toggle='lightbox' data-gallery='gallery-$id'><img src='/photos/small_".$photo->photo."' class='".$class." image-file'/></a>";
        }
        return $html;
    }
    
    public static function getMsgImages($id){
        $html = "<p></p>";
        $photos = Image::where('message_id',$id)->get();
        if(count($photos) == 1){
            $class = "";
        }
        else if(count($photos) == 2){
            $class = "width-2-msg";
        }
        else{
            $class = "width-3-msg";
        }
        foreach($photos as $photo){
            $html.= "<a href='/photos/".$photo->image."' data-toggle='lightbox' data-gallery='gallery-$id'><img src='/photos/small_".$photo->image."' class='".$class." image-file'/></a>";
        }
        return $html;
    }
    
    public static function getGroupMsgImages($id){
        $html = "<p></p>";
        $photos = Groupimage::where('message_id',$id)->get();
        if(count($photos) == 1){
            $class = "";
        }
        else if(count($photos) == 2){
            $class = "width-2-msg";
        }
        else{
            $class = "width-3-msg";
        }
        foreach($photos as $photo){
            $html.= "<a href='/photos/".$photo->image."' data-toggle='lightbox' data-gallery='gallery-$id'><img src='/photos/small_".$photo->image."' class='".$class." image-file'/></a>";
        }
        return $html;
    }
    
    public static function getLinkFromStr($text){
        $reg_exUrl = "/(^|\A|\s)((http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,4}(\/\S*)?)/";
        if(preg_match($reg_exUrl, $text, $url)) {
           // make the urls hyper links
           $text_result=preg_replace( $reg_exUrl, "$1<a href=\"$2\">$2</a> ", $text );
        }
        else {
        
           // if no urls in the text just return the text
            $text_result=$text;
        }   
        
        // URL starting www.
        $reg_exUrl = "/(^|\A|\s)((www\.)[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,4}(\/\S*)?)/";
        if(preg_match($reg_exUrl, $text_result, $url)) {
        
           // make the urls hyper links
           $text_result=preg_replace( $reg_exUrl, "$1<a href=\"http://$2\">$2</a>", $text_result );
        }
        return $text_result;
    }
    
    public static function getMaxConversationId(){
        $max = DB::table('messages')->select(DB::raw('IFNULL(MAX(conversation_id),0) as conversation_id'))->first();
        return $max->conversation_id;
    }
    
    public static function getConversationId($id1,$id2){
        $message = Message::where([['user_id',$id1],['recepient_id',$id2]])->orWhere([['user_id',$id2],['recepient_id',$id1]])->first();
        if(empty($message)){
            $conversation_id = Getter::getMaxConversationId()+1;
        }
        else{
            $conversation_id = $message->conversation_id;
        }
        return $conversation_id;
    }
    
    public static function getGroupchatMember($id){
        $people = "<ul class='list-group'>";
        $groupmember = Groupmember::where('group_id',$id)->get();
        foreach($groupmember as $member){
            $people.= "<li class='list-group-item'><a href='/".$member->user->username."' title='".$member->user->name."'>".$member->user->name."</a></li>";
        }
        $people.= "</ul>";
        return $people;
    }
    
    public static function getLastMessage($id){
        $message = Groupmessage::where('group_id',$id)->orderBy('created_at','desc')->first();
        if(count($message) == 0){
            return "Belum ada obrolan.";
        }
        else{
            return $message->message;
        }
    }
    
    public static function getReadStatus($group_id,$user_id){
        $notif = Notifgroup::where([['user_id',$user_id],['group_id',$group_id]])->first();
        if(count($notif) == 0){
            return 'Y';
        }
        else{
            return $notif->read;
        }
    }
    
    public static function getVerified($v){
        if($v == 1){
            return "<span class='label label-xs label-info' title='Terverifikasi'><i class='glyphicon glyphicon-ok'></i></span>";
        }
    }
    
    public static function getStoryThumb($content,$title){
        $dom = new \DomDocument();
        libxml_use_internal_errors(true);
        $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
        $images = $dom->getElementsByTagName('img');
        if(isset($images[0])){
            return "<div class='thumbnail-story' style='background-image:url(".$images[0]->getAttribute('src').");' alt='$title' title='$title'></div>";
        }
    }

    public static function getImageThumb($content,$title){
        $dom = new \DomDocument();
        libxml_use_internal_errors(true);
        $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
        $images = $dom->getElementsByTagName('img');
        if(isset($images[0])){
            // return "<div class='thumbnail-story' style='background-image:url(".$images[0]->getAttribute('src').");' alt='$title' title='$title'></div>";
            return "<img class='responsive rounded' src='".$images[0]->getAttribute('src')."' style='width: 100%' alt='$title'>";
        } else {
            // http://d2pa5gi5n2e1an.cloudfront.net/id/images/common/no_image_l.gif
            return "<img class='responsive rounded' src='http://d2pa5gi5n2e1an.cloudfront.net/id/images/common/no_image_l.gif' style='width: 100%' alt='$title'>";
        }
    }

    public static function getOnlyImgUrl($content, $title)
    {
        $dom = new \DomDocument();
        libxml_use_internal_errors(true);
        $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
        $images = $dom->getElementsByTagName('img');
        if(isset($images[0])){
            // return "<div class='thumbnail-story' style='background-image:url(".$images[0]->getAttribute('src').");' alt='$title' title='$title'></div>";
            // return "<img class='responsive rounded' src='".."' style='width: 100%' alt='$title'>";
            return $images[0]->getAttribute('src');
        } else {
            // http://d2pa5gi5n2e1an.cloudfront.net/id/images/common/no_image_l.gif
            return 'http://d2pa5gi5n2e1an.cloudfront.net/id/images/common/no_image_l.gif';
        }
    }
    
    public static function getStorySlug($id){
        $story = Story::find($id);
        return $story->slug;
    }
}