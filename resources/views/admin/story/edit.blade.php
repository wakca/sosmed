<div class="card ">
    <div class="header">
        <h4 class="title">Edit Story</h4>
    </div>
    <div class='content'>
        <div class="alert alert-danger print-error-msg" style="display:none">
            <ul></ul>
        </div>
        <form id='postForm' action='' class="form-horizontal" method='POST' enctype="multipart/form-data">
            {{ csrf_field() }}
            <label for="title" class="control-label">Judul Cerita</label>
            <input id="title" style='width:auto;' size='50' type="text" class="form-control" name="title" value="{{ old('title',$story->title) }}" required autofocus>
            <label for="content" class="control-label">Konten</label>
            <textarea id="content" rows='5' class="form-control" name="content">{{ old('content',$story->content) }}</textarea>
            <label class='control-label' for='content'>Tags</label>
            <select class='selectpicker' name='tags[]' data-header="Pilih satu atau beberapa tag" data-width='100%' data-live-search="true" multiple required>
            @php
            $tagged = array();
            foreach($story->tags as $stag){
                    $tagged[] .= $stag->id;
            }
            @endphp
                  @foreach($tags as $tag)
                  <option value='{{ $tag->id }}' {{ in_array($tag->id,$tagged)?"selected":"" }}>{{ ucfirst($tag->name) }}</option>
                  @endforeach
            </select>
            <div id='removedImage'></div>
            <div class="panel-body">
                <div class="progress" style='display:none;'>
                        <div class="progress-bar progress-bar-striped active" role="progressbar" style="width: 0%;">
                          0%
                        </div>
                </div>
                <button type="submit" id='post' class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>       
@section('script')
    <script src="{{ asset('js/jquery.form.min.js') }}"></script>
    <script type="text/javascript">
        var num = 1;
        var progress = $('.progress');
        var bar = $('.progress-bar');
        var btnPost = $('#post');

        $(document).ready(function(){
            $("#content").summernote({
                                        dialogsInBody: true,
                                        height:200,
                                        toolbar: [
                                                // [groupName, [list of button]]
                                                ['style', ['bold', 'italic', 'underline', 'clear']],
                                                ['insert',['picture','video','link','table']],
                                                ['font', ['strikethrough', 'superscript', 'subscript']],
                                                ['fontsize', ['fontsize']],
                                                ['color', ['color']],
                                                ['para', ['ul', 'ol', 'paragraph']],
                                                ['height', ['height']],
                                                ['misc',['fullscreen']],
                                        ],
                                        callbacks:{
                                                onMediaDelete : function($target, editor, $editable) {
                                                var img = $target[0].src; // img
                                                if (img.match('/images/')) {
                                                        var imgname = img.split('/images/');
                                                        $("#removedImage").append("<input type='hidden' name='rfile[]' value='"+imgname[1]+"'/>");
                                                }
                                                // remove element in editor 
                                                $target.remove();
                                                }
                                        }});
             var options = {
                beforeSubmit: function(){
                    if($("#content").val() == ''){
                        alert('Konten masih kosong !');
                        return false;
                    }
                },
                beforeSend: function() {
                    var percentVal = '0%';
                    progress.show();
                    bar.css('width',percentVal)
                    bar.html(percentVal);
                    btnPost.text('Menyimpan...');
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
                        window.location='{{ route('admin.story') }}';
                    }else{
                        progress.hide();
                        btnPost.text('Update');
                        btnPost.attr('disabled',false);
                        printErrorMsg(response.responseJSON.error);
                    }
                },
                clearForm: false,
                resetForm: false
            };
            
            $("#postForm").ajaxForm(options);
        });
          
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
            
            function removeCurrentImage(num) {
                $("#img-input").append("<input type='hidden' value='"+num+"' name='removedphotos[]'/>");
                $(".thumb-"+num+"-current").remove();
            }
    </script>
@endsection