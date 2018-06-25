<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('index');
Route::get('/beranda','HomeController@beranda')->middleware(['auth','checkname']);
Auth::routes();

//admin
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'Admin\DashboardController@index')->name('admin.dashboard');
    Route::get('/story','Admin\StoryController@index')->name('admin.story');
    Route::get('/story/list','Admin\StoryController@anyData')->name('story.data');
    Route::get('/story/{id}/delete','Admin\StoryController@destroy')->name('admin.story.delete');
    Route::get('/story/{id}/edit','Admin\StoryController@edit')->name('admin.story.edit');
    Route::post('/story/{id}/edit','Admin\StoryController@update');
    Route::get('/tag','Admin\TagController@index')->name('admin.tag');
    Route::get('/tag/create','Admin\TagController@create')->name('admin.tag.create');
    Route::post('/tag/create','Admin\TagController@save');
    Route::get('/tag/list','Admin\TagController@anyData')->name('tag.data');
    Route::get('/tag/{id}/delete','Admin\TagController@destroy')->name('admin.tag.delete');
    Route::get('/tag/{id}/edit','Admin\TagController@edit')->name('admin.tag.edit');
    Route::post('/tag/{id}/edit','Admin\TagController@update');
    Route::get('/post','Admin\PostController@index')->name('admin.post');
    Route::get('/post/list','Admin\PostController@anyData')->name('post.data');
    Route::get('/post/{id}/delete','Admin\PostController@destroy')->name('admin.post.delete');
    Route::get('/post/{id}/edit','Admin\PostController@edit')->name('admin.post.edit');
    Route::post('/post/{id}/edit','Admin\CommentController@update');
    Route::get('/comment','Admin\CommentController@index')->name('admin.comment');
    Route::get('/comment/list','Admin\CommentController@anyData')->name('comment.data');
    Route::get('/comment/{id}/delete','Admin\CommentController@destroy')->name('admin.comment.delete');
    Route::get('/comment/{id}/edit','Admin\CommentController@edit')->name('admin.comment.edit');
    Route::post('/comment/{id}/edit','Admin\CommentController@update');
    Route::get('/user','Admin\UserController@index')->name('admin.user');
    Route::post('/user/create','Admin\UserController@save');
    Route::get('/user/list','Admin\UserController@anyData')->name('user.data');
    Route::get('/user/{id}/delete','Admin\UserController@destroy')->name('admin.user.delete');
    Route::get('/user/{id}/edit','Admin\UserController@edit')->name('admin.user.edit');
    Route::post('/user/{id}/edit','Admin\UserController@update');
});

//admin
Route::group(['prefix' => 'story'], function () {
    Route::get('/', 'Story\StoryController@index')->name('story');
    Route::get('/tag/{tag}','Story\StoryController@tag')->name('story.tag');
    Route::get('/create', 'Story\StoryController@create')->name('story.create');
    Route::post('/create', 'Story\StoryController@save');
    Route::get('/{slug}', 'Story\StoryController@view')->name('story.view');
    Route::get('/{id}/edit', 'Story\StoryController@edit')->name('story.edit')->where('id','[0-9]+');
    Route::post('/{id}/edit', 'Story\StoryController@update')->where('id','[0-9]+')->middleware('checkowner:story');;
    Route::get('/{id}/delete', 'Story\StoryController@destroy')->name('story.delete')->where('id','[0-9]+')->middleware('checkowner:story');
    Route::put('/comment','Story\StorycommentController@store')->name('story.comment.save');
    Route::get('/comment/{id}/delete','Story\StorycommentController@destroy')->name('story.comment.delete')->where('id','[0-9]+')->middleware('checkowner:storycomment');
    Route::get('/comment/{id}/edit','Story\StorycommentController@edit')->name('story.comment.edit')->where('id','[0-9]+');
    Route::post('/comment/{id}','Story\StorycommentController@update')->name('story.comment.update')->where('id','[0-9]+')->middleware('checkowner:storycomment');
});

//ajax-request
Route::group(['prefix'=>'location'],function(){
    Route::get('/get-kab/{id}','LocationController@getKab');
    Route::get('/get-kec/{id}','LocationController@getKec');
    Route::get('/get-desa/{id}','LocationController@getDesa');
});


//notification
Route::get('/notifications','NotificationController@index')->name('notifications.all');
Route::get('/notifications/{id}','NotificationController@read')->name('notifications.read')->where('id','[0-9]+');
Route::get('/notifications/count',function(){
    return Getter::getNumNotif(Auth::Id()); 
});

