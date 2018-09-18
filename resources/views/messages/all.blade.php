 @foreach($users as $user)
     @if($user->recepient_id == Auth::Id())
        <div class="panel message panel-default">
            <div class="btn-group pull-right">
                <a href='javascript:void(0);' onclick='deleteConversation({{ $user->conversation_id }})' title='Hapus Pesan' class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="glyphicon glyphicon-remove"></span>
                </a>
            </div>
            <div class="panel-body">
                <div class="media message-link" onclick="window.location='/messages/{{ $user->sender->username }}'">
                  <div class="avatar">
                    <a href="#">
{{--                        <img class="media-object" width='100%' src="/photos/{{ isset($user->sender->photo) ? $user->sender->photo : 'av-default.jpg' }}" alt="{{ $user->sender->name }}">--}}
                        <img class="media-object" width='100%' src="{{$user->sender->photo ? url('/storage/'.$user->sender->photo) : url('/photos/av-default.jpg')}}" alt="{{ $user->sender->name }}">
                    </a>
                  </div>
                  <div class="content">
                    <h4 class="media-heading"><a href='/{{ $user->sender->username }}'>{{ $user->sender->name }}</a> <span class='small-text'> &#64;{{ $user->sender->username }} &bull; <span class='ajax-time time-post-' data-time-post-id = '' data-time=''>{{ Date::parse($user->created_at)->ago() }}</span></span></h4>
                    @if($user->read == 'Y')
                        <span class='post-content'>{{ strlen($user->message) > 50?str_limit($user->message,50)."...":$user->message }}</span>
                    @else
                        <span class='post-content'><strong>{{ strlen($user->message) > 50?str_limit($user->message,50):$user->message }}</strong></span>
                    @endif
                  </div>
                </div>
            </div>
        </div>
    @else
        <div class="panel message panel-default">
            <div class="btn-group pull-right">
                <a href='javascript:void(0);' onclick='deleteConversation({{ $user->conversation_id }})'  title='Hapus Pesan' class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="glyphicon glyphicon-remove"></span>
                </a>
            </div>
            <div class="panel-body">
                <div class="media message-link" onclick="window.location='/messages/{{ $user->receiver->username }}'">
                  <div class="avatar">
                    <a href="#">
                        {{--<img class="media-object" width='100%' src="/photos/{{ isset($user->receiver->photo) ? $user->receiver->photo : 'av-default.jpg' }}" alt="{{ $user->receiver->name }}">--}}
                        <img class="media-object" width='100%' src="{{$user->receiver->photo ? url('/storage/'.$user->receiver->photo) : url('/photos/av-default.jpg')}}" alt="{{ $user->receiver->name }}">
                    </a>
                  </div>
                  <div class="content">
                    <h4 class="media-heading"><a href='/{{ $user->receiver->username }}'>{{ $user->receiver->name }}</a> <span class='small-text'> &#64;{{ $user->receiver->username }} &bull; <span class='ajax-time time-post-' data-time-post-id = '' data-time=''>{{ Date::parse($user->created_at)->ago() }}</span></span></h4>
                        <span class='post-content'>{{ strlen($user->message) > 50?str_limit($user->message,50)."...":$user->message }}</span>
                  </div>
                </div>
            </div>
        </div>
    @endif
@endforeach