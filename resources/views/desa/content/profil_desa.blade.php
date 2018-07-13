<table class="table">
    <tr>
        <td>Kepala Desa</td>
        <td>:</td>
        <td><strong>Belum Ada</strong></td>
    </tr>
    <tr>
        <td>Kecamatan</td>
        <td>:</td>
        <td><strong>{{ $desa->kecamatan->nama }}</strong> ({{ $desa->kecamatan->id }})</td>
    </tr>
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

<h3>Profil Desa</h3>
<hr>
@if($data)
{!! $data !!}
@else
<p>Profil Belum Ada</p>
@endif