@extends('layouts.app')
@section('title')
    Kanal Desa
@endsection
@section('content')
<div class="container">
    <h2>Pencarian Desa</h2>
    <div class="input-group">
        <input type="text" name="search" id="search" placeholder="Cari Desa Berdasarkan Nama Desa atau Kode Desa" class="form-control">
        <span class="input-group-btn">
            <button type="submit" class="btn btn-primary" id="submit" onclick="submit()">
                <span class="glyphicon glyphicon-search"></span>
                Cari
            </button>
        </span>
    </div>


    {{-- <input type="text" class="form-control" onkeyup="suggest(this.value);" id="search" name="search" placeholder="Cari Desa Berdasarkan Nama Desa atau Kode Desa"> --}}
    <br>
    <div id="suggest"></div>
    @if($desa != null)
    <div class='row'>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class='panel panel-default profile-card margin-bottom'>
                        <div class='panel-heading'>
                            <div class="media">
                                <div class="media-body">
                                    Desa Anda
                                </div>
                            </div>
                        </div>
                        <div class='panel-body'>
                            
                            <div class="table-responsive">
                                <table class="table table-condensed">
                                    <tr>
                                        <td>Nama Desa</td>
                                        <td>:</td>
                                        <td>{{ $desa->nama }} ({{ $desa->id }})</td>
                                    </tr>
                                    <tr>
                                        <td>Kecamatan</td>
                                        <td>:</td>
                                        <td>{{ $desa->kecamatan->nama }} ({{ $desa->kecamatan->id }})</td>
                                    </tr>
                                    <tr>
                                        <td>Kota/Kabupaten</td>
                                        <td>:</td>
                                        <td>{{ $desa->kecamatan->kab->nama }} ({{ $desa->kecamatan->kab->id }})</td>
                                    </tr>
                                    <tr>
                                        <td>Provinsi</td>
                                        <td>:</td>
                                        <td>{{ $desa->kecamatan->kab->prov->nama }} ({{ $desa->kecamatan->kab->prov->id }})</td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah Produk Desa</td>
                                        <td>:</td>
                                        <td>{{ count($desa->produk_unggulan) }} produk  <a href="{{ route('profil_desa.produk', $desa->id) }}">Lihat semua</a></td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah Story Desa</td>
                                        <td>:</td>
                                        <td>{{ count($desa->stories) }} story <a href="{{ route('profil_desa.story', $desa->id) }}">Lihat semua</a></td>
                                    </tr>
                                </table>
                            </div>

                            <div class="clearfix">
                                    <a href="{{ route('profil_desa.beranda', $desa->id) }}" class="btn btn-block btn-info">Buka Halaman Desa {{ $desa->nama }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="col-md-6">
            <div class='panel panel-default profile-card margin-bottom'>
                <div class='panel-heading'>
                    <div class="media">
                        <div class="media-body" id="title">
                            Menu Desa
                        </div>
                    </div>
                </div>
                <div class='panel-body'>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <center>
                                                <div class="huge"><h3>{{ count(Auth::user()->produk_unggulan) }}</h3></div>
                                                <div>Produk Anda</div>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('desa.produk', $desa->id) }}">
                                    <div class="panel-footer">
                                        <center>Manajemen Produk</center>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <center>
                                                <div class="huge"><h3>{{ count(Auth::user()->story) }}</h3></div>
                                                <div>Story Anda</div>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                                <a href="/story">
                                    <div class="panel-footer">
                                        <center>Manajemen Story</center>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <h2>Produk Unggulan Terbaru</h2>
            @foreach($produk as $list_produk)
                <div class='panel story panel-default'>
                    <div class='panel-heading'><img height='25' class='img-rounded' src='{{ asset('photos/'.(isset($list_produk->user->photo) ? $list_produk->user->photo : 'av-default.jpg')) }}'/> <strong><a href='{{ $list_produk->user->username }}'>{{ $list_produk->user->name }}</a></strong> <span class='pull-right'>{{ Date::parse($list_produk->created_at)->ago() }} &bull; <i class='glyphicon glyphicon-comment'></i> <strong>{{ count($list_produk->comment) }}</strong></span></div>
                    <div class='panel-body'>
                        {!! Getter::getStoryThumb($list_produk->konten,$list_produk->nama) !!}
                        <br>
                        <div class="btn-group">
                            <a href="{{ route('profil_desa.beranda', $list_produk->des->id) }}" class="btn btn-xs btn-primary">Desa {{ $list_produk->des->nama }}</a>
                            <a href="/{{ '@'.$list_produk->user->username }}" class="btn btn-xs btn-info">{{ '@'.$list_produk->user->username }}</a>
                        </div>
                        <br>
                        <div class="caption">
                            <h4><a href='{{ route('story.view',['slug' => $list_produk->slug]) }}'>{{ $list_produk->nama }}</a></h4>
                            <p>{{ strlen(strip_tags($list_produk->konten)) > 100 ? str_limit(strip_tags($list_produk->konten),100)."...":strip_tags($list_produk->konten) }}</p>
                        </div>
                    </div>
                </div>
                <br>
            @endforeach
        </div>
        <div class="col-md-6">
            <h2>Story Desa Terbaru</h2>
             @foreach($stories as $story)
                <div class='panel story panel-default'>
                    <div class='panel-heading'><img height='25' class='img-rounded' src='{{ asset('photos/'.(isset($story->user->photo) ? $story->user->photo : 'av-default.jpg')) }}'/> <strong><a href='{{ $story->user->username }}'>{{ $story->user->name }}</a></strong> <span class='pull-right'>{{ Date::parse($story->created_at)->ago() }} &bull; <i class='glyphicon glyphicon-comment'></i> <strong>{{ count($story->comment) }}</strong></span></div>
                    <div class='panel-body'>
                        {!! Getter::getStoryThumb($story->content,$story->title) !!}
                        <br>
                        <div class="btn-group">
                            <a href="{{ route('profil_desa.beranda', $story->des->id) }}" class="btn btn-xs btn-primary">Desa {{ $story->des->nama }}</a>
                            <a href="/{{ '@'.$story->user->username }}" class="btn btn-xs btn-info">{{ '@'.$story->user->username }}</a>
                        </div>
                        <br>
                        <div class="caption">
                            <h4><a href='{{ route('story.view',['slug' => $story->slug]) }}'>{{ $story->title }}</a></h4>
                            <p>{{ strlen(strip_tags($story->content)) > 100 ? str_limit(strip_tags($story->content),100)."...":strip_tags($story->content) }}</p>
                        </div>
                    </div>
                </div>
                <br>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('script')

