<div class="row">
    <div class="col">

        <h4>Desa / Kelurahan Sekitar {{$desa->nama}}</h4>
        @if($desa)
                <div class="owl-carousel owl-theme full-width" data-plugin-options="{'items': 5, 'loop': false, 'nav': true, 'dots': false}">
                    @forelse($desa->kecamatan->des as $d)
                        <div>
                            <a href="{{url('/profil_desa/'.$d->id.'/beranda')}}">
                                <span class="thumb-info thumb-info-centered-info thumb-info-no-borders">
                                    <span class="thumb-info-wrapper">
                                        <img src="{{$d->foto_desa ? url('/storage/'.$d->foto_desa) : url('/img/blank_foto.png')}}" style="height: 150px; width: auto;" class="img-fluid" alt="">
                                        <span class="thumb-info-title">

                                            <span class="thumb-info-inner">Desa/Kelurahan {{$d->nama}}</span>
                                            <span class="thumb-info-type">Kunjungi Halaman</span>
                                        </span>
                                        <span class="thumb-info-action">
                                            <span class="thumb-info-action-icon"><i class="fa fa-link"></i></span>
                                        </span>
                                    </span>
                                </span>
                            </a>
                        </div>

                    @empty

                    @endforelse
                </div>

        @endif

    </div>

</div>