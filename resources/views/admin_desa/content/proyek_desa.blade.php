@extends('layouts.admin')
@section('title','Proyek Desa')
@section('content')

<div class="row">
    <div class="col-md-12">
        
        <div class="card ">
            <div class="header">
                <h4 class="title">
                    Data Proyek
                    <div class="pull-right">
                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">Tambah Proyek</button>
                    </div>
                </h4>
            </div>
            <div class="content">
                
                <table class="table table-hover table-striped table-condensed">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Proyek</th>
                            <th>Tahun</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1 @endphp
                        @forelse($data as $doc)
                        <tr id="data-{{ $doc->id }}">
                            <td>{{ $no++ }}</td>
                            <td>{{ $doc->judul }}</td>
                            <td>{{ $doc->tahun }}</td>
                            <td>
                                <a href="" class="btn btn-xs btn-info"><i class="fa fa-lg fa-eye"></i></a>
                                <button onclick="edit_proyek({{ $doc->id }})" class="btn btn-xs btn-warning"><i class="fa fa-lg fa-pencil"></i></button>
                                <button onclick="delete_galeri({{ $doc->id }})" class="btn btn-xs btn-danger"><i class="fa fa-lg fa-trash"></i></button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">
                                <center><h3>Tidak ada Proyek, Silahkan Upload</h3></center>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog  modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambah Proyek</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin_desa.content.proyek_desa.save') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="link">Nama Proyek</label>
                        <input type="text" class="form-control" name="judul" required>
                    </div>
                    <div class="form-group">
                        <label for="link">Tahun</label>
                        <select name="tahun" id="tahun" class="form-control" required>
                            @for($i = 2012; $i <= date('Y'); $i++)
                            <option value="{{ $i }}" @if($i == date('Y')) selected  @endif >{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="link">Keterangan</label>
                        <textarea name="keterangan" id="add-keterangan" cols="30" rows="10"></textarea>
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
<!-- Delete Proyek -->
<div class="modal fade" id='modal-delete-proyek' tabindex="-1" role="dialog">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <span class='glyphicon glyphicon-exclamation-sign'></span> Hapus Proyek</h4>
            </div>
            <div class="modal-body">
                <p>Anda yakin ingin menghapus Proyek ini ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" id='btn-delete-proyek' class="btn btn-sm  btn-danger">
                    <span class='glyphicon glyphicon-trash'></span> Hapus</button>
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog  modal-lg -->
</div>
<!-- /.modal -->

<!-- Edit Proyek -->
<div class="modal fade" id='modal-edit-proyek' tabindex="-1" role="dialog">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="title-edit">
                    <span class='glyphicon glyphicon-exclamation-sign'></span> Edit Proyek
                </h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin_desa.content.proyek.update') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" id="id_proyek" name="id_proyek">
                    <div class="form-group">
                        <label for="link">Nama Proyek</label>
                        <input type="text" class="form-control" name="judul" id="edit-judul" required>
                    </div>
                    <div class="form-group">
                        <label for="link">Tahun</label>
                        <select name="tahun" id="edit-tahun" class="form-control" required>
                            @for($i = 2012; $i <= date('Y'); $i++)
                            <option value="{{ $i }}" @if($i == date('Y')) selected  @endif >{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="link">Keterangan</label>
                        <textarea class="edit-keterangan" name="keterangan" id="edit-keterangan" cols="30" rows="10"></textarea>
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
    <!-- /.modal-dialog  modal-lg -->
</div>
<!-- /.modal -->
@endsection



@section('js')

<script src="{{ asset('js/summernote.min.js') }}"></script>
<script>
$("#add-keterangan").summernote( {
    height: 200, toolbar: [ // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']], ['insert', ['picture', 'video', 'link', 'table']], ['font', ['strikethrough', 'superscript', 'subscript']], ['fontsize', ['fontsize']], ['color', ['color']], ['para', ['ul', 'ol', 'paragraph']], ['height', ['height']], ['misc', ['fullscreen']], ],
});

$("#edit-keterangan").summernote( {
    height: 200, toolbar: [ // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']], ['insert', ['picture', 'video', 'link', 'table']], ['font', ['strikethrough', 'superscript', 'subscript']], ['fontsize', ['fontsize']], ['color', ['color']], ['para', ['ul', 'ol', 'paragraph']], ['height', ['height']], ['misc', ['fullscreen']], ],
});

</script>

<script>
    function delete_galeri(id) {
        var proyek_id = id;
        $("#modal-delete-proyek").modal('show');
        $('#modal-delete-proyek').on('hidden.bs.modal', function(){
            proyek_id = 0;
        });
        $("#btn-delete-proyek").click(function(){
            if (proyek_id != 0) {
                $.ajax({
                    url:'/admin_desa/konten_desa/proyek/delete/'+proyek_id,
                    type:'GET',
                    success:function(data){
                        $("#modal-delete-proyek").modal('hide');
                        if (data.status == 'success') {
                            $("#data-"+proyek_id).remove();
                            window.alert("Berhasil menghapus Proyek");
                        }
                        else{
                            window.alert('Gagal Menghapus data !');
                        }
                    }
                });
            }
        });
    }

    function edit_proyek(id) {
        var proyek_id = id;

        $.get('/admin_desa/konten_desa/proyek/data/'+id, function(data){ 
            $('#edit-judul').val(data['judul']);
            $('#id_proyek').val(data['id']);
            $('#edit-tahun').val(data['tahun']);
            $('textarea#edit-keterangan').summernote('code', data['keterangan']);

            $("#title-edit").html('Edit Proyek ' + data['judul']);
        });


        $("#modal-edit-proyek").modal('show');
        $('#modal-edit-proyek').on('hidden.bs.modal', function(){
            proyek_id = 0;
        });
    }
</script>
@endsection