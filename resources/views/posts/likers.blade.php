@foreach($likes as $like)
    <div class="media likers" data-user-id="{{ $like->user->id }}" id="user-{{ $like->user->id }}">
        <div class="media-left">
          <a href="#">
            {{--<img class="media-object" width='55' src="/photos/{{ isset($like->user->photo) ? $like->user->photo : 'av-default.jpg' }}" alt="{{ $like->user->name }}">--}}
            <img class="media-object" width='55' src="{{$like->user->photo ? url('/storage/'.$like->user->photo) : url('/photos/av-default.jpg')}}" alt="{{ $like->user->name }}">
          </a>
        </div>
        <div class="media-body">
          <h4 class="media-heading"><a href='/{{ $like->user->username }}' title='{{ $like->user->name }} &#64;{{ $like->user->username }}'>{{ $like->user->name }}</a> <span class='small-text'> &#64;{{ $like->user->username }}</span></h4>
            @if(Auth::Id() != $like->user->id)
          {!! Getter::isFollowing($like->user->id,Auth::Id()) == true ? "<button id='follow-btn' class='btn btn-sm btn-primary' onclick='follow(".$like->user->id.")'>Following</button>":"<button id='follow-btn' class='btn btn-sm btn-default' onclick='follow(".$like->user->id.")'>+ Follow</button>" !!}
            @endif
        </div>
    </div>
@endforeach
