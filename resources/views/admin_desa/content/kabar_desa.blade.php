@extends('layouts.admin')
@section('title','Kabar Desa')
@section('content')
<div class="card ">
    <div class="header">
        <h4 class="title">Kabar Desa</h4>
    </div>
    <div class="content">
        <form action="{{ route('admin_desa.content.kabar_desa.save') }}" method="POST">
            {{ csrf_field() }}
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