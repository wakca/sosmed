@extends('layouts.admin')
@section('title','Dashboard Admin Desa')
@section('content')
    <div class="row">
        

        <div class="col-md-6">
            <div class="row">
                
                <div class="col-md-12">
                    <div class="card ">
                        <div class="header">
                            <h4 class="title">Data Desa</h4>
                            <p class="category">Desa {{ $desa->nama }}</p>
                        </div>
                        <div class="content table-responsive table-full-width">
                            <table class="table">
                                <tr>
                                    <td>Kode Desa</td>
                                    <td>:</td>
                                    <td>{{ $desa->id }}</td>
                                </tr>
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
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card ">
                <div class="header">
                    <h4 class="title">Peta Desa</h4>
                    <p class="category">Desa {{ $desa->nama }}</p>
                </div>
                <div class="content" style="margin: 0px">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63327.62557958381!2d107.92223339384515!3d-7.243502211376229!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68b20093628bcd%3A0xbf2c59113f94d3aa!2sGodog%2C+Karangpawitan%2C+Garut+Regency%2C+West+Java!5e0!3m2!1sen!2sid!4v1531465472774" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection