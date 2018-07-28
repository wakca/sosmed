@extends('desa.layout')
@section('title')
Desa {{ $desa->nama }}
@endsection

@section('content')
<h2>
    Produk Unggulan di Desa {{ $desa->nama }}
</h2>

<div id='story' class="col-md-12">
    <div class='row story-container' id='list-story'>
        @foreach($produk as $list_produk)
            <div class='panel story panel-default'>
                <div class='panel-heading'><strong><a href="">{{ $list_produk->nama }}</a> oleh <a href='{{ $list_produk->user->username }}'>{{ '@'.$list_produk->user->username }}</a></strong></div>
                <div class='panel-body'>
                    {!! Getter::getStoryThumb($list_produk->konten,$list_produk->nama) !!}
                    <div class="caption">
                        <h4><a href='{{ route('desa.produk.detail', $list_produk->id) }}'>{{ $list_produk->title }}</a></h4>
                        <p>{{ strlen(strip_tags($list_produk->konten)) > 100 ? str_limit(strip_tags($list_produk->konten),100)."...":strip_tags($list_produk->konten) }}</p>
                        <div class="clearfix">
                            <div class="pull-right">
                                <a href="{{ route('desa.produk.detail', $list_produk->id) }}" class="btn btn-primary">Lihat Produk</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="pull-right">
            <div>{{ $produk-> links() }}</div>
                <div class='center-text' id='load-more'>
            </div>
        </div>
    </div>
</div>
@endsection