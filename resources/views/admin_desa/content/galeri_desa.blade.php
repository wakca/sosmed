@extends('layouts.admin')
@section('title','galeri Desa')
@section('content')

<div class="row">
    <div class="col-md-7">
        
        <div class="card ">
            <div class="header">
                <h4 class="title">Data Galeri</h4>
            </div>
            <div class="content">
                
                <table class="table table-hover table-striped table-condensed">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Preview</th>
                            <th>Nama Galeri</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1 @endphp
                        @forelse($data as $doc)
                        <tr id="data-{{ $doc->id }}">
                            <td>{{ $no++ }}</td>
                            <th>
                                <img src="{{ asset($doc->link) }}" alt="" style="max-width: 120px">
                            </th>
                            <td>{{ $doc->judul }}</td>
                            <td>{{ $doc->keterangan }}</td>
                            <td>
                                <a href="" class="btn btn-xs btn-info"><i class="fa fa-lg fa-eye"></i></a>
                                <button onclick="edit_galeri({{ $doc->id }})" class="btn btn-xs btn-warning"><i class="fa fa-lg fa-pencil"></i></button>
                                <button onclick="delete_galeri({{ $doc->id }})" class="btn btn-xs btn-danger"><i class="fa fa-lg fa-trash"></i></button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                <center><h3>Tidak ada Galeri, Silahkan Upload</h3></center>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card ">
            <div class="header">
                <h4 class="title">Upload Galeri Desa</h4>
            </div>
            <div class="content">
                <form action="{{ route('admin_desa.content.galeri_desa.save') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="link">Nama Galeri</label>
                        <input type="text" class="form-control" name="judul" required>
                    </div>
                    <div class="form-group">
                        <label for="link">Keterangan</label>
                        <input type="text" class="form-control" name="keterangan" required>
                    </div>
                    <div class="form-group">
                        <label for="link">Pilih Gambar</label>
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
<!-- Delete Galeri -->
<div class="modal fade" id='modal-delete-galeri' tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <span class='glyphicon glyphicon-exclamation-sign'></span> Hapus Galeri</h4>
            </div>
            <div class="modal-body">
                <p>Anda yakin ingin menghapus Galeri ini ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" id='btn-delete-galeri' class="btn btn-sm  btn-danger">
                    <span class='glyphicon glyphicon-trash'></span> Hapus</button>
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Edit Galeri -->
<div class="modal fade" id='modal-edit-galeri' tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="title-edit">
                    <span class='glyphicon glyphicon-exclamation-sign'></span> Edit Galeri
                </h4>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="link">Nama Galeri</label>
                        <input type="text" class="form-control" name="judul" id="judul" required>
                    </div>
                    <div class="form-group">
                        <label for="link">Keterangan</label>
                        <input type="text" class="form-control" name="keterangan" id="keterangan" required>
                    </div>
                    <div class="form-group">
                        <label for="link">Tahun</label>
                        <input type="integer" class="form-control" name="tahun" id="tahun" required>
                    </div>
                    <div class="form-group">
                        <label for="link">Upload Galeri</label>
                        <input type="file" class="form-control" name="link" id="file" required>
                    </div>
                    <div class="clearfix">
                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
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
    function delete_galeri(id) {
        var galeri_id = id;
        $("#modal-delete-galeri").modal('show');
        $('#modal-delete-galeri').on('hidden.bs.modal', function(){
            galeri_id = 0;
        });
        $("#btn-delete-galeri").click(function(){
            if (galeri_id != 0) {
                $.ajax({
                    url:'/admin_desa/konten_desa/galeri/delete/'+galeri_id,
                    type:'GET',
                    success:function(data){
                        $("#modal-delete-galeri").modal('hide');
                        if (data.status == 'success') {
                            $("#data-"+galeri_id).remove();
                            window.alert("Berhasil menghapus Galeri");
                        }
                        else{
                            window.alert('Gagal Menghapus data !');
                        }
                    }
                });
            }
        });
    }

    function edit_galeri(id) {
        var galeri_id = id;

        $.get('/admin_desa/konten_desa/galeri_desa/data/'+id, function(data){ 
            $('#judul').val(data['judul']);
            $('#keterangan').val(data['keterangan']);
            $('#tahun').val(data['tahun']);

            $("#title-edit").html('Edit Galeri ' + data['judul']);
        });


        $("#modal-edit-galeri").modal('show');
        $('#modal-edit-galeri').on('hidden.bs.modal', function(){
            galeri_id = 0;
        });
    }
</script>
@endsection