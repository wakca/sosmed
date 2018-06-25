@extends('layouts.admin')
@section('title','User')
@section('menu')
    <ul class="nav">
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <i class="pe-7s-graph"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class='active'>
            <a href="{{ route('admin.user') }}">
                <i class="pe-7s-users"></i>
                <p>Users</p>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.story') }}">
                <i class="pe-7s-news-paper"></i>
                <p>Story</p>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.tag') }}">
                <i class="pe-7s-ticket"></i>
                <p>Tag</p>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.post') }}">
                <i class="pe-7s-pen"></i>
                <p>Post</p>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.comment') }}">
                <i class="pe-7s-comment"></i>
                <p>Comment</p>
            </a>
        </li>
    </ul>
@endsection
@section('content')
@if($data == 'create')
    @include('admin.user.create')
@elseif($data == 'edit')
    @include('admin.user.edit')
@else
    @include('admin.user.index')
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