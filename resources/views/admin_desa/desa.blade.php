@extends('layouts.admin')
@section('title','Kecamatan ' . $kecamatan->nama )
@section('content')
@if($data == 'create')
    @include('admin.pengurus.create')
@elseif($data == 'edit')
    @include('admin.pengurus.edit')
@else
    @include('admin.pengurus.desa')
@endif
@endsection
@section('css')
    <link href="{{ asset('css/summernote.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet">
@endsection
@section('js')
    <script src="{{ asset('js/summernote.min.js') }}"></script>
    <script src="{{ asset('bootstrap-select/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('bootstrap-select/js/i18n/defaults-id_ID.js') }}"></script>  
@endsection