@extends('layouts.app')

@section('content')
<div class="container">
    <div class='row'>
        <div class='col-md-9' id="story-content">


            <div class='panel panel-default'>
                <div class='panel-heading'>
                <h2>{{ $produk->nama }}</h2>
                <span class='small-text'>{{ Date::parse($produk->created_at)->ago() }}</span>
                </div>
                <div class='panel-body'>
                {!! $produk->konten !!}
                </div>
            </div>
        </div>

        <div class='col-md-3'>
            @if($produk->des)
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Produk Unggulan {{$produk->des->nama}}</h3>
                    </div>
                    <div class="panel-body">
                        @if($produk->des->produk_unggulan()->count() > 1)
                        <ul>
                            @foreach($produk->des->produk_unggulan()->where('id', '!=', $produk->id)->limit(5)->get() as $prodes)
                                <li>{{$prodes->nama}}</li>
                            @endforeach
                        </ul>

                        @else
                            <center><span class="text-muted">Tidak Terdapat Produk Unggulan lainnya</span></center>
                        @endif
                    </div>
                </div>
            @endif
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
@endsection