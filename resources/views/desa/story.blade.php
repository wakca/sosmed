@extends('desa.layout')
@section('title')
Story di Desa {{ $desa->nama }}
@endsection

@section('content')
<h2>
    Story di Desa {{ $desa->nama }}
</h2>

<div id='story' class="col-md-12">
    <div class='row story-container' id='list-story'>
        @foreach($stories as $story)
            <div class='panel story panel-default'>
                <div class='panel-heading'><img height='25' class='img-rounded' src='{{ asset('photos/'.(isset($story->user->photo) ? $story->user->photo : 'av-default.jpg')) }}'/> <strong><a href='{{ $story->user->username }}'>{{ $story->user->name }}</a></strong> <span class='pull-right'>{{ Date::parse($story->created_at)->ago() }} &bull; <i class='glyphicon glyphicon-comment'></i> <strong>{{ count($story->comment) }}</strong></span></div>
                <div class='panel-body'>
                    {!! Getter::getStoryThumb($story->content,$story->title) !!}
                    <div class="caption">
                        <h4><a href='{{ route('story.view',['slug' => $story->slug]) }}'>{{ $story->title }}</a></h4>
                        <p>{{ strlen(strip_tags($story->content)) > 100 ? str_limit(strip_tags($story->content),100)."...":strip_tags($story->content) }}</p>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="pull-right">
            <div>{{ $stories-> links() }}</div>
                <div class='center-text' id='load-more'>
            </div>
        </div>
    </div>
</div>
@endsection