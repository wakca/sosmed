@extends('layouts.admin')
@section('title','Konten Klipaa')
@section('content')
<form action="{{ route('admin.konten.save') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}

    <input type="hidden" value="{{ $konten->id }}" name="id">

    <div class="row">

        <div class="col-md-8">
            <div class="form-group">
                <label for="">Judul</label>
                <input type="text" disabled value="{{ $konten->title }}" class="form-control">
            </div>

            <div class="form-group">

                <label for="content">Konten</label>
                <textarea class="form-control" name="content" id="content" cols="30" rows="10" class="content">{!! $konten->content !!}</textarea>

            </div>

            <button type="submit" class="btn btn-block btn-primary">
                Simpan
            </button>

        </div>
        <div class="col-md-4">

        </div>

    </div>

</form>
@endsection

@section('css')
<link href="{{ asset('css/summernote.css') }}" rel="stylesheet">
@endsection


@section('js')
<script src="{{ asset('js/summernote.min.js') }}"></script>

<script>
$("#content").summernote( {
    height: 200, toolbar: [ // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']], ['insert', ['picture', 'video', 'link', 'table']], ['font', ['strikethrough', 'superscript', 'subscript']], ['fontsize', ['fontsize']], ['color', ['color']], ['para', ['ul', 'ol', 'paragraph']], ['height', ['height']], ['misc', ['fullscreen']], ],
});


</script>
@endsection