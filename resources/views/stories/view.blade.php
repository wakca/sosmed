@section('title',$story->title.' | ')  
  <div class='panel panel-default'>
      <div class='panel-heading'>
        <h2>{{ $story->title }}</h2>
        <span class='small-text'>{{ Date::parse($story->created_at)->ago() }}</span>
      </div>
      <div class='panel-body'>
        {!! $story->content !!}
      </div>
      <div class='modal-comments'>
        Tags : 
        @foreach($story->tags as $tag)
          <a class='label label-default' href='{{ route('story.tag',['tag' => $tag->name]) }}'>{{ ucfirst($tag->name) }}</a>
        @endforeach
      </div>
    </div>
    <div id='comments' class='panel story-comment panel-default'>
      <div class='panel-heading'>
        {{ count($story->comment) }} Komentar
      </div>
      <div class='panel-body'>
      @if(Auth::guest())
        <p class='alert alert-info'>Silahkan <a class='btn btn-xs btn-primary' href='{{ route('login') }}'>login</a> untuk berkomentar.</p class='alert alert-warning'>
      @else
        <div class="alert alert-danger print-error-msg" style="display:none">
            <ul></ul>
        </div>
        <div class='story-comment-form'>
          <form method='POST' action='/story/comment' id='commentForm'>
              {{ csrf_field() }}
              <input type='hidden' name='story_id' value='{{ $story->id }}'/>
              <input type='hidden' name='_method' value='PUT'/>
              <textarea class='form-control' id='comment' name='content' rows='2' placeholder='Tuliskan Komentar..' required></textarea>
              <button type='submit' id='send' class='btn margin-top pull-right btn-primary'>Kirim</button>
          </form>
      </div>
      @endif
        @foreach($comments as $comment)
          <div class='modal-comments comments' data-comment-id='{{ $comment->id }}' id='comment-{{ $comment->id }}'>
              @if(Auth::check())
                @if($comment->user_id == Auth::Id())
                <div class='btn-group pull-right'>
                    <a id='btn-{{ $comment->id }}' class='btn dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                      <span class='glyphicon glyphicon-option-vertical'></span>
                    </a>
                    <ul id='menu-{{ $comment->id }}' class='dropdown-menu smalled'>
                            <li><a href='javascript:void(0);' onclick='editComment({{ $comment->id }});'><span class='glyphicon glyphicon-pencil'></span> Edit Komentar</a></li>
                            <li><a href='javascript:void(0);' onclick='deleteComment({{ $comment->id }});'><span class='glyphicon glyphicon-trash'></span> Hapus Komentar</a></li>
                    </ul>
                </div>
                @elseif($comment->story->user_id == Auth::Id())
                    <div class='btn-group pull-right'>
                    <a class='btn' href='javascript:void(0);' onclick='deleteComment({{ $comment->id }});'>
                      <span class='glyphicon glyphicon-trash'></span>
                    </a></div>
                @endif
              @endif
            <div class='media'>
              <div class='avatar'>
                <a href='#'>
                  <img class='media-object' src='/photos/{{ isset($comment->user->photo) ? $comment->user->photo : 'av-default.jpg'}} ' width='100%' alt='{{ $comment->user->name }}'>
                </a>
              </div>
              <div class='content'>
                <h4 class='media-heading'><a href='/{{ $comment->user->username }}'>{{ $comment->user->name }}</a><span class='small-text'> &#64;{{ $comment->user->username }} &bull; <span class='ajax-time time-post-id' data-time-post-id = 'id' data-time='time'>{{ Date::parse($comment->created_at)->ago() }}</span></span></h4>
                  <span class='comment-content'>{!! Getter::getLinkFromStr($comment->content) !!}</span>
              </div>
            </div>
          </div>
        @endforeach
        {{ $comments->links() }}
      </div>
    </div>
<!-- Hapus Komentar -->
<div class="modal fade" id='modal-delete-comment' tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><span class='glyphicon glyphicon-exclamation-sign'></span> Hapus Komentar</h4>
      </div>
      <div class="modal-body">
        <p>Anda yakin ingin menghapus komentar ini ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" id='btn-delete-comment' class="btn btn-danger"><span class='glyphicon glyphicon-trash'></span> Hapus</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Edit Comment Modal -->
<div class="modal fade" id='modal-edit-comment' tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form id='editCommentForm' method='POST'>
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><span class='glyphicon glyphicon-pencil'></span> Edit Komentar</h4>
            </div>
            <div class="modal-body">
              <textarea class="form-control" id='comment-edit' name='comment' rows='4' placeholder="Masukan komentar..." required></textarea>
            </div>
            <div class="modal-footer">
              <button type="submit" id='btn-update' class="btn btn-primary"><span class='glyphicon glyphicon-pencil'></span> Update</button>
              <button type="reset" class="btn btn-default" data-dismiss="modal">Batal</button>
            </div>
        </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@section('script')
    <script src="{{ asset('js/jquery.infinitescroll.min.js') }}"></script>
    <script src="{{ asset('js/jquery.form.min.js') }}"></script>
    <script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=599bc3c3a3155100110e7200&product=sticky-share-buttons"></script>
    <script type='text/javascript'>
        $(document).ready(function(){
          $(".pagination a").each(function(i,v){
            $(this).attr('href',$(this).attr('href')+'#comments');
          });
        });
        function editComment(id) {
            var comment_id = id;
            $("#modal-edit-comment").modal('show');
            $('#modal-edit-comment').on('hidden.bs.modal', function(){
                comment_id = 0;
            });
            $.ajax({
                url:'/story/comment/'+comment_id+'/edit',
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
                        url:'/story/comment/'+comment_id,
                        data:{content:$content},
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type:'POST',
                        success:function(data){
                            $("#modal-edit-comment").modal('hide');
                            if (data.status == 'success') {
                                $("#comment-"+comment_id).find('.comment-content').html(data.content);
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
                        url:'/story/comment/'+comment_id+'/delete',
                        type:'GET',
                        success:function(data){
                            $("#modal-delete-comment").modal('hide');
                            if (data.status == 'success') {
                                $("#comment-"+comment_id).slideUp(500, function(){ $("#comment-"+comment_id).remove(); });
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