
@forelse(Getter::getSuggestFollows(Auth::Id()) as $suggest)
    <div class="media user" data-user-id="{{ $suggest->id }}" id="user-{{ $suggest->id }}">
        <div class="media-left">
          <a href="#">
            {{--<img class="media-object" width='55' src="/photos/{{ isset($suggest->photo) ? $suggest->photo : 'av-default.jpg' }}" alt="{{ $suggest->name }}">--}}
            <img class="media-object" width='55' src="{{$suggest->photo ? url('/storage/'.$suggest->photo) : url('/photos/av-default.jpg')}}" alt="{{ $suggest->name }}">
          </a>
        </div>
        <div class="media-body">
          <h4 class="media-heading"><a href='/{{ $suggest->username }}' title='{{ $suggest->name }} &#64;{{ $suggest->username }}'>{{ $suggest->name }}</a> <span class='small-text'> &#64;{{ $suggest->username }}</span></h4>
          <button id='follow-btn' class='btn btn-sm btn-default' onclick='follow({{$suggest->id}})'>+ Follow</button>
        </div>
    </div>
@empty
<span class='small-text'>Tidak ada user lain yang bisa difollow.</span>
@endforelse