@extends('desa.layout')
@section('title')
Desa {{ $desa->nama }}
@endsection

@section('content')
<h2>
    Profil Desa {{ $desa->nama }}
</h2>

<div class="panel panel-primary">
    <div class="panel-heading"><strong>Desa {{ $desa->nama }}</strong> - Kode Desa : {{ $desa->id }}</div>
    <div class="panel-body">
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
                <td>{{ $desa->pengurus->nama }} user</td>
            </tr>
            <tr>
                <td>Jumlah User Terdaftar</td>
                <td>:</td>
                <td>{{ $desa->user->count() }} user</td>
            </tr>
        </table>
    </div>
</div>
<br>
@endsection