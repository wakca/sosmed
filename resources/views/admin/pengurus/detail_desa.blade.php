@extends('layouts.admin')
@section('title','Detail Desa '.$desa->nama)
@section('content')
<div class="card ">
    <div class="header">
        <h4 class="title">Detail <strong>Desa {{ $desa->nama }}</strong> Kec. {{ $desa->kecamatan->nama }}</h4>
    </div>
    <div class='content'>
        <table class="table table-condensed">
            <tr>
                <td>Nama Desa</td>
                <td>:</td>
                <td>Desa {{ $desa->nama }}</td>
            </tr>
            <tr>
                <td>Kecamatan</td>
                <td>:</td>
                <td>Kecamatan {{ $desa->kecamatan->nama }}</td>
            </tr>
            <tr>
                <td>Kabupaten</td>
                <td>:</td>
                <td>{{ $desa->kecamatan->kab->nama }}</td>
            </tr>

            <tr>
                <td>Pengurus Desa</td>
                <td>:</td>
                <td>
                    <div id="pengurus">
                        @if($desa->admin_id)
                        {{ $desa->pengurus->name }} <span class="label label-success"><i class="fa fa-lg fa-check"></i></span>
                        @else
                        <span class="label label-danger">Belum Ada Pengurus</span>
                        @endif
                    </div>
                </td>
            </tr>
        </table>
        <hr>
        <h4 class="title">Daftar Penduduk<br/><small>Pilih Penduduk Yang Akan Dijadikan Pengurus</small></h4>

        <!-- Data Penduduk -->
        <table class="table table-bordered" id="users-table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
        <!-- /Data Penduduk -->

    </div>
</div>
@endsection

@section('modal')
<!-- Hapus Story -->
<div class="modal fade" id='modal-set-pengurus' tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><span class='glyphicon glyphicon-exclamation-sign'></span> Hapus User</h4>
      </div>
      <div class="modal-body">
        <p>Anda yakin ingin menjadikan user ini sebagai Pengurus <strong>Desa {{ $desa->nama }}</strong> ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" id='btn-set-pengurus' class="btn btn-sm  btn-success"><span class='glyphicon glyphicon-trash'></span> Ya</button>
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection


@section('css')
    <link href="{{ asset('css/summernote.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet">
@endsection
@section('js')
    <script src="{{ asset('js/summernote.min.js') }}"></script>
    <script src="{{ asset('bootstrap-select/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('bootstrap-select/js/i18n/defaults-id_ID.js') }}"></script>  


@endsection

@section('script')
<script src="{{ asset('js/datatables.min.js')}}"></script>
<script>
$('table').on('draw.dt', function() {
    $("#users-table").wrap("<div class='table-responsive'></div>");
});
var table = "";
$(function() {
    table =  $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/admin/pengurus/data_penduduk/{{ $desa->id }}',
        columns: [
            { data: 'username', name: 'username' },
            { data: 'name', name: 'name' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'action', name: 'action', orderable: false, searchable:false }
        ]
    });
});


function setPengurus(id) {
    console.log('asu' + id);
    var user_id = id;
    $("#modal-set-pengurus").modal('show');
    $('#modal-set-pengurus').on('hidden.bs.modal', function(){
        user_id = 0;
    });
    $("#btn-set-pengurus").click(function(){

        $.get( "/admin/pengurus/set_pengurus/"+user_id, function( data ) {
            table.ajax.reload();
            console.log(data.penduduk);
            var string = data.penduduk + " <span class='label label-success'><i class='fa fa-lg fa-check'></i></span>";
            $( "#pengurus" ).html( string );
            window.alert('Berhasil!');
            $("#modal-set-pengurus").modal('hide');
        });
    });
}
</script>
@endsection