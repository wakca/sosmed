<div class="panel panel-default" id='post-{{ $post->id }}' data-post-id="{{ $post->id }}">
    <div class="btn-group pull-right">
        <a id='btn-{{ $post->id }}' class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="glyphicon glyphicon-option-vertical"></span>
        </a>
        <ul id='menu-{{ $post->id }}' class="dropdown-menu smalled">
            @if($post->user_id == Auth::Id())
                <li><a href="javascript:void(0);" onclick='editPost({{ $post->id }});'><span class='glyphicon glyphicon-pencil'></span> Edit Post</a></li>
                <li><a href="javascript:void(0);" onclick='deletePost({{ $post->id }});'><span class='glyphicon glyphicon-trash'></span> Hapus Post</a></li>
            @else
                <li><a href="#"><span class='glyphicon glyphicon-save'></span> Simpan Post</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#"><span class='glyphicon glyphicon-flag'></span> Laporkan Post</a></li>
            @endif
        </ul>
    </div>
    <div class="panel-body">
        <div class="media">
          <div class="avatar">
            <a href="#">
              {{--<img class="media-object" width='100%' src="/photos/{{ isset($post->user->photo) ? $post->user->photo : 'av-default.jpg' }}" alt="{{ $post->user->name }}">--}}
              <img class="media-object" width='100%' src="{{$post->user->photo ? url('/storage/'.$post->user->photo) : url('/photos/av-default.jpg')}}" alt="{{ $post->user->name }}">
            </a>
          </div>
          <div class="content">
                @if($post->user_id != $post->recepient_id)
                  <h4 class="media-heading"><a href='/{{ $post->user->username }}'>{{ $post->user->name }}</a> <span class='smallest-text glyphicon glyphicon-chevron-right'></span> {!! Getter::getRecepientName($post->recepient_id) !!} <span class='small-text'>&bull; <span class='ajax-time time-post-{{ $post->id }}' data-time-post-id = '{{ $post->id }}' data-time='{{ $post->created_at }}'>{{ Date::parse($post->created_at)->ago() }}</span></span></h4>
                @else
                  <h4 class="media-heading"><a href='/{{ $post->user->username }}'>{{ $post->user->name }}</a> <span class='small-text'> &#64;{{ $post->user->username }} &bull; <span class='ajax-time time-post-{{ $post->id }}' data-time-post-id = '{{ $post->id }}' data-time='{{ $post->created_at }}'>{{ Date::parse($post->created_at)->ago() }}</span></span></h4>
                @endif
                <span class='post-content'>{!! Getter::getLinkFromStr($post->content) !!}</span>
                @if($post->has_image == 'Y')
                    {!! Getter::getPostImages($post->id) !!}
                @endif
            <ul class="nav nav-pills">
                <li><a href='javascript:void(0)' onclick='likePost({{ $post->id }})'><span class='glyphicon like-icon glyphicon-heart {{ Getter::isLike($post->id)?' liked':'' }}'></span><span class='likes'>{{ Getter::getNumLikes($post->id) == 0?'': ' '.Getter::getNumLikes($post->id)}}</span></a></li>
                <li><a href='javascript:void(0)' onclick="$('#comment').focus()"><span class='glyphicon glyphicon-comment'></span><span class='numcomments'>{{ Getter::getNumComments($post->id) == 0?'': ' '.Getter::getNumComments($post->id)}}</span></a></li>
                <li><a href='javascript:void(0)' onclick='sharePost({{ $post->id }})'><span class='glyphicon glyphicon-share-alt'></span></a></li>
            </ul>
            <a class='small-text' href='javascript:void(0)' onclick='showLikers({{ $post->id }})'>Lihat orang yg menyukai ini</a>
          </div>
        </div>
    </div>
    <div class='comment modal-comment'>
        <div class="alert alert-danger print-error-msg" style="display:none">
            <ul></ul>
        </div>
        <form method='POST' action='/comment' id='commentForm'>
            {{ csrf_field() }}
            <input type='hidden' name='post_id' value='{{ $post->id }}'/>
            <input type='hidden' name='_method' value='PUT'/>
            <textarea class='form-control' id='comment' name='content' rows='2' placeholder='Komentari Post ini' required></textarea>
            <button type='submit' id='send' class='btn margin-top btn-primary'>Kirim</button>
        </form>
    </div>
