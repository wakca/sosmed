<div class="panel panel-default">
    <div class="panel-body">
        Semua Pesan Grup <button class='btn btn-xs btn-default pull-right' onclick='createGroup()'>+ Buat Grup</button>
    </div>
</div>
<!-- Buat Grup Chat -->
<div class="modal fade" id='modal-creategroup-conversation' tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><span class='glyphicon glyphicon-envelope'></span> Buat Percakapan Grup</h4>
      </div>
    <form id='create-group-chat' method='POST' action='/messages/group'>
        {{ csrf_field() }}
      <div class="modal-body">
            <div class='form-group'>
                <label for='groupname'>Nama Grup</label>
                <input type='text' id='groupname' name='groupname' class='form-control' required/>
            </div>
            <div class='form-group member'>
                <label for='added-member'>Anggota Grup</label>
                <p class='added-member'></p>
            </div>
            <div class='form-group'>
                <label for='groupmember'>Tambahkan Anggota</label>
                <input type='text' id='groupmember' autocomplete='off' class='form-control'/>
                <div id='list-member'></div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" id='create-group' class="btn btn-sm btn-primary">Buat</button>
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
      </div>
    </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Edit Grup Chat -->
<div class="modal fade" id='modal-editgroup-conversation' tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><span class='glyphicon glyphicon-pencil'></span> Edit Percakapan Grup</h4>
      </div>
    <form id='edit-group-chat' method='POST' action=''>
        {{ csrf_field() }}
      <div class="modal-body">
            <div class='form-group'>
                <label for='egroupname'>Nama Grup</label>
                <input type='text' id='egroupname' name='egroupname' class='form-control' required/>
            </div>
            <div class='form-group member'>
                <label for='eadded-member'>Anggota Grup</label>
                <p class='eadded-member'></p>
            </div>
            <div class='form-group'>
                <label for='egroupmember'>Tambahkan Anggota</label>
                <input type='text' id='egroupmember' autocomplete='off' class='form-control'/>
                <div id='elist-member'></div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" id='edit-group' class="btn btn-sm btn-primary">Update</button>
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
      </div>
    </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Hapus Pesan -->
<div class="modal fade" id='modal-delete-conversation' tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><span class='glyphicon glyphicon-exclamation-sign'></span> Hapus Percakapan Grup</h4>
      </div>
      <div class="modal-body">
        <p>Anda yakin ingin menghapus percakapan grup ini ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" id='btn-delete-conversation' class="btn btn-sm btn-danger"><span class='glyphicon glyphicon-trash'></span> Hapus</button>
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Tinggalkan Grup -->
<div class="modal fade" id='modal-leave-conversation' tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><span class='glyphicon glyphicon-exclamation-sign'></span> Tinggalkan Percakapan Grup</h4>
      </div>
      <div class="modal-body">
        <p>Anda yakin ingin meninggalkan percakapan grup ini ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" id='btn-leave-conversation' class="btn btn-sm btn-danger"><span class='glyphicon glyphicon-remove'></span> Tinggalkan</button>
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@section('script')
     <script src="{{ asset('js/jquery.form.min.js') }}"></script>
    <script type="text/javascript">    
        var btnPost = $('#create-group');
        var btnEdit = $('#edit-group');
                
        $(document).ready(function(){
            var options = {
                beforeSend: function() {
                    btnPost.text('Membuat...');
                    btnPost.attr('disabled',true);
                },
                complete: function(response) 
                {
                    if($.isEmptyObject(response.responseJSON.error)){
                        btnPost.text('Buat');
                        btnPost.attr('disabled',false);
                        window.location.reload();
                    }else{
                        printErrorMsg(response.responseJSON.error);
                    }
                },
                clearForm: true,
                resetForm: true
            };
            
            $("#create-group-chat").ajaxForm(options);
            
            var options2 = {
                beforeSend: function() {
                    btnEdit.text('Mengupdate...');
                    btnEdit.attr('disabled',true);
                },
                complete: function(response) 
                {
                    if($.isEmptyObject(response.responseJSON.error)){
                        btnEdit.text('Update');
                        btnEdit.attr('disabled',false);
                        window.location.reload();
                    }else{
                        printErrorMsg(response.responseJSON.error);
                    }
                },
                clearForm: true,
                resetForm: true
            };
            
            $("#edit-group-chat").ajaxForm(options2);
        });
          
        function printErrorMsg (msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
        }
    </script>
    <script type="text/javascript">
        var added = "";
        
        $(document).ready(function(){
            
            $("#groupmember").keyup(function(){
                if ($("#groupmember").val() != '') {
                    $.ajax({
                        url:'/messages/group/autocomplete',
                        type:'GET',
                        data:{groupmember:$("#groupmember").val()},
                        success:function(data){
                            $("#list-member").html('');
                            $.each(data,function(key, val){
                                $("#list-member").append("<div class='media group-member member-"+data[key].id+"'><div class='content'><p class='media-heading'><a href='/"+data[key].username+"'>"+data[key].name+"</a> &bull; <span class='small-text'>@"+data[key].username+"</span></p></div><div class='avatar'>"+($(".badge-"+data[key].id).length?"<a href='javascript:void(0)' onclick=\"removeMember(\'"+data[key].name+"\',"+data[key].id+")\" class='btn btn-xs'><span class='glyphicon glyphicon-minus'></span></a>":"<a href='javascript:void(0)' onclick=\"addMember(\'"+data[key].name+"\',"+data[key].id+")\" class='btn btn-xs'><span class='glyphicon glyphicon-plus'></span></a>")+"</div></div>");
                            });
                        }
                    });
                }
                else{
                    $("#list-member").html("");   
                }
            });
            
            $("#egroupmember").keyup(function(){
                if ($("#egroupmember").val() != '') {
                    $.ajax({
                        url:'/messages/group/autocomplete',
                        type:'GET',
                        data:{groupmember:$("#egroupmember").val()},
                        success:function(data){
                            $("#elist-member").html('');
                            $.each(data,function(key, val){
                                $("#elist-member").append("<div class='media group-member member-"+data[key].id+"'><div class='content'><p class='media-heading'><a href='/"+data[key].username+"'>"+data[key].name+"</a> &bull; <span class='small-text'>@"+data[key].username+"</span></p></div><div class='avatar'>"+($(".badge-edit-"+data[key].id).length?"<a href='javascript:void(0)' onclick=\"removeEditMember(\'"+data[key].name+"\',"+data[key].id+")\" class='btn btn-xs'><span class='glyphicon glyphicon-minus'></span></a>":($(".badge-"+data[key].id).length?"<a href='javascript:void(0)' onclick=\"removeEMember(\'"+data[key].name+"\',"+data[key].id+")\" class='btn btn-xs'><span class='glyphicon glyphicon-minus'></span></a>":"<a href='javascript:void(0)' onclick=\"addEditMember(\'"+data[key].name+"\',"+data[key].id+")\" class='btn btn-xs'><span class='glyphicon glyphicon-plus'></span></a>"))+"</div></div>");
                            });
                        }
                    });
                }
                else{
                    $("#elist-member").html("");   
                }
            });
        });
        
        function addMember(name,id) {
            added = "<span class='badge badge-"+id+"'>"+name+" <a href='javascript:void(0);' title='Hapus' onclick=\"removeMember('"+name+"',"+id+")\">-</a></span> ";
            $(".member-"+id).remove();
            $(".added-member").append(added);
            $(".member").append("<input type='hidden' class='grup-member-"+id+"' name='groupmember[]' value='"+id+"'/>");
        }
        
        function removeMember(name,id) {
            $(".badge-"+id).remove();
            $(".member-"+id).find(".avatar").html("<a href='javascript:void(0)' onclick=\"addMember(\'"+name+"\',"+id+")\" class='btn btn-xs'><span class='glyphicon glyphicon-plus'></span></a>");
            $(".grup-member-"+id).remove();
        }
        
        function addEditMember(name,id) {
            added = "<span class='badge badge-"+id+"'>"+name+" <a href='javascript:void(0);' title='Hapus' onclick=\"removeMember('"+name+"',"+id+")\">-</a></span> ";
            $(".member-"+id).remove();
            $(".eadded-member").append(added);
            $(".member").append("<input type='hidden' class='grup-member-"+id+"' name='groupmember[]' value='"+id+"'/>");
        }
        
        function removeEMember(name,id) {
            $(".badge-"+id).remove();
            $(".member-"+id).find(".avatar").html("<a href='javascript:void(0)' onclick=\"addEditMember(\'"+name+"\',"+id+")\" class='btn btn-xs'><span class='glyphicon glyphicon-plus'></span></a>");
            $(".grup-member-"+id).remove();
        }
        
        function removeEditMember(name,id) {
            $(".badge-edit-"+id).remove();
            $(".member-"+id).find(".avatar").html("<a href='javascript:void(0)' onclick=\"addEditMember(\'"+name+"\',"+id+")\" class='btn btn-xs'><span class='glyphicon glyphicon-plus'></span></a>");
            $(".member").append("<input type='hidden' class='removed-grup-member-"+id+"' name='removedgroupmember[]' value='"+id+"'/>");
            $(".grup-member-"+id).remove();
        }
        
        function createGroup() {
            $("#modal-creategroup-conversation").modal('show');
        }
        
        function deleteConversation(id) {
            var conversation_id = id;
            $("#modal-delete-conversation").modal('show');
            $('#modal-delete-conversation').on('hidden.bs.modal', function(){
                conversation_id = 0;
            });
            $("#btn-delete-conversation").click(function(){
                if (conversation_id != 0) {
                    $.ajax({
                        url:'/messages/group/'+conversation_id+'/delete',
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
        function leaveConversation(id) {
            var conversation_id = id;
            $("#modal-leave-conversation").modal('show');
            $('#modal-leave-conversation').on('hidden.bs.modal', function(){
                conversation_id = 0;
            });
            $("#btn-leave-conversation").click(function(){
                if (conversation_id != 0) {
                    $.ajax({
                        url:'/messages/group/'+conversation_id+'/leave',
                        type:'GET',
                        success:function(data){
                            $("#modal-leave-conversation").modal('hide');
                            if (!data.status == 'success') {
                                window.alert('Gagal Memproses data !');
                            }
                            else{
                                window.location.reload();
                            }
                        }
                    });
                }
            });
        }
        
        function editConversation(id) {
            $("#edit-group-chat").attr('action','/messages/group/'+id+'/edit');
            var conversation_id = id;
            $("#modal-editgroup-conversation").modal('show');
            $('#modal-editgroup-conversation').on('hidden.bs.modal', function(){
                conversation_id = 0;
            });
            $.ajax({
                url:'/messages/group/'+conversation_id+'/edit',
                type:'get',
                success:function(data){
                    $("#egroupname").val(data.group.name);
                    $(".eadded-member").html("");
                    $.each(data.member,function(i,v){
                       $(".eadded-member").append("<span class='badge badge-edit-"+data.member[i].user_id+"'>"+data.member[i].user.name+" <a href='javascript:void(0);' title='Hapus' onclick=\"removeEditMember('"+data.member[i].user.name+"',"+data.member[i].user_id+")\">-</a></span> ");
                    });
                }
            })
        }
    </script>
@endsection