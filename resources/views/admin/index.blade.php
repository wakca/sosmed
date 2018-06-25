@extends('layouts.admin')
@section('title','Dashboard')
@section('menu')
    <ul class="nav">
        <li class='active'>
            <a href="{{ route('admin.dashboard') }}">
                <i class="pe-7s-graph"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.user') }}">
                <i class="pe-7s-users"></i>
                <p>Users</p>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.story') }}">
                <i class="pe-7s-news-paper"></i>
                <p>Story</p>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.tag') }}">
                <i class="pe-7s-ticket"></i>
                <p>Tag</p>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.post') }}">
                <i class="pe-7s-pen"></i>
                <p>Post</p>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.comment') }}">
                <i class="pe-7s-comment"></i>
                <p>Comment</p>
            </a>
        </li>
    </ul>
@endsection
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