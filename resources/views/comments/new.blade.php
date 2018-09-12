@foreach($comments as $comment)
    <div class='modal-comments comments' data-comment-id='{{ $comment->id }}' id='comment-{{ $comment->id }}'>
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
        @elseif($comment->post->user_id == Auth::Id())
            <div class='btn-group pull-right'>
            <a class='btn' href='javascript:void(0);' onclick='deleteComment({{ $comment->id }});'>
              <span class='glyphicon glyphicon-trash'></span>
            </a></div>
        @else
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

        