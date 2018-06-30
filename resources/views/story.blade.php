@extends('layouts.app')

@section('content')
<div class="container">
    <div class='row'>
        <div class='col-md-9' id="story-content">
            @if($data == "create")
                @include('stories.create')
            @elseif($data == "edit")
                @include('stories.edit')
            @elseif($data == "view")
                @include('stories.view')
            @else
                @include('stories.index')
            @endif
        </div>
        <div class='col-md-3'>
            @include('profile.card')
            @if($data == "view")
                @include('stories.random')
            @endif
        </div>
    </div>
</div>
@endsection
@section('css')
    <link href="{{ asset('css/summernote.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet">

@endsection
@section('js')
    <script src="{{ asset('js/summernote.min.js') }}"></script>
    <script src="{{ asset('bootstrap-select/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('bootstrap-select/js/i18n/defaults-id_ID.js') }}"></script>  

    <script>
    $('img').addClass('img img-responsive');
    </script>
@endsection