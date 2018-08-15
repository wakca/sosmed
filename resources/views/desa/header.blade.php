<header id="header" class="header-no-border-bottom" data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyStartAt': 113, 'stickySetTop': '-113px', 'stickyChangeLogo': true}">
    <div class="header-body">
        <div class="header-container container">
            <div class="header-row">
                <div class="header-column">
                    <div class="header-row">
                        <div class="header-logo">
                            <a href="{{ route('index') }}">
                                <img alt="Klipaa.com" width="69" height="75" data-sticky-width="45" data-sticky-height="45" data-sticky-top="105" src="{{ asset('img/logo.png') }}">
                            </a>
                        </div>
                        <div width="140" height="75" style="margin-left: 20px; margin-top: 20px">
                            <h3>
                                Desa <strong>{{ $desa ? $desa->nama : '' }}</strong><br/>
                                <small>{{ $desa->kecamatan->nama }}</small><br/>
                                <small>{{ $desa->kecamatan->kab->nama }}</small>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="header-column justify-content-end">
                    <div class="header-row pt-3">
                        <nav class="header-nav-top">

                            <ul class="header-extra-info d-none d-md-flex align-items-center">
                                <li>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                        Kirim Pesan ke Admin Desa
                                    </button>
                                </li>

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
                                        @include('desa.navbar')
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Masukan Pesan Anda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <textarea name="pesan" id="pesan" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
