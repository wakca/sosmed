<h4 class='page-header'>Orang yang mengikuti {{ $profile->id == Auth::Id() ? "Anda":$profile->name }}</h4>
<div class='row' id='list-followers'>
    @foreach($followers as $follower)
        <div class='col-md-4 followers'>
            <div class='panel panel-default margin-bot-top'>
                <div class='panel-body'>
                    <div class="media user" data-user-id="{{ $follower->id }}" id="user-{{ $follower->id }}">
                        <div class="media-left">
                          <a href="#">
                            <img class="media-object" width='55' src="/photos/{{ isset($follower->photo) ? $follower->photo : 'av-default.jpg' }}" alt="{{ $follower->name }}">
                          </a>
                        </div>
                        <div class="media-body">
                          <h4 class="media-heading"><a href='/{{ $follower->username }}' title='{{ $follower->name }} &#64;{{ $follower->username }}'>{{ $follower->name }}</a> <span class='small-text'> &#64;{{ $follower->username }}</span></h4>
                            @if(Auth::Id() != $follower->id)
                          {!! Getter::isFollowing($follower->id,Auth::Id()) == true ? "<button id='follow-btn' class='btn btn-sm btn-primary' onclick='follow(".$follower->id.")'>Following</button>":"<button id='follow-btn' class='btn btn-sm btn-default' onclick='follow(".$follower->id.")'>+ Follow</button>" !!}
                            @endif
                        </div>
                    </div>
                    </div>
                </div>
        </div>
    @endforeach
    <div class='hidden-div'>{{ $followers->links() }}</div>
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
    
        $('#list-followers').infinitescroll({
          loading : loading_options,
          navSelector : "#wrapper .pagination",
          nextSelector : "#wrapper .pagination li.active + li a",
          itemSelector : "#list-followers div.followers",
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