@if(Auth::check())
<script>

    var id_desa = "{{ $desa->id }}";
    var user_id = "{{ Auth::user()->id }}";

    var title = $("#title");
    var content = $("#content");

    $("#produk_unggulan").click(function(e){
        $.get("/api/produk_unggulan_by_user/"+user_id, function(data){
            title.html('Produk Anda');
            content.html(data);
        });
    });
</script>
@endif

<script>

    $('#search').keydown(function(event) {
        // enter has keyCode = 13, change it if you want to use another button
        if (event.keyCode == 13) {
            submit();
            return false;
        }
    });

    function submit()
    {
        var src = $("#search").val();

        if(src.length == 0){
            $('#suggest').empty();
        } else {

            $.ajax({
                type: "GET",
                url: "/api/search_desa/"+src,
                data: {
                    "src": src,
                },
                cache: true,
                success: function (data) {
                    console.log(src);
                    console.log(data);
                    $('#suggest').empty();
                    $('#suggest').html(data);
                }

            });
        }
    }

    function suggest(src) {
        var page = 'suggest.php';
        if (src.length >= 4) {
            var loading = '<p align="center">Loading ...</p>';

            $('#suggest').html(loading);

            $.ajax({
                type: "GET",
                url: "/api/search_desa/"+src,
                data: {
                    "src": src,
                },
                cache: true,
                success: function (data) {
                    console.log(src);
                    console.log(data);
                    $('#suggest').empty();
                    $('#suggest').html(data);
                }

            });

        } else if(src.length == 0){
            $('#suggest').empty();
        }
        return false;
    }

    //Fungsi untuk memilih kota dan memasukkannya pada input text


    //menyembunyikan form
    function hideStuff(id) {
        document.getElementById(id).style.display = 'none';
    }
</script>
@endsection

@section('css')
<style>
    #data-desa {
        overflow-y: scroll;
        max-height: 200px;
    }
</style>
@endsection