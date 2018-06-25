<div class="panel panel-default">
    <div class="panel-body">
        Semua Post {{ $profile->name }}
    </div>
</div>
@include('posts.modal')
@section('script')
    <script src="{{ asset('js/jquery.infinitescroll.min.js') }}"></script>
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