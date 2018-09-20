@extends('desa.template')
@section('title')
    Proyek Desa/Kelurahan {{ $desa->nama }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-header">
                    <i class="fa fa-info-circle"></i>&nbsp;&nbsp;&nbsp;INFO DESA/KELURAHAN
                </div>
                <div class="card-body">
                    <center><img src="{{$desa->foto_kades ? url('/storage/'.$desa->foto_kades) : url('/img/kades.png')}}" class="img img-responsive img-thumbnail"  alt="Foto Kepala Desa {{$desa->nama}}"></center>
                    <h5 class="card-title">{{$desa->nama_kades}}</h5>

                    <a href="{{route('profil_desa.proyek', [$desa->id])}}" class="btn btn-primary">Kembali Ke Proyek</a>
                </div>
                <div class="card-footer text-muted">
                    {{$proyek->created_at ? $proyek->created_at->diffForHumans() : ''}}
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <article class="post post-large blog-single-post">


                <div class="post-date">
                    <span class="day">{{$proyek->created_at ? $proyek->created_at->format('d') : ''}}</span>
                    <span class="month">{{$proyek->created_at ? $proyek->created_at->format('M') : ''}}</span>
                </div>

                <div class="post-content">

                    <h2><a href="#">{{$proyek->judul}}</a></h2>

                    <div class="post-meta">
                        <span><i class="fa fa-user"></i>  <a href="#">{{$desa->nama}}</a> </span>
                        <span><i class="fa fa-calendar"></i> Tahun {{$proyek->tahun}} </span>
                    </div>

                    {!! $proyek->konten !!}

                </div>
            </article>
        </div>
    </div>
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