<header id="header" class="header-no-border-bottom" data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyStartAt': 113, 'stickySetTop': '-113px', 'stickyChangeLogo': true}">
    <div class="header-body">
        <div class="header-container container">
            <div class="header-row">
                <div class="header-column">
                    <div class="header-row">
                        <div class="header-logo">
                            <a href="{{ route('index') }}">
                                <img alt="Klipaa.com" width="68" height="75" data-sticky-width="45" data-sticky-height="45" data-sticky-top="105" src="{{ asset('img/logo.png') }}">
                            </a>
                        </div>
                        <div class="header-logo" style="margin-left: 20px">
                            <h3>
                                Desa
                                <strong>{{ $desa ? $desa->nama : '' }}</strong>
                                <small>{{ $desa->kecamatan->kab->nama }}</small>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="header-column justify-content-end">
                    <div class="header-row pt-3">
                        <nav class="header-nav-top">

                            <ul class="header-extra-info d-none d-md-flex align-items-center">
                                {{-- <li>
                                    <div class="feature-box feature-box-style-3 align-items-center">
                                        <div class="feature-box-icon">
                                            <i class="fa fa-users"></i>
                                        </div>
                                        <div class="feature-box-info">
                                            <h4 class="mb-0">{{ $desa ? '@'. $desa->pengurus->username : '' }}</h4>
                                            <p><small>Admin Desa</small></p>
                                        </div>
                                    </div>
                                </li> --}}
                                {{-- <li>
                                    <div class="feature-box feature-box-style-3 align-items-center">
                                        <div class="feature-box-icon">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                        <div class="feature-box-info">
                                            <h4 class="mb-0">{{ $desa ? $desa->email : '' }}</h4>
                                            <p><small>Email Desa</small></p>
                                        </div>
                                    </div>
                                </li> --}}
                                {{-- <li>
                                    <div class="header-search d-none d-md-block">
                                        <form id="searchForm" action="{{ route('index') }}" method="get">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="query" id="q" placeholder="Search..." required>
                                                <span class="input-group-btn">
                                                    <button class="btn btn-light" type="submit"><i class="fa fa-search"></i></button>
                                                </span>
                                            </div>
                                        </form>
                                    </div>
                                </li> --}}
                            </ul>

                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-nav-bar header-nav-bar-primary">
            <div class="header-container container">
                <div class="header-row">
                    <div class="header-column">
                        <div class="header-row">
                            <div class="header-nav justify-content-start">
                                <div class="header-nav-main header-nav-main-light header-nav-main-effect-1 header-nav-main-sub-effect-1">
                                    <nav class="collapse">
                                        {{-- @include('desa.sidebar') --}}
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="header-column justify-content-end">
                        <div class="header-row">
                            <ul class="header-social-icons social-icons d-none d-sm-block">
                                <li class="social-icons-facebook"><a href="{{ $desa ?  $desa->facebook : '#'}}" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                <li class="social-icons-twitter"><a href="{{ $desa ? $desa->twitter : '#' }}" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                <li class="social-icons-instagram"><a href="{{ $desa ? $desa->instagram : '#' }}" target="_blank" title="Linkedin"><i class="fa fa-instagram"></i></a></li>
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
