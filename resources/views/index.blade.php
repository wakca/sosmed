@extends('layouts.app')
@section('content')
        <home :side-menu="{{json_encode($sidemenu)}}"></home>
@endsection