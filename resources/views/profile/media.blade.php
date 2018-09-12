@foreach($posts as $post)
    <div class="panel posts panel-default" id='post-{{ $post->id }}' data-post-id="{{ $post->id }}">
        <div class="btn-group pull-right">
            <a id='btn-{{ $post->id }}' class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="glyphicon glyphicon-option-vertical"></span>
            </a>
            <ul id='menu-{{ $post->id }}' class="dropdown-menu smalled">
                @if($post->user_id == Auth::Id())
                    <li><a href="javascript:void(0);" onclick='editPost({{ $post->id }});'><span class='glyphicon glyphicon-pencil'></span> Edit Post</a></li>
                    <li><a href="javascript:void(0);" onclick='deletePost({{ $post->id }});'><span class='glyphicon glyphicon-trash'></span> Hapus Post</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="/post/{{ $post->id }}" target='_blank'><span class='glyphicon glyphicon-link'></span> Lihat Post Ini</a></li>
                @else
                    <li><a href="#"><span class='glyphicon glyphicon-save'></span> Simpan Post</a></li>
                    <li><a href="/post/{{ $post->id }}" target='_blank'><span class='glyphicon glyphicon-link'></span> Lihat Post Ini</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#"><span class='glyphicon glyphicon-flag'></span> Laporkan Post</a></li>
                @endif
            </ul>
        </div>
        <div class="panel-body">
            <div class="media">
              <div class="avatar">
                <a href="#">
                  <img class="media-object" width='100%' src="/photos/{{ isset($post->user->photo) ? $post->user->photo : 'av-default.jpg' }}" alt="{{ $post->user->name }}">
                </a>
              </div>
              <div class="content">
                @if($post->user_id != $post->recepient_id)
                  <h4 class="media-heading"><a href='/{{ $post->user->username }}'>{{ $post->user->name }}</a> <span class='smallest-text glyphicon glyphicon-chevron-right'></span> {!! Getter::getRecepientName($post->recepient_id) !!} <span class='small-text'>&bull; <span class='ajax-time time-post-{{ $post->id }}' data-time-post-id = '{{ $post->id }}' data-time='{{ $post->created_at }}'>{{ Date::parse($post->created_at)->ago() }}</span></span></h4>
                @else
                  <h4 class="media-heading"><a href='/{{ $post->user->username }}'>{{ $post->user->name }}</a> <span class='small-text'> &#64;{{ $post->user->username }} &bull; <span class='ajax-time time-post-{{ $post->id }}' data-time-post-id = '{{ $post->id }}' data-time='{{ $post->created_at }}'>{{ Date::parse($post->created_at)->ago() }}</span></span></h4>
                @endif
                <span class='post-content'>{!! strlen($post->content) > 250 ? Getter::getLinkFromStr(str_limit($post->content,250))."<a href='/post/".$post->id."'>Selengkapnya</a>":Getter::getLinkFromStr($post->content) !!}</span>
                @if($post->has_image == 'Y')
                    {!! Getter::getPostImages($post->id) !!}
                @endif
                <ul class="nav nav-pills">
                    <li><a href='javascript:void(0)' onclick='likePost({{ $post->id }})'><span class='glyphicon like-icon glyphicon-heart {{ Getter::isLike($post->id)?' liked':'' }}'></span><span class='likes'>{{ Getter::getNumLikes($post->id) == 0?'': ' '.Getter::getNumLikes($post->id)}}</span></a></li>
                    <li><a href='/post/{{ $post->id }}'><span class='glyphicon glyphicon-comment'></span><span class='numcomments'>{{ Getter::getNumComments($post->id) == 0?'': ' '.Getter::getNumComments($post->id)}}</span></a></li>
                    <li><a href='javascript:void(0)' onclick='sharePost({{ $post->id }})'><span class='glyphicon glyphicon-share-alt'></span></a></li>
                </ul>
              </div>
            </div>
        </div>
    </div>
<!-- 
    <div class="panel posts panel-default" id='post-empty'>
        <div class="panel-body">
            Belum ada post pada timeline.
        </div>
    </div> -->
@endforeach
<div class='hidden-div'>{{ $posts->links() }}</div>