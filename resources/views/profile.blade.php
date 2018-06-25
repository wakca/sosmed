@extends('layouts.app')
@section('title')
    {{ $profile->name }} | 
@endsection
@section('content')
<div class="container">
    <div class='row'>
        <div class='col-md-3'>
            @include('profile.card2')
        </div>
        <div class='col-md-6'>
            <div class="btn-group btn-group-justified" role="group" aria-label="profile">
                <a href='/{{ $profile->username }}' class='btn btn-primary'>Profile</a>
                <a href='/{{ $profile->username }}/posts' class='btn btn-default'>Posts</a>
                <a href='/{{ $profile->username }}/media' class='btn btn-default'>Media</a>
            </div>
            @include('profile.index')
            <div id='wrapper' class='margin-bottom'>
                <div id='list-posts'>
                    @include('profile.posts')
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
