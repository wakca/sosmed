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
            @if($story->des)
                <div class="panel" style="margin-bottom: 20px;">
                    <div class="panel-heading">
                        <h3 class="panel-title">Menu Pintas</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{url('/profil_desa/'.$story->des->id.'/beranda')}}" class="btn btn-primary btn-block" style="white-space: normal;">Masuk ke Desa/Kelurahan {{$story->des->nama}}</a>
                                <a href="{{url('/profil_desa/'.$story->des->id.'/produk')}}" class="btn btn-success btn-block" style="white-space: normal;">Produk Unggulan Desa/Kelurahan {{$story->des->nama}}</a>

                            </div>
                        </div>

                    </div>
                </div>
            @endif

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