@extends('layouts.app_desa')
@section('title')
    Kanal Desa
@endsection
@section('content')
<div class="container">
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
                            <div class="container">
        
                                <h2>
                                    Desa {{ $desa->nama }}<br/>
                                    <small>Kode Desa : {{ $desa->id }}</small><br/>
                                    <small>Kecamatan {{ $desa->kecamatan->nama }}</small><br/>
                                    <small>{{ $desa->kecamatan->kab->nama }}</small><br/>
                                    <small>Provinsi : {{ $desa->kecamatan->kab->prov->nama }}</small>
                                </h2>
                                
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
@endsection