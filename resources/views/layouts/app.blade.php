<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Berita Desa, Berita Desa Hari Ini, Berita Harian Desa, Berita Desa Terbaru, Berita Desa Akurat, Berita Desa Terpercaya, Kabar Desa, Berita Desa Terpopuler, Berita, Info Desa Terkini, Klip, Klipaa, klipa, Berita Hari Ini">
    <meta name="description" content="Penyedia Data dan Info Desa/Kelurahan dari Seluruh Indonesia">
@yield('meta_og')

<!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-62900800-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-62900800-2');
    </script>

    <!-- Google Analytics -->
    <script>
        window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
        ga('create', 'UA-62900800-2', 'auto');
        ga('send', 'pageview');
    </script>
    <script async src='https://www.google-analytics.com/analytics.js'></script>
    <!-- End Google Analytics -->

    <link rel="canonical" href="{{ app('url')->current() }}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title'){{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

@yield('css')
<!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
<div id="app">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('img/klipaa.png') }}" alt="Logo Klipaa.com" style="width: 150px">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    @if (Auth::guest())
                        <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Beranda</a></li>
                        <li class="nav-item"><a class="nav-link" href='/desa'>Kanal Desa <span id='message'></span></a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Daftar</a></li>
                    @else
                        <li class="nav-item"><a class="nav-link" href='/beranda'>Beranda</a></li>
                        <li class="nav-item"><a class="nav-link" href='/story'>Story</a></li>
                        <li class="nav-item"><a class="nav-link" href='/notifications'>Pemberitahuan <span id='notif'></span></a></li>
                        <li class="nav-item"><a class="nav-link" href='/messages'>Pesan <span id='message'></span></a></li>
                        <li class="nav-item"><a class="nav-link" href='/desa'>Kanal Desa <span id='message'></span></a></li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" href="#" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class='glyphicon glyphicon-user'></i> {{ isset(Auth::user()->name)?Auth::user()->name : Auth::user()->username }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdown05">
                                {!! Auth::user()->level == 3 ?"<a class='dropdown-item' href='/admin/dashboard'>Halaman Administrator</a>":"" !!}
                                {!! Auth::user()->level == 2 ?"<a class='dropdown-item' href='/admin_desa/dashboard'>Halaman Admin Desa</a>":"" !!}
                                <a class="dropdown-item" href="/{{ Auth::user()->username }}">My Profile</a>
                                @if(Auth::user()->des)
                                    <a class="dropdown-item" href="/profil_desa/{{ Auth::user()->des->id }}/beranda" target="_blank">Masuk ke Desa/Kelurahan {{Auth::user()->des->nama}}</a>
                                @endif
                                <a class="dropdown-item" href='/account-setting'>Pengaturan Akun</a>
                                <li  role="separator" class="dropdown-divider"></li>

                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>


                            </div>
                        </li>

                    @endif
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
                </ul>
            </div>
        </div>
    </nav>
    <div class='margin-separator'></div>
    @if(Auth::check())
        @if(Getter::checkDetail(Auth::user()))
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-xl-12 col-xs-12">
                        <div class="alert alert-danger" role="alert">
                            Anda Belum Mengisi Data Profil Lengkap <a href="{{route('profile.edit')}}">Silahkan isi Data</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif

    @yield('content')
    <div class='footer-page'>
        <div class='container center-text'>
            <ul class="nav nav-pills">
                <li><a href="{{ route('tentang') }}">Tentang</a></li>
                <li><a href="{{ route('syarat_ketentuan') }}">S & K</a></li>
                <li><a href="{{ route('partner') }}">Partner</a></li>
                <li><a href="{{ route('kontak') }}">Kontak</a></li>

            </ul>
        </div>
    </div>
</div>
<!-- Scripts -->

<script
        src="https://code.jquery.com/jquery-1.12.4.min.js"
        integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
        crossorigin="anonymous"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/ekko-lightbox.min.js') }}"></script>
<script src="{{ asset('js/URI.min.js') }}"></script>

@yield('js')

@yield('script')

@yield('script2')

@if(Auth::check())
    <script type='text/javascript'>
        function getLinks(text) {
            var result = URI.withinString(text, function(url) {
                var uri = new URI(url);
                var prot = uri.protocol();
                console.log(prot);
                if (prot == '') {
                    prot = 'http://'
                }
                else{
                    prot = '';
                }
                return "<a href='"+prot+uri+"' rel='nofollow'>" + url + "</a>";
            });
            return result;
        }
        // window.setInterval(getNumNotif, 1100);
        // function getNumNotif() {
        //     $("#notif").load('/notifications/count','fast');
        //     $("#message").load('/messages/count','fast');
        //     $("#message").load('/messages/group/count','fast');
        //     $("#notif-icon").load('/notifications/count','fast');
        //     $("#message-icon").load('/messages/count','fast');
        // }
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox();
        });
    </script>
@endif
</body>
</html>
