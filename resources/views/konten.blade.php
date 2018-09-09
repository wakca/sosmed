@extends('layouts.app')

@section('title')
{{ $konten->title }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel panel-heading">
                    {{ $konten->title }}
                </div>
                <div class="panel panel-body">
                    {!! $konten->content !!}
                </div>
            </div>
    
        </div>
        <div class="col-md-4">
    
    
        </div>
    
    </div>
</div>
@endsection