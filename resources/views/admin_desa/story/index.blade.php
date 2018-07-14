<div class="card ">
    <div class="header">
        <h4 class="title">List Story</h4>
    </div>
    <div class='content'>
        <table class="table table-bordered" id="users-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Content</th>
                <th>Tags</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
    </div>
</div>
@section('modal')
<!-- Hapus Story -->
<div class="modal fade" id='modal-delete-story' tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><span class='glyphicon glyphicon-exclamation-sign'></span> Hapus Cerita</h4>
      </div>
      <div class="modal-body">
        <p>Anda yakin ingin menghapus cerita ini ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" id='btn-delete-story' class="btn btn-sm  btn-danger"><span class='glyphicon glyphicon-trash'></span> Hapus</button>
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
        ajax: '{!! route('admin_desa.story.data') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'title', name: 'title' },
            { data: 'content', name: 'content' },
            { data: 'tagname', name: 'tags.name', orderable: false },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action', orderable: false, searchable:false }
        ]
    });
});
function deleteStory(id) {
    var story_id = id;
    $("#modal-delete-story").modal('show');
    $('#modal-delete-story').on('hidden.bs.modal', function(){
        story_id = 0;
    });
    $("#btn-delete-story").click(function(){
        if (story_id != 0) {
            $.ajax({
                url:'story/'+story_id+'/delete',
                type:'GET',
                success:function(data){
                    $("#modal-delete-story").modal('hide');
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