<div class="row">
    <div class="col">

        <h4>Desa / Kelurahan Sekitar {{$desa->nama}}</h4>
        @if($desa)
            <ul>
                @forelse($desa->kecamatan->des as $d)
                    @if($d->id != $desa->id)
                        <li>
                            <div>
                                <a href="{{url('/profil_desa/'.$d->id.'/beranda')}}"><i class="fa fa-tag"></i>&nbsp;&nbsp;Desa/Kelurahan {{$d->nama}}&nbsp;&nbsp;{{$d->foto_desa ? '<i class="fa fa-check"></i>' : ''}}</a>
                            </div>
                        </li>
                    @endif



                @empty

                @endforelse
            </ul>

            </div>

        @endif

    </div>

</div>