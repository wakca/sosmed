<div class="panel panel-default">
    <div class='panel-heading'><a href='/messages/group/{{ $groupchat->id }}'><strong>{{ $groupchat->name }}</a></strong> <span class='small-text'>< <a href='javascript:void(0);' onclick='showAnggota();'>{{ sizeof($groupchat->member) }} Anggota</a> ></span></div>
    <div id='message-container' class="panel-body message-container">
        Tidak ada Obrolan.
    </div>
</div>
<div class='panel panel-default'>
    <div class='panel-body'>
        <form id='sendForm' action='/messages/group/post' class="form-horizontal" method='POST' enctype="multipart/form-data">
            {{ csrf_field() }}
            <textarea class="form-control" id='message' name='message' rows='3' placeholder="Masukan Pesan anda" required></textarea>
            <input type='hidden' id='user_id' name='user_id' value='{{ Auth::Id() }}'/>
            <input type='hidden' id='group_id' name='group_id' value='{{ $groupchat->id }}'/>
            <div id="image_preview"></div>
            <div class="progress" style='display:none;'>
                <div class="progress-bar progress-bar-striped active" role="progressbar" style="width: 0%;">
                  0%
                </div>
              </div>
            <div id='img-input'><input type='file' accept="image/*" id='upload-image-1' class='upload-image' name='photos[]'/></div>
            <div id='act-btn'>
            <label id='upload-label-1' class='upload-label' for='upload-image-1' title="Tambahkan Foto"><span class='glyphicon glyphicon-picture'></span> Tambahkan Foto</label><button type="submit" id='send' class="pull-right btn btn-primary margin-top">Kirim</button></div>
        </form>
    </div>
</div>
<!-- Hapus Post -->
<div class="modal fade" id='modal-delete-message' tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><span class='glyphicon glyphicon-exclamation-sign'></span> Hapus Pesan</h4>
      </div>
      <div class="modal-body">
        <p>Anda yakin ingin menghapus pesan ini ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" id='btn-delete-message' class="btn btn-danger"><span class='glyphicon glyphicon-trash'></span> Hapus</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Hapus Post -->
<div class="modal fade" id='modal-member-message' tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><span class='glyphicon glyphicon-list'></span> Anggota Grup</h4>
      </div>
      <div id='list-likers' class="modal-body">
        {!! Getter::getGroupchatMember($groupchat->id) !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@section('script')
    <script src="{{ asset('js/jquery.form.min.js') }}"></script>
    <script type="text/javascript">
        var num = 1;
        var progress = $('.progress');
        var bar = $('.progress-bar');
        var btnPost = $('#post');
        var scrolled = false;
                
        $(document).ready(function(){
            window.setInterval(getNewMessage, 1100);
            
            $("#message-container").on('scroll', function(){
                scrolled=true;
            });
            
            $("#sendForm").ajaxForm(options);
            
            $('body').on('change', ':file', function(){
                var total_file=document.getElementById("upload-image-"+num).files.length;
                
                for(var i=0;i<total_file;i++)
                {
                    var maxWidth    = 127;
                    var maxHeight   = 127;
                    var ratio       = 0;
                    var ratio2      = 0;
                    var style = "";
                    var src = window.URL.createObjectURL(event.target.files[i]);
                    var img = new Image();
                    img.src = window.URL.createObjectURL(event.target.files[i]);
                    img.onload = function() {
                    var width  = img.naturalWidth,
                        height = img.naturalHeight;
                        
                        if (width > height) {
                            ratio = Math.min(maxWidth / width);
                            ratio2= Math.min(maxHeight/height);
                            style = "height:"+(height*ratio2)+"px;width:"+(127+(width*ratio))+"px;margin-left:-"+(254*ratio)+"px;margin-top:0px;";
                        }
                        else if (width < height) {
                            ratio = Math.min(maxHeight / height);
                            ratio2= Math.min(maxWidth/width);
                            style = "height:"+(127+(height*ratio))+"px;width:"+(width*ratio2)+"px;margin-top:-"+(254*ratio)+"px;margin-left:0px;";
                        }
                        else{
                            style = "height:127px;width:127px;";
                        }
                        $('#image_preview').append("<div class='upload-thumb thumb-"+(num-1)+"'><div class='upload-remove' onclick='removeImage("+(num-1)+");'><span class='glyphicon glyphicon-remove'></span></div><img src='"+src+"' style='"+style+"'/></div>");

                    }
                }
                $(this).hide();
                $("#upload-label-"+num).hide();
                num++;
                $("#img-input").append("<input type='file' accept='image/*' id='upload-image-"+num+"' class='upload-image' name='photos[]'/>");
                $("#act-btn").prepend("<label  class='upload-label' id='upload-label-"+num+"' for='upload-image-"+num+"' title='Tambahkan Foto'><span class='glyphicon glyphicon-picture'></span> Tambahkan Foto</label>");
            });
        });
        var options = {
                beforeSend: function() {
                    var percentVal = '0%';
                    progress.show();
                    bar.css('width',percentVal)
                    bar.html(percentVal);
                    btnPost.text('Posting...');
                    btnPost.attr('disabled',true);
                },
                uploadProgress: function(event, position, total, percentComplete) {
                    var percentVal = percentComplete + '%';
                    bar.css('width',percentVal)
                    bar.html(percentVal);
                },
                success: function() {
                    var percentVal = '100%';
                    bar.css('width',percentVal)
                    bar.html(percentVal);
                },
                complete: function(response) 
                {
                    if($.isEmptyObject(response.responseJSON.error)){
                        progress.hide();
                        btnPost.text('Post');
                        btnPost.attr('disabled',false);
                        $("#image_preview").html("");
                        getNewMessage();
                        updateScroll();
                    }else{
                        printErrorMsg(response.responseJSON.error);
                    }
                },
                clearForm: true,
                resetForm: true
            };
          
            function printErrorMsg (msg) {
              $(".print-error-msg").find("ul").html('');
              $(".print-error-msg").css('display','block');
              $.each( msg, function( key, value ) {
                  $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
              });
            }
            
            function removeImage(num) {
                $("#upload-image-"+num).remove();
                $(".thumb-"+num).remove();
            }
            
            function updateScroll(){
                console.log('asdsada');
                if(!scrolled){
                    $('#message-container').scrollTop($('#message-container')[0].scrollHeight);
                }
            }
            
            function deleteMessage(id) {
                var message_id = id;
                $("#modal-delete-message").modal('show');
                $('#modal-delete-message').on('hidden.bs.modal', function(){
                    message_id = 0;
                });
                $("#btn-delete-message").click(function(){
                    if (message_id != 0) {
                        $.ajax({
                            url:'/messages/'+message_id+'/delete',
                            type:'GET',
                            success:function(data){
                                $("#modal-delete-message").modal('hide');
                                if (!data.status == 'success') {
                                    window.alert('Gagal Menghapus data !');
                                }
                            }
                        });
                    }
                });
            }
            
            function getNewMessage() {
                $("#message-container").load('/messages/group/{{$groupchat->id}}/list',function(){
                    updateScroll();
                });
            }
            
            function showAnggota() {
                $("#modal-member-message").modal('show');
            }
    </script>
@endsection