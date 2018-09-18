@extends('layouts.app')
@section('content')
<!-- Modal Tags -->
<div class="modal fade" id='modal-tags' tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><span class='glyphicon glyphicon-tag'></span> Tampilkan Story berdasarkan tag</h4>
      </div>
      <div id='list-tags'>
        <ul class='list-group'>
            <li class="list-group-item {{ app('url')->current() == route('index')?"active":"" }}"><a href='{{ route('index') }}' >Semua</a></li>
            @foreach($tags as $tag)
            <li class="list-group-item {{ app('url')->current() == route('story.tag',['tag' => $tag->name])?"active":"" }}"><a href='{{ route('story.tag',['tag' => $tag->name]) }}'>{{ ucfirst($tag->name) }}</a></li>
            @endforeach
        </ul> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class='container bgstory'>
<div class='row'>
    <div class='col-md-3 list-tag'>
        <div data-spy="affix" data-offset-top="60" data-offset-bottom="200" class='panel panel-default'>
            <div class='panel-heading'><i class='glyphicon glyphicon-tag'></i> Apa yang sedang terjadi ?</div>
              <ul class='list-group'>
                <li class="list-group-item {{ app('url')->current() == route('index')?"active":"" }}"><a href='{{ route('index') }}' >Semua</a></li>
                @foreach($tags as $tag)
                <li class="list-group-item {{ app('url')->current() == route('story.tag',['tag' => $tag->name])?"active":"" }}"><a href='{{ route('story.tag',['tag' => $tag->name]) }}'>{{ ucfirst($tag->name) }}</a></li>
                @endforeach
            </ul>  
        </div>
    </div>
    <div class='col-md-9 col-xs-12'>
        <div class='mobile-tag'>
            <h1>Apa yang sedang terjadi ?<button onclick='openTags();' class='btn btn-sm btn-default pull-right'><i class='glyphicon glyphicon-tag'></i> {{ !Request::route('tag')?'Semua':ucwords(Request::route('tag')) }}</button></h1>
        </div>
        <div id='wrapper'>
            <div id='story'>
                <div class='row story-container' id='list-story'>
                @foreach($stories as $story)
                    <div class='panel story panel-default'>
{{--                        <div class='panel-heading'><img height='25' class='img-rounded' src='{{ asset('photos/'.(isset($story->user->photo) ? $story->user->photo : 'av-default.jpg')) }}'/> <strong><a href='{{ $story->user->username }}'>{{ $story->user->name }}</a></strong> <span class='pull-right'>{{ Date::parse($story->created_at)->ago() }} &bull; <i class='glyphicon glyphicon-comment'></i> <strong>{{ count($story->comment) }}</strong></span></div>--}}
                        <div class='panel-heading'>
                            <img height='25' class='img-rounded' src='{{ $story->user->photo ? url('/storage/'.$story->user->photo) : url('/photos/av-default.jpg') }}'/> <strong><a href='{{ $story->user->username }}'>{{ $story->user->name }}</a></strong> <span class='pull-right'>{{ Date::parse($story->created_at)->ago() }} &bull; <i class='glyphicon glyphicon-comment'></i> <strong>{{ count($story->comment) }}</strong></span>
                        </div>
                        <div class='panel-body'>
                            {!! Getter::getStoryThumb($story->content,$story->title) !!}
                            <div class="caption">
                              <h4><a href='{{ route('story.view',['slug' => $story->slug]) }}'>{{ $story->title }}</a></h4>
                              <p>{{ strlen(strip_tags($story->content)) > 100 ? str_limit(strip_tags($story->content),100)."...":strip_tags($story->content) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
            <div class='hidden-div'>{{ $stories-> links() }}</div>
                <div class='center-text' id='load-more'>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('script')
<script src="{{ asset('js/jquery.infinitescroll.min.js') }}"></script>
<script type='text/javascript'>
    function openTags() {
        $("#modal-tags").modal("show");
    }
    $(function() {
        var $affixElement = $('div[data-spy="affix"]');
        $affixElement.width($affixElement.parent().width());
    });
    $(document).ready(function(){
        $('.story-container .story:nth-child(3n - 1)').addClass('story-container-col2');
        $('.story-container .story:nth-child(3n)').addClass('story-container-col3');
        
        $('.story-container-col2').appendTo('.story-container').removeClass('story-container-col2');
        $('.story-container-col3').appendTo('.story-container').removeClass('story-container-col3');
        
        var loading_options = {
            finishedMsg:'',
            msgText:'',
            selector: '#load-more',
            speed:'normal',
        };
    
        $('#list-story').infinitescroll({
          loading : loading_options,
          navSelector : "#wrapper .pagination",
          nextSelector : "#wrapper .pagination li.active + li a",
          itemSelector : "#list-story div.story",
        });
    });
</script>
@endsection