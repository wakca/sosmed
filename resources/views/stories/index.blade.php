<div class='panel story panel-default'>
    <div class='panel-heading'>Ini cerita yang kamu buat ! <a href='{{ route('story.create') }}' class='pull-right btn btn-primary btn-xs'><i class='glyphicon glyphicon-plus'></i> Buat Ceritamu</a></div>
        @foreach($stories as $story)
            <div class="panel-body">
              <h4><a href='{{ route('story.view',['slug' => $story->slug]) }}'>{{ $story->title }}</a></h4>
              <p>{{ strlen(strip_tags($story->content)) > 250 ? str_limit(strip_tags($story->content),250)."...":strip_tags($story->content) }}</p>
              <p><a href="{{ route('story.edit', ['id' => $story->id]) }}" class="btn btn-xs btn-primary" role="button"><i class='glyphicon glyphicon-pencil'></i> Edit</a> <a href="javascript:void(0);"  onclick='deleteStory({{ $story->id }});' class="btn btn-xs btn-default" role="button"><i class='glyphicon glyphicon-trash'></i> Hapus</a>
                <span class='pull-right small-text'>{{ Date::parse($story->created_at)->ago() }}</span>
</p>
            </div>
        @endforeach
</div>
{{ $stories->links() }}
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
        <button type="button" id='btn-delete-story' class="btn btn-danger"><span class='glyphicon glyphicon-trash'></span> Hapus</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@section('script')
<script type='text/javascript'>
function deleteStory(id) {
        var story_id = id;
        $("#modal-delete-story").modal('show');
        $('#modal-delete-story').on('hidden.bs.modal', function(){
            story_id = 0;
        });
        $("#btn-delete-story").click(function(){
            if (story_id != 0) {
                $.ajax({
                    url:'/story/'+story_id+'/delete',
                    type:'GET',
                    success:function(data){
                        $("#modal-delete-story").modal('hide');
                        if (data.status == 'success') {
                            window.location.reload();
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