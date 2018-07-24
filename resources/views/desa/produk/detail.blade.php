@extends('layouts.app')

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class='panel-heading'>
            Detail Produk {{ $produk->nama }}
        </div>
        <div class="panel-body">
            {!! $produk->konten !!}
        </div>
    </div>
</div>
@endsection
@section('css')
    <link href="{{ asset('css/summernote.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet">

@endsection