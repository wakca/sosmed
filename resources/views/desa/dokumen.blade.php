@extends('desa.template')
@section('title')
Produk di Desa {{ $desa->nama }}
@endsection

@section('content')
<h2>Dokumen Desa {{ $desa->nama }}</h2>
<hr>
@if($data)
<div class="clearfix">
    <div class="pull-right">
        Filter Tahun
        <div class="btn-group">
            @for($i = date('Y')-2; $i <= date('Y'); $i++)
            <button class="btn btn-info btn-sm" id="tahun{{ $i }}" value="{{ $i }}">{{ $i }}</button>
            @endfor
            <button class="btn btn-success btn-sm" value="all">Semua</button>
        </div>

    </div>
</div>
<br>

<table class="table table-hover table-striped table-condensed">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Dokumen</th>
            <th>Keterangan</th>
            <th>Tahun</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1 @endphp
        @forelse($data as $doc)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $doc->judul }}</td>
            <td>{{ $doc->keterangan }}</td>
            <td>{{ $doc->tahun }}</td>
            <td>
                <a href="{{ route('open_dokumen', $doc->id) }}" class="btn btn-xs btn-info" target="_blank">Lihat</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5">
                <center><h3>Tidak ada Dokumen</h3></center>
            </td>
        </tr>
        @endforelse
        
    </tbody>
</table>


<script>
    $("button").click(function() {
        var tahun = $(this).val();

        if(tahun == "all")
        {
            console.log();
            $.get("/api/konten_desa/"+id_desa+"/dokumen_desa/", function(data){
                konten.html(data);
            });
        }
        else 
        {
            $.get("/api/konten_desa/"+id_desa+"/dokumen_desa_by_tahun/"+tahun, function(data){
                judul.html('Dokumen Desa Tahun ' + tahun);
                konten.html(data);
            });
        }
    });
</script>

@else
<p>Dokumen Ada</p>
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