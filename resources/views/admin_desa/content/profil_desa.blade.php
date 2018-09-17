@extends('layouts.admin')
@section('title','Profil Desa')
@section('content')
<div class="card ">
    <div class="header">
        <h4 class="title">Profil Desa</h4>
    </div>
    <div class="content">
        <form action="{{ route('admin_desa.content.profil_desa.save') }}" enctype="multipart/form-data" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="id_desa" value="{{$desa ? $desa->id : ''}}">
            <div class="form-group">
                <label>Nama Desa/Kelurahan</label>
                <input type="text" name="nama" readonly class="form-control" value="{{$desa ? $desa->nama : ''}}">
            </div>
            <div class="form-group">
                <label>NIP Kepala Desa/Kelurahan (Jika Status Kepala PNS)</label>
                <input type="text" name="nip" class="form-control" value="{{$desa ? $desa->nip : ''}}">
            </div>

            <div class="form-group">
                <label>Nama Kepala Desa/Kelurahan (Jika Status Kepala PNS)</label>
                <input type="text" name="nama_kades" class="form-control" value="{{$desa ? $desa->nama_kades : ''}}">
            </div>

            <div class="form-group">
                <img src="{{$desa ? $desa->foto_desa ? url('/storage/'.$desa->foto_desa) : url('/img/blank_foto.png') : ''}}" width="200" class="img img-thumbnail" alt="img">
            </div>

            <div class="form-group">
                <label>Foto Banner Desa/Kelurahan</label>
                <input type="file" name="foto_desa" class="form-control" value="{{$desa ? $desa->nip : ''}}">
            </div>

            <div class="form-group">
                <img src="{{$desa ? $desa->foto_kades ? url('/storage/'.$desa->foto_kades) : url('/img/blank_foto.png') : ''}}" width="200" class="img img-thumbnail" alt="img">
            </div>

            <div class="form-group">
                <label>Foto Kepala Desa/Kelurahan</label>
                <input type="file" name="foto_kades" class="form-control" value="{{$desa ? $desa->nip : ''}}">
            </div>

            <div class="form-group">
                <label>Konten Desa</label>
                <textarea name="konten" id="konten" cols="30" rows="15" class="form-control">@if($data) {{ $data->konten }} @endif</textarea>
            </div>

            <div class="clearfix">
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>

<script>
    CKEDITOR.replace( 'konten' );
</script>
@endsection