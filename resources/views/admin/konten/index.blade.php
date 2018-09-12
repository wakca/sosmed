@extends('layouts.admin')
@section('title','Konten Klipaa')
@section('content')
    <div class="row">
        
        <div class="col-md-12">
            <div class="card ">
                <div class="header">
                    <h4 class="title">Konten Desa</h4>
                    <p class="category"></p>
                </div>
                <div class="content table-responsive table-full-width">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Konten</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1 @endphp
                            @foreach($data as $list)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $list->title }}</td>
                                <td>
                                    <a href="{{ route('admin.konten.edit', $list->slug) }}" class="btn btn-xs btn-primary">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection