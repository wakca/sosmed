@extends('layouts.admin')
@section('title','Profil Desa')
@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="card ">
                <div class="header">
                    <h4 class="title">
                        Data Organisasi Desa
                        <div class="pull-right">
                            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">Tambah Organisasi</button>
                        </div>
                    </h4>
                </div>
                <div class="content">

                    <table class="table table-hover table-striped table-condensed">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Organisasi</th>
                            <th>Waktu</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $no = 1 @endphp
                        @forelse($data as $doc)
                            <tr id="data-{{ $doc->id }}">
                                <td>{{ $no++ }}</td>
                                <td>{{ $doc->judul }}</td>
                                <td>{{ $doc->created_at ? $doc->created_at->diffForHumans() : '' }}</td>
                                <td>
                                    <button onclick="edit_organisasi({{ $doc->id }})" class="btn btn-xs btn-warning"><i class="fa fa-lg fa-pencil"></i></button>
                                    <button onclick="delete_organisasi({{ $doc->id }})" class="btn btn-xs btn-danger"><i class="fa fa-lg fa-trash"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <center><h3>Tidak ada Organisasi, Silahkan Upload</h3></center>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <center>
                        {{$data->links()}}
                    </center>
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
                    <h4 class="modal-title">Tambah Organisasi</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin_desa.content.organisasi_desa.save') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="link">Nama Organisasi</label>
                            <input type="text" class="form-control" name="judul" required>
                        </div>
                        <div class="form-group">
                            <label for="link">Keterangan</label>
                            <textarea name="konten" id="add-keterangan" cols="30" rows="10"></textarea>
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
    <!-- Delete Organisasi -->
    <div class="modal fade" id='modal-delete-organisasi' tabindex="-1" role="dialog">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">
                        <span class='glyphicon glyphicon-exclamation-sign'></span> Hapus Organisasi</h4>
                </div>
                <div class="modal-body">
                    <p>Anda yakin ingin menghapus Organisasi ini ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" id='btn-delete-organisasi' class="btn btn-sm  btn-danger">
                        <span class='glyphicon glyphicon-trash'></span> Hapus</button>
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog  modal-lg -->
    </div>
    <!-- /.modal -->

    <!-- Edit Organisasi -->
    <div class="modal fade" id='modal-edit-organisasi' tabindex="-1" role="dialog">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="title-edit">
                        <span class='glyphicon glyphicon-exclamation-sign'></span> Edit Organisasi
                    </h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin_desa.content.organisasi.update') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" id="id_organisasi" name="id_organisasi">
                        <div class="form-group">
                            <label for="link">Nama Organisasi</label>
                            <input type="text"  class="form-control" name="judul" id="edit-judul" required>
                        </div>
                        <div class="form-group">
                            <label for="link">Konten</label>
                            <textarea class="edit-keterangan" name="konten" id="edit-keterangan" cols="30" rows="10"></textarea>
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
        // $('#myModal').on('hide.bs.modal', function(){
        //     console.log('Hide modal');
        //     $(this)
        //         .find("input,textarea,select")
        //         .val('')
        //         .end();
        // });
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
        function delete_organisasi(id) {
            var organisasi_id = id;
            $("#modal-delete-organisasi").modal('show');
            $('#modal-delete-organisasi').on('hidden.bs.modal', function(){
                organisasi_id = 0;
            });
            $("#btn-delete-organisasi").click(function(){
                if (organisasi_id != 0) {
                    $.ajax({
                        url:'/admin_desa/konten_desa/organisasi/delete/'+organisasi_id,
                        type:'GET',
                        success:function(data){
                            $("#modal-delete-organisasi").modal('hide');
                            if (data.status == 'success') {
                                $("#data-"+organisasi_id).remove();
                                window.alert("Berhasil menghapus Organisasi");
                            }
                            else{
                                window.alert('Gagal Menghapus data !');
                            }
                        }
                    });
                }
            });
        }

        function edit_organisasi(id) {
            var organisasi_id = id;

            $.get('/admin_desa/konten_desa/organisasi/data/'+id, function(data){
                $('#edit-judul').val(data['judul']);
                $('#id_organisasi').val(data['id']);
                $('#edit-keterangan').summernote('code', data['konten']);
                // $("#edit-keterangan").summernote( {
                //     height: 200, toolbar: [ // [groupName, [list of button]]
                //         ['style', ['bold', 'italic', 'underline', 'clear']], ['insert', ['picture', 'video', 'link', 'table']], ['font', ['strikethrough', 'superscript', 'subscript']], ['fontsize', ['fontsize']], ['color', ['color']], ['para', ['ul', 'ol', 'paragraph']], ['height', ['height']], ['misc', ['fullscreen']], ],
                // }

                $("#title-edit").html('Edit Organisasi ' + data['judul']);
            });


            $("#modal-edit-organisasi").modal('show');
            $('#modal-edit-organisasi').on('hidden.bs.modal', function(){
                organisasi_id = 0;
            });
        }


    </script>
@endsection