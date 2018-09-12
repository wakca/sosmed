@if(count($messages) == 0)
  Tidak ada Pesan.
@endif
@foreach($messages as $message)
    @if($message->user_id != Auth::Id())
      @if($message->del_receiver == 'N')
        <div class="media other">
          <div class="avatar">
            <a href="#">
              <img class="media-object" width='100%' src="/photos/{{ isset($receiver->photo) ? $receiver->photo : 'av-default.jpg' }}" alt="{{ $receiver->name }}">
            </a>
          </div>
          <div class="content">
            <div class="btn-group pull-right">
                <a href='javascript:void(0);' onclick='deleteMessage({{ $message->id }});' class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="glyphicon glyphicon-trash"></span>
                </a>
            </div>
            <span class='small-text'><span class='ajax-time time-post-' data-time-post-id = '' data-time=''>{{ Date::parse($message->created_at)->ago() }}</span></span>
            <p><span class='post-content other'>{{ $message->message }}</span></p>
            @if($message->has_image == 'Y')
                {!! Getter::getMsgImages($message->id) !!}
            @endif
          </div>
        </div>
      @endif
    @else
      @if($message->del_sender == 'N')
      <div class="media owner">
        <div class="content align-right">
          <div class="btn-group pull-left">
              <a href='javascript:void(0);' onclick='deleteMessage({{ $message->id }});' class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="glyphicon glyphicon-trash"></span>
              </a>
          </div>
          <span class='small-text'><span class='ajax-time time-post-' data-time-post-id = '' data-time=''>{{ Date::parse($message->created_at)->ago() }}</span></span>
          <p><span class='post-content owner'>{{ $message->message }}</span></p>
          @if($message->has_image == 'Y')
              {!! Getter::getMsgImages($message->id) !!}
          @endif
        </div>
        <div class="avatar">
          <a href="#">
            <img class="media-object" width='100%' src="/photos/{{ isset($profile->photo) ? $profile->photo : 'av-default.jpg' }}" alt="{{ $profile->name }}">
          </a>
        </div>
      </div>
      @endif
    @endif
@endforeach