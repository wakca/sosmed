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