@extends('layouts.admin')
@section('title','Dokumen Desa')
@section('content')

<div class="row">
    <div class="col-md-6">
        
        <div class="card ">
            <div class="header">
                <h4 class="title">Produk Unggulan</h4>
            </div>
            <div class="content">
                
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
                        @forelse($data as $produk)
                        <tr id="data-{{ $produk->id }}">
                            <td>{{ $no++ }}</td>
                            <td>{{ $produk->judul }}</td>
                            <td>{{ $produk->keterangan }}</td>
                            <td>{{ $produk->tahun }}</td>
                            <td>
                                <a href="" class="btn btn-xs btn-info">Detail</a>
                                <a href="" class="btn btn-xs btn-warning">Edit</a>
                                <button onclick="deletedokumen({{ $produk->id }})" class="btn btn-xs btn-danger">Delete</button>
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
                        <label for="link">Nama Dokumen</label>
                        <input type="text" class="form-control" name="judul" required>
                    </div>
                    <div class="form-group">
                        <label for="link">Keterangan</label>
                        <input type="text" class="form-control" name="keterangan" required>
                    </div>
                    <div class="form-group">
                        <label for="link">Tahun</label>
                        <input type="integer" class="form-control" name="tahun" required>
                    </div>
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

@section('modal')
<!-- Hapus Story -->
<div class="modal fade" id='modal-delete-dokumen' tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <span class='glyphicon glyphicon-exclamation-sign'></span> Hapus Dokumen</h4>
            </div>
            <div class="modal-body">
                <p>Anda yakin ingin menghapus Dokumen ini ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" id='btn-delete-dokumen' class="btn btn-sm  btn-danger">
                    <span class='glyphicon glyphicon-trash'></span> Hapus</button>
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection


@section('js')
<script src="https://cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>

<script>
    CKEDITOR.replace( 'konten' );
</script>

<script>
    function deletedokumen(id) {
        var dokumen_id = id;
        $("#modal-delete-dokumen").modal('show');
        $('#modal-delete-dokumen').on('hidden.bs.modal', function(){
            dokumen_id = 0;
        });
        $("#btn-delete-dokumen").click(function(){
            if (dokumen_id != 0) {
                $.ajax({
                    url:'/admin_desa/konten_desa/dokumen_desa/delete/'+dokumen_id,
                    type:'GET',
                    success:function(data){
                        $("#modal-delete-dokumen").modal('hide');
                        if (data.status == 'success') {
                            $("#data-"+dokumen_id).remove();
                        }
                        else{
                            window.alert('Gagal Menghapus data !');
                        }
                    }
                });
            }
        });
    }
</script>
@endsection