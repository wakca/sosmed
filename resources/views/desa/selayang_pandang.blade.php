@extends('desa.template')
@section('title')
Produk di Desa {{ $desa->nama }}
@endsection

@section('content')
<h2>Selayang Pandang {{ $desa->nama }}</h2>
<hr>
@if($data)
{!! $data->konten !!}
@else
<p>Belum ada Konten</p>
@endif
@endsection

@section('scripts')
<script>
    var id_desa = {{ $desa->id }};
    var url =  "{{ url('/') }}/";

    var judul = $("#judul_konten");
    var konten = $("#konten_desa");

    //Data Default - Profil
    $.get(url+"api/konten_desa/"+id_desa+"/profil_desa", function(data){
        judul.html('Profil Desa');
        konten.html(data);
    });

    //selayang_pandang
    $("#selayang_pandang").click(function(e){
        $.get(url+"api/konten_desa/"+id_desa+"/selayang_pandang", function(data){
            judul.html('Selayang Pandang');
            konten.html(data);
        });
    });

    //organisasi_desa
    $("#organisasi_desa").click(function(e){
        $.get(url+"api/konten_desa/"+id_desa+"/organisasi_desa", function(data){
            judul.html('Organisasi Desa');
            konten.html(data);
        });
    });

    //galeri_desa
    $("#galeri_desa").click(function(e){
        $.get(url+"api/konten_desa/"+id_desa+"/galeri_desa", function(data){
            judul.html('Galeri Desa');
            konten.html(data);
        });
    });

    //profil_desa
    $("#profil_desa").click(function(e){
        $.get(url+"api/konten_desa/"+id_desa+"/profil_desa", function(data){
            judul.html('Profil Desa');
            konten.html(data);
        });
    });

    //produk_unggulan
    $("#produk_unggulan").click(function(e){
        $.get(url+"api/konten_desa/"+id_desa+"/produk_unggulan", function(data){
            judul.html('Produk Unggulan');
            konten.html(data);
        });
    });

    //kabar_desa
    $("#kabar_desa").click(function(e){
        $.get(url+"api/konten_desa/"+id_desa+"/kabar_desa", function(data){
            judul.html('Kabar Desa');
            konten.html(data);
        });
    });

    //profil_desa
    $("#profil_desa").click(function(e){
        $.get(url+"api/konten_desa/"+id_desa+"/profil_desa", function(data){
            judul.html('Profil Desa');
            konten.html(data);
        });
    });

    //profil_desa
    $("#dokumen_desa").click(function(e){
        $.get(url+"api/konten_desa/"+id_desa+"/dokumen_desa", function(data){
            judul.html('Dokumen Desa');
            konten.html(data);
        });
    });

    //proyek_desa
    $("#proyek_desa").click(function(e){
        $.get(url+"api/konten_desa/"+id_desa+"/proyek_desa", function(data){
            judul.html('Proyek Desa');
            konten.html(data);
        });
    });
</script>

@endsection