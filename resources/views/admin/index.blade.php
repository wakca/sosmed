@extends('layouts.admin')
@section('title','Dashboard')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card ">
                <div class="header">
                    <h4 class="title">Daftar User</h4>
                    <p class="category">Berdasarkan Wilayah</p>
                </div>
                <div class="content table-responsive table-full-width">
                    <table class="table table-hover table-striped">
                        <thead>
                            <th>#</th>
                            <th>Provinsi</th>
                            <th>Jumlah User</th>
                        </thead>
                        <tbody>
                           @php
                           $no = 1;
                           @endphp
                           @foreach($data as $prov)
                               <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{ $prov->nama }}</td>
                                    <td>{{ count($prov->user) }}</td>
                               </tr>
                            @php
                            $no++
                            @endphp
                            @endforeach
                        </tbody>
                        <tfooter>
                            <tr>
                                <td>#</td>
                                <td>Total User</td>
                                <td>{{ $user }}</td>
                            </tr>
                        </tfooter>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection