@extends('desa.template')
@section('title')
Desa {{ $desa->nama }}
@endsection

@section('content')
        <img src="{{$desa ? $desa->foto_desa ? url('/storage/'.$desa->foto_desa) : url('/img/banner.png') : ''}}" class="img img-responsive img-thumbnail" width="100%"  alt="img">

        <hr>
<div class="row">

    <div class="col-sm-12 col-xs-12">

        <h1>Selamat Datang di Desa {{ $desa->nama }}</h1>

        <!-- Berita -->
        <div class="row">
            <div class="col-md-8">
                <table class="table">
                    <tr>
                        <td>Kepala Desa</td>
                        <td>:</td>
                        <td><strong>{{$desa ? $desa->nama_kades ? $desa->nama_kades : 'Belum di Set' : 'Belum di Set'}}</strong></td>
                    </tr>
                    <tr>
                        <td>Kecamatan</td>
                        <td>:</td>
                        <td><strong>{{ $desa->kecamatan->nama }}</strong> ({{ $desa->kecamatan->id }})</td>
                    </tr>
                    @if($desa->link_web)
                        <tr>
                            <td>Web Kecamatan</td>
                            <td>:</td>
                            <td><a href="{{$desa->link_web}}">{{$desa->link_web}}</a></td>
                        </tr>
                    @endif

                    <tr>
                        <td>Kota/Kabupaten</td>
                        <td>:</td>
                        <td><strong>{{ $desa->kecamatan->kab->nama }}</strong> ({{ $desa->kecamatan->kab->id }})</td>
                    </tr>
                    <tr>
                        <td>Provinsi</td>
                        <td>:</td>
                        <td><strong>{{ $desa->kecamatan->kab->prov->nama }}</strong> ({{ $desa->kecamatan->kab->prov->id }})</td>
                    </tr>
                    <tr>
                        <td>Admin Desa</td>
                        <td>:</td>
                        <td>
                            @if($desa->pengurus)
                                {{ $desa->pengurus->name }} / {{ "@".$desa->pengurus->username }}
                            @else
                                Belum ada Pengurus
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Jumlah User Terdaftar</td>
                        <td>:</td>
                        <td>
                            @if($desa->user)
                            {{ $desa->user->count() }} user
                            @else
                            Belum ada User
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-4 col-xs-12">
                <center><img src="{{$desa->foto_kades ? url('/storage/'.$desa->foto_kades): url('/img/kades.png')}}" class="img img-thumbnail" alt="img"></center>
            </div>


        </div>
        <hr>
        <!-- /Berita -->
        <section class="section mt-0 section-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2>Story <strong> Warga</strong></h2>
                    </div>
                </div>
                <div class="row mt-4">
                    @forelse($desa->stories()->limit(4)->get() as $story)
                        <div class="col-lg-3">
                            {!! Getter::getImageThumbProfil($story->content,$story->title) !!}
                            {{--<img class="img-fluid" src="img/blog/blog-vintage-1.jpg" alt="Blog">--}}
                            <div class="recent-posts mt-3 mb-4">
                                <article class="post">
                                    <h5><a class="text-dark" href="{{ route('story.view', $story->slug) }}">{{$story->title}}</a></h5>
                                    <p>
                                        {{--@php $konten =  substr($story->content,0, 500) @endphp--}}
                                        {{--@php $konten =  preg_replace('#<img[^>]*>#i','', $konten) @endphp--}}
                                        {{--@php--}}
                                            {{--//$pattern = "/<p[^>]*><\\/p[^>]*>/";--}}
                                            {{--$pattern = "/<[^\/>]*>([\s]?)*<\/[^>]*>/";--}}
                                        {{--@endphp--}}
                                        {{--{!! preg_replace($pattern, '', $konten) !!}--}}
                                        {{strlen(strip_tags($story->content)) > 100 ? str_limit(strip_tags($story->content),100)."...":strip_tags($story->content)}}
                                    </p>
                                    <div class="post-meta">
                                        <span><i class="fa fa-calendar"></i> {{$story->created_at->format('d-m-Y')}} </span>
                                        <span><i class="fa fa-user"></i> By <a href="#">{{$story->user->name}}</a> </span>
                                        <span><i class="fa fa-tag"></i>
                                            @foreach($story->tags as $tag)
                                                <a class='label label-default' href='{{ route('story.tag',['tag' => $tag->name]) }}'>{{ ucfirst($tag->name) }}</a>
                                            @endforeach
                                        </span>
                                        <span><i class="fa fa-comments"></i> <a href="{{url('/story/'.$story->slug.'#comments')}}">{{$story->comment()->count()}} Comments</a></span>
                                    </div>
                                </article>
                            </div>
                        </div>
                    @empty

                        <div class="col-md-6">
                            <div class="alert alert-default">
                                Belum ada Story pada Desa {{ $desa->nama }}<br/>
                                <a href="/register" class="btn btn-success">Bergabunglah segera dengan Klipaa.com</a>
                            </div>
                        </div>
                    @endforelse

                </div>
            </div>
        </section>
        <br />
        <br />
        <br />
        <br />


    </div>


</div>






@endsection

@section('scripts')
    <script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=599bc3c3a3155100110e7200&product=sticky-share-buttons"></script>



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