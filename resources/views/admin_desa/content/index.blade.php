@extends('layouts.admin')
@section('title','Dashboard Admin Desa')
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
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1 @endphp
                            @foreach($konten as $list)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $list['judul'] }}</td>
                                <td>
                                    @if(!$list['data'])
                                        <label for="" class="label label-danger" style="color:white">Data Belum Terisi</label>
                                    @else
                                        <label for="" class="label label-success" style="color:white">Data Sudah Terisi</label>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin_desa.content.edit', $list['slug']) }}" class="btn btn-xs btn-info">Preview</a>
                                    <a href="{{ route('admin_desa.content.edit', $list['slug']) }}" class="btn btn-xs btn-primary">Edit</a>
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