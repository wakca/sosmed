<div class="panel panel-default">
    <div class='panel-heading'>
        Ceritakan Kejadian didesamu !
    </div>
    <div class="panel-body">
        <div class="alert alert-danger print-error-msg" style="display:none">
            <ul></ul>
        </div>
        <form id='postForm' action='' class="form-horizontal" method='POST' enctype="multipart/form-data">
            {{ csrf_field() }}
            <label class='control-label' for='title'>Judul Cerita</label>
            <input id="title" type="text" size='50' style='width:auto;' class="form-control" name="title" value="{{ old('title') }}" required autofocus>
            <label class='control-label' for='content'>Konten</label>
            <textarea id="content" rows='5' class="form-control" name="content">{{ old('content') }}</textarea>
            <label class='control-label' for='content'>Tags</label>
            <select class='selectpicker' name='tags[]' data-header="Pilih satu atau beberapa tag" data-width='100%' data-live-search="true" multiple required>
                @foreach($tags as $tag)
                    <option value='{{ $tag->id }}'>{{ ucfirst($tag->name) }}</option>
                @endforeach
            </select>
            <div class='panel-body'>
                <div class="progress" style='display:none;'>
                    <div class="progress-bar progress-bar-striped active" role="progressbar" style="width: 0%;">
                        0%
                    </div>
                </div>
                <button type="submit" id='post' class="btn btn-primary">Buat</button>
            </div>
        </form>
    </div>
</div>
@section('script')
    <script src='{{url('/js/jquery.mentionsInput.js')}}' type='text/javascript'></script>
    <script src="{{ asset('js/jquery.form.min.js') }}"></script>
    <script type="text/javascript">
        var num=1;
        var progress=$('.progress');
        var bar=$('.progress-bar');
        var btnPost=$('#post');

        $(document).ready(function() {



                $("#content").summernote( {
                    height: 200, toolbar: [ // [groupName, [list of button]]
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['insert', ['picture', 'video', 'link', 'table']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']], ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']],
                        ['misc', ['fullscreen']],
                    ],
                    hint: {
                        mentions: ['jayden', 'sam', 'alvin', 'david'],
                        match: /\B@(\w*)$/,
                        search: function (keyword, callback) {
                            if(keyword != '' && keyword.length > 3){
                                var hasil = [];
                                $.getJSON('{{route('user.query')}}?query='+keyword, function(responseData) {
                                    callback($.grep(responseData, function (item) {
                                        return item;
                                    }));
                                });

                            }

                        },
                        template: function(item){
                            return item.name;
                        },
                        content: function (item) {

                            return $('<a />').attr('href', "{{url('/')}}"+'/'+item.username).text(item.name)[0];
                        }
                    }

                });

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
                            bar.css('width', percentVal);
                            bar.html(percentVal);
                            btnPost.text('Sedang Membuat...');
                            btnPost.attr('disabled', true);
                        }
                        , uploadProgress: function(event, position, total, percentComplete) {
                            var percentVal=percentComplete + '%';
                            bar.css('width', percentVal);
                            bar.html(percentVal);
                        }
                        , success: function() {
                            var percentVal='100%';
                            bar.css('width', percentVal);
                            bar.html(percentVal);
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