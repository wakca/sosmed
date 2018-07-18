@if($data)
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
                <center><h3>Tidak ada Dokumen, Silahkan Upload</h3></center>
            </td>
        </tr>
        @endforelse
        
    </tbody>
</table>
@else
<p>Dokumen Ada</p>
@endif