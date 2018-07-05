@extends('desa.layout')
@section('title')
Peta Desa {{ $desa->nama }}
@endsection

@section('content')
<div style="margin-top: 30px"></div>
<div class="panel panel-primary">
    <div class="panel-heading">
        Peta Lokasi Desa
    </div>
    <div class="panel-body">
        <div class="clearfix">
            <div class="pull-right">
                <div class="btn-group">
                    <button class="btn btn-default">Database</button>
                    <button class="btn btn-default">Tataguna Lahan</button>
                    <button class="btn btn-default">Status Lahan</button>
                </div>
            </div>
        </div>
        <br>
        <div id="map"></div>
        <iframe src="https://petadesa.klikdesa.com/mod/peta.php?id={{ $desa->id }}" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
</div>
@endsection

@section('sidebar_peta')
<h2>test</h2>
@endsection

@section('styles')
@endsection

@section('scripts')
@endsection