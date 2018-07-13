<div class="card ">
    <div class="header">
        <h4 class="title">Pilih Kota/Kabupaten</h4>
    </div>
    <div class='content'>
        <table class="table table-bordered" id="pengurus-table">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Jumlah User</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
    </div>
</div>

@section('css')
<link rel='stylesheet' type='text/css' href="{{ asset('css/datatables.min.css') }}"/>
@endsection
@section('script')
<script src="{{ asset('js/datatables.min.js')}}"></script>
<script>
$('table').on('draw.dt', function() {
    $("#pengurus-table").wrap("<div class='table-responsive'></div>");
});
var table = "";
$(function() {
   table =  $('#pengurus-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/admin/pengurus/data_kabupaten/{{ $provinsi->id }}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'nama', name: 'nama' },
            { data: 'user', name: 'user', orderable: true },
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