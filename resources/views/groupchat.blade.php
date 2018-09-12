@extends('layouts.app')
@section('title')
    Semua Pesan Grup | 
@endsection
@section('content')
<div class="container">
    <div class='row'>
        <div class='col-md-3'>
            @include('profile.card')
        </div>
        <div class='col-md-6'>
            <div class="btn-group btn-group-justified" role="group" aria-label="message">
                <a href='/messages' class='btn btn-default'>{!! Getter::getNumMessages(Auth::Id()); !!}Personal</a>
                <a href='/messages/group' class='btn btn-primary'>{!! Getter::getNumGroupMessages(Auth::Id()); !!} Grup</a>
            </div>
            @include('groupchat.index')
            <div id='wrapper' class='margin-bottom'>
                <div id='list-posts'>
                    @include('groupchat.all')
                </div>
                
            </div>
        </div>
        <div class='col-md-3'>
            @include('follows.suggest')
        </div>
    </div>
</div>
@endsection
