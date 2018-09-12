<h4 class='page-header'>Orang yang {{ $profile->id == Auth::Id() ? "Anda":$profile->name }} Ikuti</h4>
<div class='row' id='list-following'>
    @foreach($following as $follows)
        <div class='col-md-4 following'>
            <div class='panel panel-default margin-bot-top'>
                <div class='panel-body'>
                    <div class="media user" data-user-id="{{ $follows->id }}" id="user-{{ $follows->id }}">
                        <div class="media-left">
                          <a href="#">
                            <img class="media-object" width='55' src="/photos/{{ isset($follows->photo) ? $follows->photo : 'av-default.jpg' }}" alt="{{ $follows->name }}">
                          </a>
                        </div>
                        <div class="media-body">
                          <h4 class="media-heading"><a href='/{{ $follows->username }}'  title='{{ $follows->name }} &#64;{{ $follows->username }}'>{{ $follows->name }}</a> <span class='small-text'> &#64;{{ $follows->username }}</span></h4>
                          @if(Auth::Id() != $follows->id)
                          {!! Getter::isFollowing($follows->id,Auth::Id()) == true ? "<button id='follow-btn' class='btn btn-sm btn-primary' onclick='follow(".$follows->id.")'>Following</button>":"<button id='follow-btn' class='btn btn-sm btn-default' onclick='follow(".$follows->id.")'>+ Follow</button>" !!}
                          @endif
                        </div>
                    </div>
                    </div>
                </div>
        </div>
    @endforeach
    <div class='hidden-div'>{{ $following->links() }}</div>
</div>
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
    
        $('#list-following').infinitescroll({
          loading : loading_options,
          navSelector : "#wrapper .pagination",
          nextSelector : "#wrapper .pagination li.active + li a",
          itemSelector : "#list-following div.following",
        });
        
    });
   function follow(id) {
      $followBtn = $("#user-"+id).find("#follow-btn");
      $.ajax({
        url:'/follow/'+id,
        type:'GET',
        dataType:'json',
        success:function(data){
            if (data.status == 'following') {
                $followBtn.removeClass('btn-default').addClass('btn-primary').text('Following');
            }
            else{
                $followBtn.removeClass('btn-primary').addClass('btn-default').text('+ Follow');
            }
        }
      });
   }
</script>
@endsection