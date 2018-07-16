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


<!-- Unreport Story -->
<div class="modal fade" id='modal-unreport-story' tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><span class='glyphicon glyphicon-exclamation-sign'></span> Batalkan Report Story</h4>
        </div>
        <div class="modal-body">
          <p>Anda yakin ingin membatalkan report cerita ini ?</p>
        </div>
        <div class="modal-footer">
          <button type="button" id='btn-unreport-story' class="btn btn-sm  btn-warning"><span class='glyphicon glyphicon-exclamation-sign'></span> Proses</button>
          <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

<!-- Report Story -->
<div class="modal fade" id='modal-report-story' tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><span class='glyphicon glyphicon-exclamation-sign'></span> Report Story</h4>
      </div>
      <div class="modal-body">
        <p>Anda yakin ingin mereport cerita ini ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" id='btn-report-story' class="btn btn-sm  btn-danger"><span class='glyphicon glyphicon-exclamation-sign'></span> Report</button>
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

function unreportStory(id) {
    var story_id = id;
    $("#modal-unreport-story").modal('show');
    $('#modal-unreport-story').on('hidden.bs.modal', function(){
        story_id = 0;
    });
    $("#btn-unreport-story").click(function(){
        if (story_id != 0) {
            $.ajax({
                url:'story/'+story_id+'/unreport',
                type:'GET',
                success:function(data){
                    $("#modal-unreport-story").modal('hide');
                    if (data.status == 'success') {
                        table.ajax.reload();
                        console.log(data);
                    }
                    else{
                        window.alert('Gagal Menghapus data !');
                    }
                }
            });
        }
    });
}

function reportStory(id) {
    var story_id = id;
    $("#modal-report-story").modal('show');
    $('#modal-report-story').on('hidden.bs.modal', function(){
        story_id = 0;
    });
    $("#btn-report-story").click(function(){
        if (story_id != 0) {
            $.ajax({
                url:'story/'+story_id+'/report',
                type:'GET',
                success:function(data){
                    $("#modal-report-story").modal('hide');
                    if (data.status == 'success') {
                        table.ajax.reload();
                        console.log(data);
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