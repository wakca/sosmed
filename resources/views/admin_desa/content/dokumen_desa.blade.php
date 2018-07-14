@extends('layouts.admin')
@section('title','Dokumen Desa')
@section('content')

<div class="row">
    <div class="col-md-6">
        
        <div class="card ">
            <div class="header">
                <h4 class="title">Data Dokumen</h4>
            </div>
            <div class="content">
                
                <table class="table table-hover table-striped table-condensed">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Dokumen</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1 @endphp
                        @forelse($data as $doc)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $doc->judul }}</td>
                            <td>
                                <a href="" class="btn btn-xs btn-info">Detail</a>
                                <a href="" class="btn btn-xs btn-warning">Edit</a>
                                <a href="" class="btn btn-xs btn-danger">Delete</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3">
                                <center><h3>Tidak ada Dokumen, Silahkan Upload</h3></center>
                            </td>
                        </tr>
                        @endforelse
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card ">
            <div class="header">
                <h4 class="title">Upload Dokumen Desa</h4>
            </div>
            <div class="content">
                <form action="{{ route('admin_desa.content.dokumen_desa.save') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="link">Upload Dokumen</label>
                        <input type="file" class="form-control" name="link" required>
                    </div>
                    <div class="clearfix">
                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




@endsection

@section('js')
<script src="https://cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>

<script>
    CKEDITOR.replace( 'konten' );
</script>
@endsection