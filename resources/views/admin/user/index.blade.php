<div class="card ">
    <div class="header">
        <h4 class="title">List User</h4>
    </div>
    <div class='content'>
        <table class="table table-bordered" id="users-table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Desa</th>
                    <th>Post</th>
                    <th>Followers</th>
                    <th>Following</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@section('modal')
<!-- Hapus Story -->
<div class="modal fade" id='modal-delete-user' tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><span class='glyphicon glyphicon-exclamation-sign'></span> Hapus User</h4>
      </div>
      <div class="modal-body">
        <p>Anda yakin ingin menghapus user ini ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" id='btn-delete-user' class="btn btn-sm  btn-danger"><span class='glyphicon glyphicon-trash'></span> Hapus</button>
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
@section('css')
<link rel='stylesheet' type='text/css' href="{{ asset('css/datatables.min.css') }}"/>
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
        ajax: '{!! route('user.data') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'username', name: 'username' },
            { data: 'name', name: 'name' },
            { data: 'desa', name: 'desa' },
            { data: 'numposts', name: 'numposts' },
            { data: 'numfollowers', name: 'numfollowers' },
            { data: 'numfollowing', name: 'numfollowing' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'action', name: 'action', orderable: false, searchable:false }
        ]
    });
});
function deleteUser(id) {
    var user_id = id;
    $("#modal-delete-user").modal('show');
    $('#modal-delete-user').on('hidden.bs.modal', function(){
        user_id = 0;
    });
    $("#btn-delete-user").click(function(){
        if (user_id != 0) {
            $.ajax({
                url:'user/'+user_id+'/delete',
                type:'GET',
                success:function(data){
                    $("#modal-delete-user").modal('hide');
                    if (data.status == 'success') {
                        table.ajax.reload();
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