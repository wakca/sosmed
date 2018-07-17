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

Route::get('generate_admin_desa', function(){
    
    set_time_limit(20000);

    $desa = App\Desa::all();
    
    foreach($desa as $listDesa)
    {
        $listDesa->admin_id = $listDesa->id;
        
        if($listDesa->save()){

            
            $user = App\User::where('username', $listDesa->id)->first();
            
            if($user){
                $user->name = 'Admin Desa ' . $listDesa->nama;
                $user->password = bcrypt($listDesa->id);
                $user->username = $listDesa->id;
                $user->email = $listDesa->id.'@desa.id';
                $user->level = 2;
                $user->desa = $listDesa->id;
                $user->save();

                echo 'Admin Desa ' . $listDesa->nama;
                
                unset($user);
            } else {
                $user = new App\User;
                $user->name = 'Admin Desa ' . $listDesa->nama;
                $user->password = bcrypt($listDesa->id);
                $user->username = $listDesa->id;
                $user->email = $listDesa->id.'@desa.id';
                $user->level = 2;
                $user->desa = $listDesa->id;
                $user->save();

                echo 'Admin Desa ' . $listDesa->nama;
                
                unset($user);
            }
            unset($listDesa);
        }
    }
});

Route::get('/set_admin_desa/{email}', function($email){
    $user = App\User::where('email' ,$email)->first();
    $user->level = 2;
    $user->save();

    $desa = App\Desa::find($user->desa);
    $desa->admin_id = $user->id;
    $desa->save();
});

Route::group(['prefix' => 'desa'], function(){
    Route::get('/', 'DesaController@index');

    Route::get('/suggest', 'DesaController@suggest')->name('desa.suggest');
});

Route::group(['prefix' => 'api'], function(){
    Route::group(['prefix' => 'konten_desa/{desa_id}'], function(){
        Route::get('selayang_pandang', 'Api\ContentController@selayang_pandang');
        Route::get('profil_desa', 'Api\ContentController@profil_desa');
        Route::get('proyek_desa', 'Api\ContentController@proyek_desa');
        Route::get('organisasi_desa', 'Api\ContentController@organisasi_desa');
        Route::get('produk_unggulan', 'Api\ContentController@produk_unggulan');
        Route::get('galeri_desa', 'Api\ContentController@galeri_desa');
        Route::get('kabar_desa', 'Api\ContentController@kabar_desa');
    });
});

Auth::routes();

//Halaman Desa
Route::group(['prefix' => 'profil_desa/{id_desa}'], function($id_desa){
    Route::get('/beranda', 'ProfilDesaCotroller@index')->name('profil_desa.beranda');
    Route::get('/story', 'ProfilDesaCotroller@story')->name('profil_desa.story');
    Route::get('/peta', 'ProfilDesaCotroller@peta')->name('profil_desa.peta');
});

//admin_desa
Route::group(['prefix' => 'admin_desa'], function () {
    Route::get('dashboard', 'AdminDesa\DashboardController@index')->name('admin_desa.dashboard'); 

    //admin_desa/user
    Route::group(['prefix' => 'user'], function(){
        Route::get('/', 'AdminDesa\UserController@index')->name('admin_desa.user.index');
        
        Route::get('/list','AdminDesa\UserController@anyData')->name('admin_desa.user.data');
    });

    //admin_desa/story
    Route::group(['prefix' => 'story'], function(){
        Route::get('/', 'AdminDesa\StoryController@index')->name('admin_desa.story.index');
        
        Route::get('/{id}/report','AdminDesa\StoryController@report')->name('admin_desa.story.report');
        Route::get('/{id}/unreport','AdminDesa\StoryController@unreport')->name('admin_desa.story.unreport');

        Route::get('/list','AdminDesa\StoryController@anyData')->name('admin_desa.story.data');
    });

    Route::group(['prefix' => 'konten_desa/'], function(){

        Route::get('/', 'AdminDesa\ContentController@index')->name('admin_desa.content');

        Route::get('edit/{slug}', 'AdminDesa\ContentController@edit')->name('admin_desa.content.edit');

        Route::group(['prefix' => 'save'], function(){
            Route::post('selayang_pandang', 'AdminDesa\ContentController@selayang_pandang')->name('admin_desa.content.selayang_pandang.save');
            Route::post('profil_desa', 'AdminDesa\ContentController@profil_desa')->name('admin_desa.content.profil_desa.save');
            Route::post('proyek_desa', 'AdminDesa\ContentController@proyek_desa')->name('admin_desa.content.proyek_desa.save');
            Route::post('organisasi_desa', 'AdminDesa\ContentController@organisasi_desa')->name('admin_desa.content.organisasi_desa.save');
            Route::post('produk_unggulan', 'AdminDesa\ContentController@produk_unggulan')->name('admin_desa.content.produk_unggulan.save');
            Route::post('galeri_desa', 'AdminDesa\ContentController@galeri_desa')->name('admin_desa.content.galeri_desa.save');
            Route::post('kabar_desa', 'AdminDesa\ContentController@kabar_desa')->name('admin_desa.content.kabar_desa.save');
            Route::post('dokumen_desa', 'AdminDesa\ContentController@dokumen_desa')->name('admin_desa.content.dokumen_desa.save');
        });
    });
});

//admin
Route::group(['prefix' => 'admin'], function () {
    Route::get('/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');
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


    //Pengurus Desa
    Route::group(['prefix' => 'pengurus'], function(){
        Route::get('/', 'Admin\PengurusController@index')->name('admin.pengurus');
        Route::get('kabupaten/{id_provinsi}', 'Admin\PengurusController@kabupaten');
        Route::get('kecamatan/{id_kabupaten}', 'Admin\PengurusController@kecamatan');
        Route::get('desa/{id_kecamatan}', 'Admin\PengurusController@desa');
        Route::get('desa/{id_desa}/detail', 'Admin\PengurusController@detailDesa');

        Route::get('set_pengurus/{id_user}', 'Admin\PengurusController@setPengurus')->name('admin.set_pengurus');

        Route::get('/data_provinsi','Admin\PengurusController@dataProvinsi')->name('admin.provinsi');
        Route::get('/data_kabupaten/{id_provinsi}','Admin\PengurusController@dataKabupaten')->name('admin.kabupaten');
        Route::get('/data_kecamatan/{id_kabupaten}','Admin\PengurusController@dataKecamatan')->name('admin.kecamatan');
        Route::get('/data_desa/{id_desa}','Admin\PengurusController@dataDesa')->name('admin.desa');
        Route::get('/data_penduduk/{id_desa}', 'Admin\PengurusController@dataPenduduk')->name('admin.penduduk');
    });

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
