<div class="card ">
    <div class="header">
        <h4 class="title">Edit Comment</h4>
    </div>
    <div class='content'>
        <div class="alert alert-danger print-error-msg" style="display:none">
            <ul></ul>
        </div>
        <form id='commentForm' action='' class="form-horizontal" method='POST'>
            {{ csrf_field() }}
            <label for="content" class="control-label">Konten</label>
            <textarea id="content" rows='5' class="form-control" name="content">{{ old('content',$comment->content) }}</textarea>
            <div class="panel-body">
                <div class="progress" style='display:none;'>
                        <div class="progress-bar progress-bar-striped active" role="progressbar" style="width: 0%;">
                          0%
                        </div>
                </div>
                <button type="submit" id='comment' class="btn btn-primary">Update</button>
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
        var btnPost = $('#comment');

        $(document).ready(function(){
             var options = {
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
                        window.location='{{ route('admin.comment') }}';
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
            
            $("#commentForm").ajaxForm(options);
        });
          
            function printErrorMsg (msg) {
              $(".print-error-msg").find("ul").html('');
              $(".print-error-msg").css('display','block');
              $.each( msg, function( key, value ) {
                  $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
              });
            }
        
    </script>
@endsection