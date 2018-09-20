@extends('desa.template')
@section('title')
Produk di Desa {{ $desa->nama }}
@endsection

@section('content')
<h2>Produk Unggulan di Desa {{ $desa->nama }}</h2>
<div class="masonry-loader masonry-loader-loaded">
    <div class="row">

        @forelse($produk as $product)
        <div class="col-12 col-sm-6 col-lg-4 product">
            <span class="product-thumb-info">
                <a href="{{ route('desa.produk.detail', $product->id) }}">
                    <span class="product-thumb-info-image">
                        <span class="product-thumb-info-act">
                            <span class="product-thumb-info-act-left"><em>View</em></span>
                            <span class="product-thumb-info-act-right"><em><i class="fas fa-plus"></i> Details</em></span>
                        </span>
                        <img alt="" class="img-fluid" src="{{ Getter::getOnlyImgUrl($product->konten, $product->nama) }}" style="height: 200px">
                    </span>
                </a>
                <span class="product-thumb-info-content">
                    <center>

                        <a href="{{ route('desa.produk.detail', $product->id) }}">
                            <h4>{{ $product->nama }}</h4>
                        </a>
                        <a href="/{{ $product->user->username }}" class="btn btn-xs btn-primary">Oleh : {{ '@'.$product->user->username }}</a>
                    </center>
                </span>
            </span>
            <br><hr>
        </div>
        @empty
        <div class="col-md-12" style="width: 100%">

            <div class="alert alert-default">
                Belum ada Produk Unggulan pada Desa {{ $desa->nama }}<br/>
                <a href="/register" class="btn btn-success">Bergabunglah segera dengan Klipaa.com</a>
            </div>
        </div>
        @endforelse
        
    </div>
    {{ $produk->links('vendor.pagination.bootstrap-4') }}
<div class="bounce-loader"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div></div>
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