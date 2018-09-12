@extends('layouts.app')

@section('content')
<div class="container">
    <div class='row'>
        <div class='col-md-3'>
            @include('profile.card')
        </div>
        <div class='col-md-6'>
            @include('posts.index')
            <div id='wrapper' class='margin-bottom'>
                <div id='list-posts'>
                    @include('posts.all')
                </div>
                @if(count($posts) == config('global.paginate_number') && $posts->lastPage() != 1)
                <div class='panel panel-notempty panel-default'>
                    <div class='panel-body center-text' id='load-more'>
                        <span class='finished hidden-div'>Tidak ada post lain untuk ditampilkan.</span>
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
