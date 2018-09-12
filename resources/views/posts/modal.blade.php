<!-- Likers Post -->
<div class="modal fade" id='modal-likers' tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><span class='glyphicon glyphicon-thumbs-up'></span> Orang yang menyukai ini</h4>
      </div>
      <div id='wrapper'>
      <div class="modal-body" id='list-likers'>
        
      </div>
      <div class='center-text' id='load-more'></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Share Post -->
<div class="modal fade" id='modal-share' tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><span class='glyphicon glyphicon-share-alt'></span> Share Post</h4>
      </div>
      <div class="modal-body">
        <ul class='nav nav-pills'>
            <li>Bagikan Ke :</li>
            <li><a href='' id='fb_share' target='_blank'><img src='/img/facebook.png' height='20'/> Facebook</a></li>
            <li><a href='' id='twit_share' target='_blank'><img src='/img/twitter.png' height='20'/> Twitter</a></li>
            <li><a href='' id='plus_share' target='_blank'><img src='/img/plus.png' height='20'/> Google+</a></li>
        </ul>
        <div class="input-group margin-top">
          <input type="text" class="form-control" id='url-post' placeholder="URL Post">
          <span class="input-group-btn">
            <button class="btn btn-primary" id='copy-btn' type="button">Copy</button>
          </span>
        </div><!-- /input-group -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Hapus Post -->
<div class="modal fade" id='modal-delete' tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><span class='glyphicon glyphicon-exclamation-sign'></span> Hapus Post</h4>
      </div>
      <div class="modal-body">
        <p>Anda yakin ingin menghapus post ini ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" id='btn-delete' class="btn btn-danger"><span class='glyphicon glyphicon-trash'></span> Hapus</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Hapus Komentar -->
<div class="modal fade" id='modal-delete-comment' tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><span class='glyphicon glyphicon-exclamation-sign'></span> Hapus Komentar</h4>
      </div>
      <div class="modal-body">
        <p>Anda yakin ingin menghapus komentar ini ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" id='btn-delete-comment' class="btn btn-danger"><span class='glyphicon glyphicon-trash'></span> Hapus</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Edit POST Modal -->
<div class="modal fade" id='modal-edit' tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form id='edit-form' method='POST'>
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><span class='glyphicon glyphicon-pencil'></span> Edit Post</h4>
            </div>
            <div class="modal-body">
              <textarea class="form-control" id='content-edit' name='content' rows='4' placeholder="What's Hapenning ?" required></textarea>
            </div>
            <div class="modal-footer">
              <button type="submit" id='btn-update' class="btn btn-primary"><span class='glyphicon glyphicon-pencil'></span> Update</button>
              <button type="reset" class="btn btn-default" data-dismiss="modal">Batal</button>
            </div>
        </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Edit Comment Modal -->
<div class="modal fade" id='modal-edit-comment' tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form id='editCommentForm' method='POST'>
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><span class='glyphicon glyphicon-pencil'></span> Edit Komentar</h4>
            </div>
            <div class="modal-body">
              <textarea class="form-control" id='comment-edit' name='comment' rows='4' placeholder="Masukan komentar..." required></textarea>
            </div>
            <div class="modal-footer">
              <button type="submit" id='btn-update' class="btn btn-primary"><span class='glyphicon glyphicon-pencil'></span> Update</button>
              <button type="reset" class="btn btn-default" data-dismiss="modal">Batal</button>
            </div>
        </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->