@extends('layouts.app')
@section('title')
   Pemberitahuan | 
@endsection
@section('content')
<div class="container">
    <div class='row'>
        <div class='col-md-9'>
            <div id='wrapper'>
                @include('profile.notif')
                <div class='center-text' id='load-more'>
                </div>
            </div>
        </div>
        <div class='col-md-3'>
            @include('follows.suggest')
        </div>
    </div>
</div>
@endsection
