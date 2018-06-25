@extends('layouts.app')
@section('title')
    Orang yang mengikuti {{ $profile->id == Auth::Id() ? "Anda":$profile->name }} | 
@endsection
@section('content')
<div class="container">
    <div class='row'>
        <div class='col-md-3'>
            @include('profile.card2')
        </div>
        <div class='col-md-9'>
            <div id='wrapper'>
                @include('follows.followers');
                <div class='center-text' id='load-more'>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
