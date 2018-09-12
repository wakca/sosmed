@extends('layouts.admin')
@section('title','Selayang Pandang')
@section('content')
<div class="card ">
    <div class="header">
        <h4 class="title">Selayang Pandang</h4>
    </div>
    <div class="content">
        <form action="{{ route('admin_desa.content.selayang_pandang.save') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <textarea name="konten" id="konten" cols="30" rows="15" class="form-control">@if($data) {{ $data->konten }} @endif</textarea>
            </div>
            <div class="clearfix">
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/summernote.min.js') }}"></script>
@endsection


@section('script') 
<script src="{{ asset('js/jquery.form.min.js') }}"></script><script type="text/javascript">var num=1;
var progress=$('.progress');
var bar=$('.progress-bar');
var btnPost=$('#post');
$(document).ready(function() {
    $("#konten").summernote( {
        height: 200, toolbar: [ // [groupName, [list of button]]
        ['style', ['bold', 'italic', 'underline', 'clear']], ['insert', ['picture', 'video', 'link', 'table']], ['font', ['strikethrough', 'superscript', 'subscript']], ['fontsize', ['fontsize']], ['color', ['color']], ['para', ['ul', 'ol', 'paragraph']], ['height', ['height']], ['misc', ['fullscreen']], ],
    }
    );
    var options= {
        beforeSubmit: function() {
            if($("#deskripsi").val()=='') {
                alert('Deskripsi masih kosong !');
                return false;
            }
        }
        , beforeSubmit: function() {
            if($("#content").val()=='') {
                alert('Konten masih kosong !');
                return false;
            }
        }
        , beforeSend: function() {
            var percentVal='0%';
            progress.show();
            btnPost.text('Sedang Membuat...');
            btnPost.attr('disabled', true);
        }
        , uploadProgress: function(event, position, total, percentComplete) {
            var percentVal=percentComplete + '%';
        }, success: function() {
            var percentVal='100%';
        }
        , complete: function(response) {
            if($.isEmptyObject(response.responseJSON.error)) {
                window.location='{{ route('story') }}';
            }
            else {
                progress.hide();
                btnPost.text('Buat');
                btnPost.attr('disabled', false);
                printErrorMsg(response.responseJSON.error);
            }
        }
        ,
    }
    ;
    $("#postForm").ajaxForm(options);
}

);
function printErrorMsg (msg) {
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display', 'block');
    $.each( msg, function( key, value) {
        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
    }
    );
}

function removeImage(num) {
    $("#upload-image-"+num).remove();
    $(".thumb-"+num).remove();
}

</script>
@endsection