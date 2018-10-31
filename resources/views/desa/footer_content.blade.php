<div class="row">
    <div class="col">

        <h4>Desa / Kelurahan Sekitar {{$desa->nama}}</h4>
        @if($desa)
            <ul style="list-style-type: none; padding: 20px; background-color: #dfe6e9">
                @forelse($desa->kecamatan->des as $d)
                    @if($d->id != $desa->id)
                        <li style="margin: 10px;">
                                <a style="text-decoration: none !important; color: {{$d->foto_desa ? '#0984e3' : '#d63031'}};" href="{{url('/profil_desa/'.$d->id.'/beranda')}}"><i class="fa fa-home"></i>&nbsp;&nbsp;Desa/Kelurahan {{$d->nama}}&nbsp;&nbsp;{!! $d->foto_desa ? '<i class="fa fa-check"></i>' : ''!!}</a>
                        </li>
                    @endif



                @empty

                @endforelse
            </ul>

            </div>

        @endif

    </div>

</div>