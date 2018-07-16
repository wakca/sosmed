@extends('layouts.admin')
@section('title', 'Desa ' . $desa->nama . '('.$desa->id.') - Kec ' . $desa->kecamatan->nama . '  - ' . $desa->kecamatan->kab->nama . ' - Prov ' . $desa->kecamatan->kab->prov->nama)
@section('content')
@if($data == 'edit')
    @include('admin_desa.story.edit')
@else
    @include('admin_desa.story.index')
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