</div>
@include('posts.modal')
@section('script')
    <script src="{{ asset('js/jquery.infinitescroll.min.js') }}"></script>
    <script src="{{ asset('js/jquery.form.min.js') }}"></script>
    <script type='text/javascript'>
        $(document).ready(function(){
            var btnPost = $("#send");
            var commentField = $("#comment");
            
            var options = {
                beforeSend: function() {        
                    btnPost.text('Mengirim...');
                    btnPost.attr('disabled',true);
                },
                complete: function(response) 
                {
                    if($.isEmptyObject(response.responseJSON.error)){
                        btnPost.text('Kirim');
                        btnPost.attr('disabled',false);
                    }else{
                        printErrorMsg(response.responseJSON.error);
                    }
                },
                clearForm: true,
                resetForm: true
            };
            
            $("#commentForm").ajaxForm(options);
            
            function printErrorMsg (msg) {
              $(".print-error-msg").find("ul").html('');
              $(".print-error-msg").css('display','block');
              $.each( msg, function( key, value ) {
                  $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
              });
            }

            var loading_options = {
                finishedMsg:'',
                msgText:'',
                selector: '#load-more',
                speed:'normal',
            };
        
            $('#list-comments').infinitescroll({
              loading : loading_options,
              navSelector : "#wrapper .pagination",
              nextSelector : "#wrapper .pagination li.active + li a",
              itemSelector : "#list-comments div.comments",
              path: ["/post/{{ $post->id }}?page=", ""],
              errorCallback: function(){
                    $('.finished').show();   
                }
            });  
        });
        
        function showLikers(id) {
            $("#modal-likers").modal("show");
            $("#list-likers").load('/post/'+id+'/likers',500);
            
            $('#list-likers').scroll(function(){
                var loading_options = {
                    finishedMsg:'',
                    msgText:'',
                    selector: '#load-more',
                    speed:'normal',
                };
                $('#list-likers').infinitescroll({
                    loading : loading_options,
                    behavior:'local',
                    binder:$('#list-likers'),
                    navSelector : "#wrapper .pagination",
                    nextSelector : "#wrapper .pagination li.active + li a",
                    itemSelector : "#list-likers div.likers",
                    path: ["/post/{{ $post->id }}/likers?page=", ""],
                    errorCallback: function(){
                          $('.finished').show();   
                      },
                  });
            })
        }
        
        function getNewComment() {
            $lastId = $(".comments").first().data('comment-id');
            $.ajax({
                url:'/post/{{ $post->id }}/newcomment/'+$lastId,
                type:'GET',
                success:function(data){
                    if (data != '') {
                        if($("#panel-empty").length) {
                            $("#panel-empty").remove();
                        }
                        $("#list-comments").hide().prepend(data).fadeIn('slow');
                        getNumComments({{ $post->id }});
                    }
                    window.setTimeout(getNewComment, 1100);
                }
            });
        }
        
        window.setTimeout(getNewComment, 1100);
        
        function sharePost(id) {
            $("#modal-share").modal('show');
            $("#fb_share").attr('href','https://www.facebook.com/sharer/sharer.php?u={{ config('app.url') }}/post/'+id);
            $("#twit_share").attr('href','https://twitter.com/intent/tweet?text={{ config('app.url') }}/post/'+id);
            $("#plus_share").attr('href','https://plus.google.com/share?url={{ config('app.url') }}/post/'+id);
            $("#url-post").val('{{ config('app.url') }}/post/'+id);
            $("#copy-btn").click(function(){
                var postUrl = document.querySelector('#url-post');
                postUrl.select();
              
                try {
                  var successful = document.execCommand('copy');
                  var msg = successful ? 'successful' : 'unsuccessful';
                  console.log('Copying text command was ' + msg);
                } catch (err) {
                  console.log('Oops, unable to copy');
                }
            });
        }
        
        //edit & hapus post
        function editPost(id) {
            var post_id = id;
            $("#modal-edit").modal('show');
            $('#modal-edit').on('hidden.bs.modal', function(){
                post_id = 0;
            });
            $.ajax({
                url:'/post/'+post_id+'/edit',
                type:'GET',
                success:function(data){
                    $("#content-edit").val(data.content);
                }
            });
            $("#edit-form").submit(function(e){
                e.preventDefault();
                $content = $("#content-edit").val();
                if (post_id != 0) {
                    $.ajax({
                        url:'/post/'+post_id,
                        data:{content:$content},
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type:'POST',
                        success:function(data){
                            $("#modal-edit").modal('hide');
                            if (data.status == 'success') {
                                $("#post-"+post_id).find('.post-content').text(data.content);
                            }
                            else{
                                window.alert('Gagal Mengedit data !');
                            }
                        }
                    });
                }
            });
        }
        
        function deletePost(id) {
            var post_id = id;
            $("#modal-delete").modal('show');
            $('#modal-delete').on('hidden.bs.modal', function(){
                post_id = 0;
            });
            $("#btn-delete").click(function(){
                if (post_id != 0) {
                    $.ajax({
                        url:'/post/'+post_id+'/delete',
                        type:'GET',
                        success:function(data){
                            $("#modal-delete").modal('hide');
                            if (data.status == 'success') {
                                $("#post-"+post_id).slideUp(500, function(){ $("#post-"+post_id).remove(); });
                            }
                            else{
                                window.alert('Gagal Menghapus data !');
                            }
                        }
                    });
                }
            });
        }
        
        function likePost(id) {
            $.ajax({
                url: '/like/'+id,
                type:'GET',
                success:function(data){
                    if (data.status == 'liked') {
                        $("#post-"+id).find('.like-icon').addClass('liked');
                    }
                    else{
                        $("#post-"+id).find('.like-icon').removeClass('liked');
                    }
                    $.ajax({ url :'/like/'+id+'/numlike',type:'GET',success:function(data2){
                        if (data2.numLikes == 0) {
                            $("#post-"+id).find('.likes').text('');
                        }
                        else{
                            $("#post-"+id).find('.likes').text(' '+data2.numLikes);
                        }
                    }});
                }
            })
        }
        
        function likePost(id) {
            $.ajax({
                url: '/like/'+id,
                type:'GET',
                success:function(data){
                    if (data.status == 'liked') {
                        $("#post-"+id).find('.like-icon').addClass('liked');
                    }
                    else{
                        $("#post-"+id).find('.like-icon').removeClass('liked');
                    }
                    getNumLikes(id);
                }
            })
        }
        
        function getNumLikes(id) {
            $.ajax({
                url :'/post/'+id+'/numlikes',
                type:'GET',
                success:function(data){
                    if (data.numLikes == 0) {
                        $("#post-"+id).find('.likes').text('');
                    }
                    else{
                        $("#post-"+id).find('.likes').text(' '+data.numLikes);
                    }
                }
            });
        }
        
        function getNumComments(id) {
            $.ajax({
                url :'/post/'+id+'/numcomments',
                type:'GET',
                success:function(data){
                    if (data.numComments == 0) {
                        $("#post-"+id).find('.numcomments').text('');
                    }
                    else{
                        $("#post-"+id).find('.numcomments').text(' '+data.numComments);
                    }
                }
            });
        }
        
        function getComments(id) {
            $("#list-comments").remove();
            $.ajax({
                url:'/post/'+id+'/comments',
                type: 'GET',
                success:function(data){
                    $(".comment").append(data.commentList);
                }
            });
        }
        
        function editComment(id) {
            var comment_id = id;
            $("#modal-edit-comment").modal('show');
            $('#modal-edit-comment').on('hidden.bs.modal', function(){
                comment_id = 0;
            });
            $.ajax({
                url:'/comment/'+comment_id+'/edit',
                type:'GET',
                success:function(data){
                    $("#comment-edit").val(data.content);
                }
            });
            $("#editCommentForm").submit(function(e){
                e.preventDefault();
                $content = $("#comment-edit").val();
                if (comment_id != 0) {
                    $.ajax({
                        url:'/comment/'+comment_id,
                        data:{content:$content},
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type:'POST',
                        success:function(data){
                            $("#modal-edit-comment").modal('hide');
                            if (data.status == 'success') {
                                var cont = getLinks(data.content);
                                $("#comment-"+comment_id).find('.comment-content').html(cont);
                            }
                            else{
                                window.alert('Gagal Mengedit data !');
                            }
                        }
                    });
                }
            });
        }
        
        function deleteComment(id) {
            var comment_id = id;
            $("#modal-delete-comment").modal('show');
            $('#modal-delete-comment').on('hidden.bs.modal', function(){
                comment_id = 0;
            });
            $("#btn-delete-comment").click(function(){
                if (comment_id != 0) {
                    $.ajax({
                        url:'/comment/'+comment_id+'/delete',
                        type:'GET',
                        success:function(data){
                            $("#modal-delete-comment").modal('hide');
                            if (data.status == 'success') {
                                $("#comment-"+comment_id).slideUp(500, function(){ $("#comment-"+comment_id).remove(); });
                                getNumComments(data.post_id);
                            }
                            else{
                                window.alert('Gagal Menghapus data !');
                            }
                        }
                    });
                }
            });
        }
    </script>
@endsection
