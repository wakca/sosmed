@extends('layouts.admin')
@section('title','Profil Desa')
@section('content')
<div class="card ">
    <div class="header">
        <h4 class="title">Profil Desa</h4>
    </div>
    <div class="content">
        <form action="{{ route('admin_desa.content.profil_desa.save') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label>Nama Desa</label>
                <input type="text" readonly class="form-control">
            </div>
            <div class="form-group">
                <label>NIP Kepala Desa (jika status PNS)</label>
                <input type="text" readonly class="form-control">
            </div>
            <div class="form-group">
                <label>Nama Kepala Desa</label>
                <input type="text" readonly class="form-control">
            </div>
            <div class="form-group">
                <label>Foto Profil Desa</label>
                <input type="file" readonly class="form-control">
            </div>
            <div class="form-group">
                <label>Banner Desa</label>
                <input type="file" readonly class="form-control">
            </div>
            <div class="form-group">
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