@extends('layouts.app')
@section('title')
    Lihat Obrolan | 
@endsection
@section('content')
<div class="container">
    <div class='row'>
        <div class='col-md-3'>
            @include('profile.card')
        </div>
        <div class='col-md-6'>
            @include('groupchat.show')
        </div>
        <div class='col-md-3'>
            @include('follows.suggest')
        </div>
    </div>
</div>
@endsection
