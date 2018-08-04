@extends('desa.template')
@section('title')
Desa {{ $desa->nama }}
@endsection

@section('content')
<div class="row">

    <div class="col-sm-12">

        <h1>Selamat Datang di Desa {{ $desa->nama }}</h1>

        <!-- Berita -->
        <div class="row">
            <div class="col-md-12">
                <div class="blog-posts">

                    @forelse($desa->stories as $story)
                         
                        <article class="post post-large">

                            <div class="post-content">

                                <div class="row">
                                    <div class="col-md-4">
                                        <br>
                                        <div class="post-image">
                                            {!! Getter::getImageThumb($story->content,$story->title) !!}
                                            {{-- <img class="responsive rounded" src="{{ asset($story->gambar) }}" style="width: 100%" alt="{{ $story->title }}"> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="post-date">
                                            <span class="day">{{ $story->created_at->format('d') }}</span>
                                            <span class="month">{{ $story->created_at->format('M') }}</span>
                                        </div>
                                        <h2>
                                            <a href="{{ route('story.view', $story->slug) }}">{{ $story->title }}</a>
                                        </h2>
                                        @php $konten =  substr($story->content,0, 500) @endphp
                                        {!! preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\/?)>/i",'<$1$2>', $konten) !!}
                                        <div class="post-meta">
                                            {{-- <span><i class="fa fa-user"></i> By <a href="{{ route('berita.by_user', $story->user->username) }}">{{ $story->user->name }}</a> </span> --}}
                                            {{-- <span><i class="fa fa-tag"></i> <a href="{{ route('berita.by_kategori', $story->kategori->slug) }}">{{ $story->kategori->name }}</a> </span> --}}
                                            <span><i class="fa fa-comments"></i> <a href="#">{{ count($story->comment) }} komentar</a></span>
                                            {{-- <span class="d-block d-sm-inline-block float-sm-right mt-3 mt-sm-0"><a href="{{ route('berita.read', $story->slug) }}" class="btn btn-xs btn-primary">Read more...</a></span> --}}
                                            <br/>Tags : 
                                            @foreach($story->tags as $tag)
                                            <a class='label label-default' href='{{ route('story.tag',['tag' => $tag->name]) }}'>{{ ucfirst($tag->name) }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </article>

                    @empty
                        <center>
                            <h3>Tidak Ada Berita</h3>
                        </center>
                    @endforelse

                </div>
            </div>

        </div>
        <!-- /Berita -->

    </div>
    <div class="col-sm-3">
        @include('desa.sidebar')
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