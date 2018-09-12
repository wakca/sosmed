<h4 class='page-header'>Hasil Pencarian</h4>
@if($results->isEmpty())
    Data tidak ditemukan.
@else
<div class='row' id='list-people'>
    @foreach($results as $result)
        <div class='col-md-6 people'>
            <div class='panel panel-default margin-bot-top'>
                <div class='panel-body'>
                    <div class="media user" data-user-id="{{ $result->id }}" id="user-{{ $result->id }}">
                        <div class="media-left">
                          <a href="#">
                            <img class="media-object" width='55' src="/photos/{{ isset($result->photo) ? $result->photo : 'av-default.jpg' }}" alt="{{ $result->name }}">
                          </a>
                        </div>
                        <div class="media-body">
                          <h4 class="media-heading"><a href='/{{ $result->username }}'  title='{{ $result->name }} &#64;{{ $result->username }}'>{{ $result->name }}</a> <span class='small-text'> &#64;{{ $result->username }}</span></h4>
                          @if(Auth::Id() != $result->id)
                          {!! Getter::isFollowing($result->id,Auth::Id()) == true ? "<button id='follow-btn' class='btn btn-sm btn-primary' onclick='follow(".$result->id.")'>Following</button>":"<button id='follow-btn' class='btn btn-sm btn-default' onclick='follow(".$result->id.")'>+ Follow</button>" !!}
                          @endif
                        </div>
                    </div>
                    </div>
                </div>
        </div>
    @endforeach
    <div class='hidden-div'>{{ $results->links() }}</div>
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
    
        $('#list-people').infinitescroll({
          loading : loading_options,
          navSelector : "#wrapper .pagination",
          nextSelector : "#wrapper .pagination li.active + li a",
          itemSelector : "#list-people div.people",
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