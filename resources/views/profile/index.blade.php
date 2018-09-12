
@if(Auth::check())

<div class="panel panel-default">
    <div class="panel-body">
        <form id='postForm' action="/post" class="form-horizontal" method='POST'>
            {{ csrf_field() }}
			<input name="_method" type="hidden" value="PUT">
            <textarea class="form-control" id='content' name='content' rows='3' placeholder="{{ $profile->id == Auth::Id() ?"Apa yang baru hari ini ?":"Tuliskan sesuatu untuk ".$profile->name }}" required></textarea>
            @if($profile->id == Auth::Id())
                <input type='hidden' name='user_id' id='user_id' value='{{ Auth::Id() }}'/>
                <input type='hidden' name='recepient_id' id='recepient_id' value='{{ Auth::Id() }}'/>
            @else
                <input type='hidden' name='user_id' id='user_id' value='{{ Auth::Id() }}'/>
                <input type='hidden' name='recepient_id' id='recepient_id' value='{{ $profile->id }}'/>
            @endif
            <div id="image_preview"></div>
            <div class="progress" style='display:none;'>
                <div class="progress-bar progress-bar-striped active" role="progressbar" style="width: 0%;">
                  0%
                </div>
              </div>
            <div id='img-input'><input type='file' accept="image/*" id='upload-image-1' class='upload-image' name='photos[]'/></div>
            <div id='act-btn'>
            <label id='upload-label-1' class='upload-label' for='upload-image-1' title="Tambahkan Foto"><span class='glyphicon glyphicon-picture'></span> Tambahkan Foto</label><button type="submit" id='post' class="pull-right btn btn-primary margin-top">Post</button></div>
        </form>
    </div>