//message
Route::get('/messages','MessageController@index')->name('messages.all');
Route::post('/messages','MessageController@send')->name('message.send');
Route::get('/messages/group','GroupchatController@index')->name('groupmessage.all');
Route::post('/messages/group','GroupchatController@create')->name('groupmessage.create');
Route::get('/messages/group/{id}','GroupchatController@view')->where('id','[0-9]+')->name('groupmessage.view');
Route::post('/messages/group/post','GroupmessageController@post')->name('groupmessage.post');
Route::get('/messages/group/{id}/list','GroupmessageController@listMessage')->where('id','[0-9]+')->name('groupmessage.list');
Route::get('/messages/group/{id}/edit','GroupchatController@edit')->where('id','[0-9]+')->name('groupmessage.edit');
Route::post('/messages/group/{id}/edit','GroupchatController@update')->where('id','[0-9]+')->name('groupmessage.update');
Route::get('/messages/group/{id}/delete','GroupchatController@delete')->where('id','[0-9]+')->name('groupmessage.delete');
Route::get('/messages/group/{id}/leave','GroupchatController@leave')->where('id','[0-9]+')->name('groupmessage.leave');
Route::get('/messages/group/autocomplete',array('as'=>'groupautocomplete','uses'=>'GroupchatController@autocomplete'));
Route::get('/messages/count',function(){
    return Getter::getNumMessages(Auth::Id());
});
Route::get('/messages/group/count',function(){
    return Getter::getNumGroupMessages(Auth::Id());
});
Route::get('/messages/{username}','MessageController@read')->name('messages.read')->where('username','[A-Za-z0-9]+');
Route::get('/messages/{username}/list','MessageController@listMessage')->name('messages.list')->where('username','[A-Za-z0-9]+');
Route::get('/messages/{id}/deleteall','MessageController@deleteall')->name('messages.deleteall')->where('id','[0-9]+');
Route::get('/messages/{id}/delete','MessageController@delete')->name('messages.delete')->where('id','[0-9]+');

//folow friend
Route::get('/follow/{id}','FollowsController@follow')->where('id','[0-9]+');
Route::get('/follow/suggest','FollowsController@suggest');

//Profile
Route::get('/profile-setting','ProfileController@edit')->name('profile.edit');
Route::post('/profile-setting','ProfileController@update')->name('profile.update');
//search
Route::get('/search','ProfileController@search')->name('profile.search');
Route::get('/advanced-search','ProfileController@advancedSearch')->name('profile.advanSearch');
Route::get('/{username}','ProfileController@show')->name('profile.show')->where('username','[A-Za-z0-9]+');
Route::get('/{username}/followers','ProfileController@followers')->name('profile.followers')->where('username','[A-Za-z0-9]+');
Route::get('/{username}/following','ProfileController@following')->name('profile.following')->where('username','[A-Za-z0-9]+');
Route::get('/{username}/posts','ProfileController@posts')->name('profile.posts')->where('username','[A-Za-z0-9]+');
Route::get('/{username}/media','ProfileController@media')->name('profile.media')->where('username','[A-Za-z0-9]+');
//Account
Route::get('/account-setting','AccountController@edit')->name('account.edit');
Route::post('/account-setting','AccountController@update')->name('account.update');

//Post
Route::put('/post','PostController@store')->name('post.save');
Route::get('/post/all','PostController@index')->name('post.all');
Route::get('/post/new/{id}/{user_id?}', 'PostController@getNewPosts')->name('post.new');
Route::get('/post/{id}','PostController@show')->name('post.show');
Route::get('/post/{id}/edit','PostController@edit')->name('post.edit');
Route::post('/post/{id}','PostController@update')->name('post.update')->middleware('checkowner:post');
Route::get('/post/{id}/delete','PostController@destroy')->name('post.delete')->middleware('checkowner:post');
Route::get('/post/{id}/comments', 'PostController@getComments')->name('post.comments');
Route::get('/post/{id}/likers','PostController@getLikers')->name('post.likers');
Route::get('/post/{id}/reccomments', 'PostController@getRecComments')->name('post.reccomments');
Route::get('/post/{id}/newcomment/{lastCommentId}', 'PostController@getNewComment')->name('post.newcomment');
Route::get('/post/{id}/numlikes', 'PostController@getNumLikes')->name('like.numlikes');
Route::get('/post/{id}/numcomments', 'PostController@getNumComments')->name('like.numcomments');
Route::get('/post/{id}/likes', 'PostController@getLikes')->name('post.likes');

//Like
Route::get('/like/{id}','LikeController@store')->name('like.save');

//Comment
Route::put('/comment','CommentController@store')->name('comment.save');
Route::get('/comment/{id}/edit','CommentController@edit')->name('comment.edit');
Route::post('/comment/{id}','CommentController@update')->name('comment.update')->middleware('checkowner:comment');
Route::get('/comment/{id}/delete','CommentController@destroy')->name('comment.delete')->middleware('checkowner:comment');
