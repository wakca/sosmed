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
                <iframe id="mapDesa" width="300" height="300" frameborder="0" style="border:0" class="img-thumbnail" allowfullscreen></iframe>
            </div>

            <div class="form-group">
                <label>Masukan Url Map <a href="{{url('/')}}" target="_blank"><i class="fa fa-info-circle"></i></a></label>
                <textarea name="map" id="map" rows="6" class="form-control" placeholder="Masukan URL yang terdapat didalam Google Map Embed">{{$desa->map}}</textarea>
                <button id="cekUrl" class="btn btn-primary btn-sm" style="margin-top: 10px;">Cek Url</button>
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
<script src="{{ asset('js/summernote.min.js') }}"></script>
<script>
    // CKEDITOR.replace( 'konten' );

    var embed = '{{$desa->map ? $desa->map : 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d506508.92174098024!2d107.49794985428964!3d-7.342559605138662!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68a6a364a7c085%3A0x301e8f1fc28b8f0!2sGarut+Regency%2C+West+Java!5e0!3m2!1sen!2sid!4v1537446034652'}}';
    $(function(){
        $("#mapDesa").attr('src', embed)
        $('#cekUrl').on('click', function (e) {
            event.preventDefault();
            // document.getElementById('some_frame_id').contentWindow.location.reload();
            var map = $('#map').val();
            if(map){
                $("#mapDesa").attr('src', map);
            }
            console.log('Coba Event');
        });
        $("#konten").summernote( {
            height: 200, toolbar: [ // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']], ['insert', ['picture', 'video', 'link', 'table']], ['font', ['strikethrough', 'superscript', 'subscript']], ['fontsize', ['fontsize']], ['color', ['color']], ['para', ['ul', 'ol', 'paragraph']], ['height', ['height']], ['misc', ['fullscreen']], ],
        });
    })

    function cekUrl(){
        event.preventDefault();
        var map = $('#map').val();
        if(map){
         $("#mapDesa").attr('src', map);
        }
    }
</script>
@endsection