</div>
@endif
@include('posts.modal')
@section('script')
    <script src="{{ asset('js/jquery.infinitescroll.min.js') }}"></script>
    <script src="{{ asset('js/jquery.form.min.js') }}"></script>
    <script type="text/javascript">
        var num = 1;
        var progress = $('.progress');
        var bar = $('.progress-bar');
        var btnPost = $('#post');
        $(document).ready(function(){
            
            $("#postForm").ajaxForm(options);
            
            $('body').on('change', ':file', function(){
                var total_file=document.getElementById("upload-image-"+num).files.length;
                
                for(var i=0;i<total_file;i++)
                {
                    var maxWidth    = 127;
                    var maxHeight   = 127;
                    var ratio       = 0;
                    var ratio2      = 0;
                    var style = "";
                    var src = window.URL.createObjectURL(event.target.files[i]);
                    var img = new Image();
                    img.src = window.URL.createObjectURL(event.target.files[i]);
                    img.onload = function() {
                    var width  = img.naturalWidth,
                        height = img.naturalHeight;
                        
                        if (width > height) {
                            ratio = Math.min(maxWidth / width);
                            ratio2= Math.min(maxHeight/height);
                            style = "height:"+(height*ratio2)+"px;width:"+(127+(width*ratio))+"px;margin-left:-"+(254*ratio)+"px;margin-top:0px;";
                        }
                        else if (width < height) {
                            ratio = Math.min(maxHeight / height);
                            ratio2= Math.min(maxWidth/width);
                            style = "height:"+(127+(height*ratio))+"px;width:"+(width*ratio2)+"px;margin-top:-"+(254*ratio)+"px;margin-left:0px;";
                        }
                        else{
                            style = "height:127px;width:127px;";
                        }
                        $('#image_preview').append("<div class='upload-thumb thumb-"+(num-1)+"'><div class='upload-remove' onclick='removeImage("+(num-1)+");'><span class='glyphicon glyphicon-remove'></span></div><img src='"+src+"' style='"+style+"'/></div>");

                    }
                }
                $(this).hide();
                $("#upload-label-"+num).hide();
                num++;
                $("#img-input").append("<input type='file' accept='image/*' id='upload-image-"+num+"' class='upload-image' name='photos[]'/>");
                $("#act-btn").prepend("<label  class='upload-label' id='upload-label-"+num+"' for='upload-image-"+num+"' title='Tambahkan Foto'><span class='glyphicon glyphicon-picture'></span> Tambahkan Foto</label>");
            });

        });
        var options = {
                beforeSend: function() {
                    var percentVal = '0%';
                    progress.show();
                    bar.css('width',percentVal)
                    bar.html(percentVal);
                    btnPost.text('Posting...');
                    btnPost.attr('disabled',true);
                },
                uploadProgress: function(event, position, total, percentComplete) {
                    var percentVal = percentComplete + '%';
                    bar.css('width',percentVal)
                    bar.html(percentVal);
                },
                success: function() {
                    var percentVal = '100%';
                    bar.css('width',percentVal)
                    bar.html(percentVal);
                },
                complete: function(response) 
                {
                    if($.isEmptyObject(response.responseJSON.error)){
                        progress.hide();
                        btnPost.text('Post');
                        btnPost.attr('disabled',false);
                        $("#image_preview").html("");
                    }else{
						progress.hide();
                        btnPost.text('Post');
                        btnPost.attr('disabled',false);
                        printErrorMsg(response.responseJSON.error);
                    }
                },
                clearForm: true,
                resetForm: true
            };
          
            function printErrorMsg (msg) {
              $(".print-error-msg").find("ul").html('');
              $(".print-error-msg").css('display','block');
              $.each( msg, function( key, value ) {
                  $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
              });
            }
            
            function removeImage(num) {
                $("#upload-image-"+num).remove();
                $(".thumb-"+num).remove();
            }
    </script>
    <script type='text/javascript'>        
        $(document).ready(function(){
            var loading_options = {
                finishedMsg:'',
                msgText:'',
                selector: '#load-more',
                speed:'normal',
            };
        
            $('#list-posts').infinitescroll({
              loading : loading_options,
              navSelector : "#wrapper .pagination",
              nextSelector : "#wrapper .pagination li.active + li a",
              itemSelector : "#list-posts div.posts",
              errorCallback: function(){
                    $('.finished').show();   
                }
            });
            
            /*$btnPost = $("#post");
            $('#postForm').submit(function(e){
                e.preventDefault();
                
                $content = $("#content").val();
                $user_id = $("#user_id").val();
                $recepient_id = $("#recepient_id").val();
                
                $btnPost.text('Posting...');
                $btnPost.attr('disabled',true);
                $.ajax({
                    url:'/post',
                    data:{content:$content,user_id:$user_id,recepient_id:$recepient_id},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:'POST',
                    success:function(data){
                        $("#content").val('');
                        $btnPost.text('Post').attr('disabled',false);
                    }
                });
            });*/

        });
        function getNewPost(id) {
            $lastId = $(".posts").first().data('post-id');
            $.ajax({
                url:'/post/new/'+$lastId+'/'+id,
                type:'GET',
                success:function(data){
                    if (data != '') {
                        if($("#panel-empty").length) {
                            $("#panel-empty").remove();
                        }
                        $("#list-posts").hide().prepend(data).fadeIn('slow');
                    }
                    window.setTimeout(getNewPost(id), 1100);
                }
            });
        }
        
        function getNumLikes() {
            $(".posts").each(function(i,e){
                console.log($(this).data('post-id'));
                $.ajax({
                    url:'/like/'+$(this).data('post-id')+'/numlike',
                    type:'GET',
                    success:function(data){
                        $(this).find('likes').text(data.numLikes);
                    }
                });
            });
        }
        
        
        window.setTimeout(getNewPost({{$profile->id}}), 1100);
        //window.setInterval(getNumLikes, 1100);
        //window.setInterval(ajaxTime, 5000);
        
        
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
                                console.log(data.content);
                                var cont = getLinks(data.content);
                                $("#post-"+post_id).find('.post-content').html(cont);
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
    </script>
@endsection
