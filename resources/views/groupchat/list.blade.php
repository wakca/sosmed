@if(count($messages) == 0)
  Tidak ada Obrolan.
@endif
@foreach($messages as $message)
    @if($message->user_id != Auth::Id())
        <div class="media other">
          <div class="avatar">
            <a href="#">
              {{--<img class="media-object" width='100%' src="/photos/{{ isset($message->user->photo) ? $message->user->photo : 'av-default.jpg' }}" alt="{{ $message->user->name }}">--}}
              <img class="media-object" width='100%' src="{{$message->user->photo ? url('/storage/'.$message->user->photo) : url('/photos/av-default.jpg')}}" alt="{{ $message->user->name }}">
            </a>
          </div>
          <div class="content">
            <!-- <div class="btn-group pull-right">
                <a href='javascript:void(0);' onclick='deleteMessage({{ $message->id }});' class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="glyphicon glyphicon-trash"></span>
                </a>
            </div> -->
            <a href='/{{ $message->user->username }}' class='media-heading'>{{ $message->user->name }}</a>
             &bull; <span class='small-text'><span class='ajax-time time-post-' data-time-post-id = '' data-time=''>{{ Date::parse($message->created_at)->ago() }}</span></span>
            <p><span class='post-content other'>{{ $message->message }}</span></p>
            @if($message->has_image == 'Y')
                {!! Getter::getGroupMsgImages($message->id) !!}
            @endif
          </div>
        </div>
    @else
      <div class="media owner">
        <div class="content align-right">
          <!-- <div class="btn-group pull-left">
              <a href='javascript:void(0);' onclick='deleteMessage({{ $message->id }});' class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="glyphicon glyphicon-trash"></span>
              </a>
          </div> -->
          <span class='small-text'><span class='ajax-time time-post-' data-time-post-id = '' data-time=''>{{ Date::parse($message->created_at)->ago() }}</span></span>
            &bull; <strong>Anda</strong><p><span class='post-content owner'>{{ $message->message }}</span></p>
          @if($message->has_image == 'Y')
              {!! Getter::getGroupMsgImages($message->id) !!}
          @endif
        </div>
        <div class="avatar">
          <a href="#">
            {{--<img class="media-object" width='100%' src="/photos/{{ isset($profile->photo) ? $profile->photo : 'av-default.jpg' }}" alt="{{ $profile->name }}">--}}
            <img class="media-object" width='100%' src="{{$profile->photo ? url('/storage/'.$profile->photo) : url('/photos/av-default.jpg')}}" alt="{{ $profile->name }}">
          </a>
        </div>
      </div>
    @endif
@endforeach