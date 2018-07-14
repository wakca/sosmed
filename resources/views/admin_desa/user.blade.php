@extends('layouts.admin')
@section('title','User')
@section('content')
@if($data == 'create')
    @include('admin_desa.user.create')
@elseif($data == 'edit')
    @include('admin_desa.user.edit')
@else
    @include('admin_desa.user.index')
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