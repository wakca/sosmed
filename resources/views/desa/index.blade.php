@extends('layouts.app_desa')
@section('title')
    Kanal Desa
@endsection
@section('content')
<div class="container">

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
                    <div class='panel panel-primary profile-card margin-bottom'>
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
                                        <td>Nama Desa</td>
                                        <td>:</td>
                                        <td>{{ $desa->nama }}</td>
                                    </tr>
                                </table>
                            </div>

                            <div class="clearfix">
                                    <a href="{{ route('profil_desa.beranda', $desa->id) }}" class="btn btn-block btn-info">Buka Halaman Desa {{ $desa->nama }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <ul class="list-group">
                        <li class="list-group-item"><a href="javascript:void(0);" id="produk_unggulan">Produk Desa</a></li>
                    </ul>
                </div>
            </div>
            
        </div>
        <div class="col-md-6">
            <div class='panel panel-default profile-card margin-bottom'>
                <div class='panel-heading'>
                    <div class="media">
                        <div class="media-body" id="title"></div>
                    </div>
                </div>
                <div class='panel-body'>
                    <div class="container">
                        <div id="content"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@section('script')
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

<script>

    function submit()
    {
        var src = $("#search").val();
        
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