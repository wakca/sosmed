@extends('layouts.app')

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class='panel-heading'>
            Tambahkan Produk Baru
        </div>
        <div class="panel-body">
            <div class="alert alert-danger print-error-msg" style="display:none">
                <ul></ul>
            </div>
            <form action='{{ route('desa.produk.save') }}' class="form-horizontal" method='POST' enctype="multipart/form-data">
                {{ csrf_field() }}
                <label class='control-label' for='title'>Nama Produk</label>
                <input id="title" type="text" size='50' style='width:auto;' class="form-control" name="nama" value="{{ old('nama') }}"
                    required autofocus>
                <label class='control-label' for='content'>Deskripsi Produk</label>
                <textarea id="content" rows='5' class="form-control" name="konten">{{ old('konten') }}</textarea>
                
                <div class='panel-body'>
                    <div class="progress" style='display:none;'>
                        <div class="progress-bar progress-bar-striped active" role="progressbar" style="width: 0%;">
                            0%
                        </div>
                    </div>
                    <button type="submit" class="btn btn-block btn-primary">Tambahkan Produk</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('css')
    <link href="{{ asset('css/summernote.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet">

@endsection
@section('js')
    <script src="{{ asset('js/summernote.min.js') }}"></script>
    <script src="{{ asset('bootstrap-select/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('bootstrap-select/js/i18n/defaults-id_ID.js') }}"></script>  

    <script>
    $('img').addClass('img img-responsive');
    </script>

    <script src="{{ asset('js/jquery.form.min.js') }}"></script>
    <script type="text/javascript">
        var num = 1;
        var progress = $('.progress');
        var bar = $('.progress-bar');
        var btnPost = $('#post');
        $(document).ready(function(){
            $("#content").summernote({
                                height:300,
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
                                });
             var options = {
                beforeSubmit: function(){
                    if($("#deskripsi").val() == ''){
                        alert('Deskripsi masih kosong !');
                        return false;
                    }
                },
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
                    btnPost.text('Sedang Membuat...');
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
                        window.location='{{ route('desa.produk') }}';
                    }else{
                        progress.hide();
                        btnPost.text('Buat');
                        btnPost.attr('disabled',false);
                        printErrorMsg(response.responseJSON.error);
                    }
                },
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
    </script>
@endsection