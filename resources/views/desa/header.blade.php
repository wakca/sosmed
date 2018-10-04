<header id="header" class="header-no-min-height" data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyStartAt': 0, 'stickySetTop': '0'}">
    <div class="header-body">
        <div class="header-container container">
            <div class="header-row">
                <div class="header-column">
                    <div class="header-row">
                        <div class="header-logo">
                            <a href="{{ route('index') }}">
                                <img alt="Klipaa.com" width="40" height="40" data-sticky-width="45" data-sticky-height="45" data-sticky-top="105" src="{{ asset('img/logo.png') }}">

                            </a>

                        </div>
                        <div width="50" height="60" style="margin-left: 20px; ">
                            <h3 style="font-size: 15px; line-height: 15px; margin-bottom: 0;">
                                Desa <strong>{{ $desa ? $desa->nama : '' }}</strong><br/>
                                <small>Kecamatan {{ $desa->kecamatan->nama }}</small><br/>
                                <small>{{ $desa->kecamatan->kab->nama }}</small>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="header-column justify-content-end">
                    <div class="header-row">
                        <div class="header-nav header-nav-stripe">
                            <div class="header-nav-main header-nav-main-square header-nav-main-effect-1 header-nav-main-sub-effect-1">
                                <nav class="collapse">
                                    @include('desa.navbar')
                                </nav>
                            </div>
                            <ul class="header-social-icons social-icons ">
                                @if($desa->link_web)
                                    <li class="social-icons-instagram"><a href="{{ $desa ? $desa->link_web : '#' }}" target="_blank" title="Web Desa"><i class="fa fa-globe"></i></a></li>
                                @endif

                                <li class="social-icons-facebook"><a href="{{ $desa ?  $desa->facebook : '#'}}" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                <li class="social-icons-twitter"><a href="{{ $desa ? $desa->twitter : '#' }}" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                            </ul>
                            <button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main nav">
                                <i class="fa fa-bars"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
