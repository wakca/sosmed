<h4 class='page-header'>Semua Pemberitahuan</h4>
@if($notifs->isEmpty())
    Tidak ada pemberitahuan.
@else
<div id='list-notifs' class="list-group">
    @foreach($notifs as $notif)
        @if($notif->type == 3)
            <div onclick="readNotif({{ $notif->id }},'/{{ $notif->user->username }}')" class="list-group-item notif {{ $notif->read == 'N' ? 'unread' :'' }}"><img height='40' src="/photos/{{ isset($notif->user->photo) ? $notif->user->photo : 'av-default.jpg' }}" alt="{{ $notif->user->name }}"> <strong>{{ $notif->user->name }}</strong> mulai mengikuti Anda. <span class="small-text">{{ Date::parse($notif->tgl_notif)->ago() }}</span></div>
        @elseif($notif->type == 1)
            <div onclick="readNotif({{ $notif->id }},'/post/{{ $notif->post_id }}')"  class="list-group-item notif {{ $notif->read == 'N' ? 'unread' :'' }}"><img height='40' src="/photos/{{ isset($notif->user->photo) ? $notif->user->photo : 'av-default.jpg' }}" alt="{{ $notif->user->name }}"> <strong>{{ $notif->user->name }}</strong> mengomentari post Anda. <span class="small-text">{{ Date::parse($notif->tgl_notif)->ago() }}</span></div>
        @elseif($notif->type == 4)
            <div onclick="readNotif({{ $notif->id }},'/post/{{ $notif->post_id }}')"  class="list-group-item notif {{ $notif->read == 'N' ? 'unread' :'' }}"><img height='40' src="/photos/{{ isset($notif->user->photo) ? $notif->user->photo : 'av-default.jpg' }}" alt="{{ $notif->user->name }}"> <strong>{{ $notif->user->name }}</strong> mengomentari post miliknya yang Anda ikuti. <span class="small-text">{{ Date::parse($notif->tgl_notif)->ago() }}</span></div>
        @elseif($notif->type == 2)
            <div onclick="readNotif({{ $notif->id }},'/post/{{ $notif->post_id }}')"  class="list-group-item notif {{ $notif->read == 'N' ? 'unread' :'' }}"><img height='40' src="/photos/{{ isset($notif->user->photo) ? $notif->user->photo : 'av-default.jpg' }}" alt="{{ $notif->user->name }}"> <strong>{{ $notif->user->name }}</strong> menyukai post Anda. <span class="small-text">{{ Date::parse($notif->tgl_notif)->ago() }}</span></div>
        @elseif($notif->type == 5)
            <div onclick="readNotif({{ $notif->id }},'/post/{{ $notif->post_id }}')"  class="list-group-item notif {{ $notif->read == 'N' ? 'unread' :'' }}"><img height='40' src="/photos/{{ isset($notif->user->photo) ? $notif->user->photo : 'av-default.jpg' }}" alt="{{ $notif->user->name }}"> <strong>{{ $notif->user->name }}</strong> mengomentari post yang Anda ikuti. <span class="small-text">{{ Date::parse($notif->tgl_notif)->ago() }}</span></div>
        @elseif($notif->type == 6)
            <div onclick="readNotif({{ $notif->id }},'/post/{{ $notif->post_id }}')"  class="list-group-item notif {{ $notif->read == 'N' ? 'unread' :'' }}"><img height='40' src="/photos/{{ isset($notif->user->photo) ? $notif->user->photo : 'av-default.jpg' }}" alt="{{ $notif->user->name }}"> <strong>{{ $notif->user->name }}</strong> mengirim sebuah post pada profil Anda. <span class="small-text">{{ Date::parse($notif->tgl_notif)->ago() }}</span></div>
        @elseif($notif->type == 7)
            <div onclick="readNotif({{ $notif->id }},'/story/{{ Getter::getStorySlug($notif->post_id) }}#comments')"  class="list-group-item notif {{ $notif->read == 'N' ? 'unread' :'' }}"><img height='40' src="/photos/{{ isset($notif->user->photo) ? $notif->user->photo : 'av-default.jpg' }}" alt="{{ $notif->user->name }}"> <strong>{{ $notif->user->name }}</strong> mengomentari cerita Anda. <span class="small-text">{{ Date::parse($notif->tgl_notif)->ago() }}</span></div>
        @elseif($notif->type == 9)
            <div onclick="readNotif({{ $notif->id }},'/story/{{ Getter::getStorySlug($notif->post_id) }}#comments')"  class="list-group-item notif {{ $notif->read == 'N' ? 'unread' :'' }}"><img height='40' src="/photos/{{ isset($notif->user->photo) ? $notif->user->photo : 'av-default.jpg' }}" alt="{{ $notif->user->name }}"> <strong>{{ $notif->user->name }}</strong> mengomentari cerita miliknya yang Anda ikuti. <span class="small-text">{{ Date::parse($notif->tgl_notif)->ago() }}</span></div>
        @elseif($notif->type == 8)
            <div onclick="readNotif({{ $notif->id }},'/story/{{ Getter::getStorySlug($notif->post_id) }}#comments')"  class="list-group-item notif {{ $notif->read == 'N' ? 'unread' :'' }}"><img height='40' src="/photos/{{ isset($notif->user->photo) ? $notif->user->photo : 'av-default.jpg' }}" alt="{{ $notif->user->name }}"> <strong>{{ $notif->user->name }}</strong> mengomentari cerita yang Anda ikuti. <span class="small-text">{{ Date::parse($notif->tgl_notif)->ago() }}</span></div>
        @endif
    @endforeach
    <div class='hidden-div'>{{ $notifs->links() }}</div>
</div>
@endif
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
        
        $('#list-notifs').infinitescroll({
          loading : loading_options,
          navSelector : "#wrapper .pagination",
          nextSelector : "#wrapper .pagination li.active + li a",
          itemSelector : "#list-notifs div.notif",
        });
        
    });
    function readNotif(id,url) {
        $.ajax({
            url:'/notifications/'+id,
            type:'GET',
            success:function(data){
                window.location=url;
            }
        });
    }
</script>
@endsection