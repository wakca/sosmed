@extends('layouts.app')
@section('title')
Desa {{ $desa->nama }}
@endsection

@section('content')
<div class="container">
    
    <div class='panel panel-default profile-card margin-bottom'>
        <div class='panel-heading'>
            <div class="media">
                <div class="media-body">
                    Menampilkan {{ count($produk) }} oleh user <a href="/{{ Auth::user()->username }}">{{ '@'.Auth::user()->username }}</a>
                </div>
            </div>
        </div>
        <div class='panel-body'>
        
            <div class="clearfix">
                <div class="pull-right">
                    <a href="{{ route('desa.produk.create') }}" class="btn btn-primary"><i class="fa fa-lg fa-plus"></i> Tambahkan Produk Baru</a>
                </div>
            </div>
            
            @foreach($produk as $list_produk)
                <div class="panel-body">
                    <h4><a href='{{ route('desa.produk.detail', $list_produk->id) }}'>{{ $list_produk->nama }}</a></h4>
                    <p>{{ strlen(strip_tags($list_produk->konten)) > 250 ? str_limit(strip_tags($list_produk->konten),250)."...":strip_tags($list_produk->konten) }}</p>
                    <p><a href="{{ route('desa.produk.edit', ['id' => $list_produk->id]) }}" class="btn btn-xs btn-primary" role="button"><i class='glyphicon glyphicon-pencil'></i> Edit</a> <a href="javascript:void(0);"  onclick='deleteStory({{ $list_produk->id }});' class="btn btn-xs btn-default" role="button"><i class='glyphicon glyphicon-trash'></i> Hapus</a> <a href="{{ route('desa.produk.detail', $list_produk->id) }}" class="btn btn-xs btn-info">Lihat Produk</a>
                        <span class='pull-right small-text'>{{ Date::parse($list_produk->created_at)->ago() }}</span>
                    </p>
                </div>
                <hr>
            @endforeach
    

        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection