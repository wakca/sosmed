@extends('layouts.app')
@section('title')
    Hasil Pencarian | 
@endsection
@section('content')
<div class="container">
    <div class='row'>
        <div class='col-md-8'>
            <div id='wrapper'>
                @include('profile.search')
                <div class='center-text' id='load-more'>
                </div>
            </div>
        </div>
        <div class='col-md-4'>
            @include('profile.search2')
        </div>
    </div>
</div>
@endsection
