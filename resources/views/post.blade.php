@extends('layouts.app')
@section('title')
    {{ Getter::getSummaryPost($post->content) }} | 
@endsection
@section('content')
<div class="container">
    <div class='row'>
        <div class='col-md-3'>
            @include('profile.card')
        </div>
        <div class='col-md-6'>
            @include('posts.show')
            <div id='wrapper margin-bottom'>
                <div id='list-comments'>
                    @include('comments.all')
                </div>
                @if(count($comments) == config('global.paginate_number') && $comments->lastPage() != 1)
                <div class='panel panel-notempty panel-default'>
                    <div class='panel-body center-text' id='load-more'>
                        <span class='finished hidden-div'>Tidak ada komentar lain untuk ditampilkan.</span>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class='col-md-3'>
            @include('follows.suggest')
        </div>
    </div>
</div>
@endsection
