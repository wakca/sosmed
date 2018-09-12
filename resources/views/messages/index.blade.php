<div class="panel panel-default">
    <div class="panel-body">
        Semua Pesan
    </div>
</div>
<!-- Hapus Pesan -->
<div class="modal fade" id='modal-delete-conversation' tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><span class='glyphicon glyphicon-exclamation-sign'></span> Hapus Percakapan</h4>
      </div>
      <div class="modal-body">
        <p>Anda yakin ingin menghapus semua percakapan pada pesan ini ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" id='btn-delete-conversation' class="btn btn-sm btn-danger"><span class='glyphicon glyphicon-trash'></span> Hapus</button>
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@section('script')
    <script type="text/javascript">
        function deleteConversation(id) {
            var conversation_id = id;
            $("#modal-delete-conversation").modal('show');
            $('#modal-delete-conversation').on('hidden.bs.modal', function(){
                conversation_id = 0;
            });
            $("#btn-delete-conversation").click(function(){
                if (conversation_id != 0) {
                    $.ajax({
                        url:'/messages/'+conversation_id+'/deleteall',
                        type:'GET',
                        success:function(data){
                            $("#modal-delete-conversation").modal('hide');
                            if (!data.status == 'success') {
                                window.alert('Gagal Menghapus data !');
                            }
                            else{
                                window.location.reload();
                            }
                        }
                    });
                }
            });
        }
    </script>
@endsection