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

    <title>{{ config('app.name', 'Laravel') }} || @yield('title')</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body >

<div id="app">

    <nav class="navbar navbar-light bg-white navbar-expand-sm border-bottom shadow-sm fixed-top">
        <a class="navbar-brand" href="{{url('/')}}">
            <img src="{{url('/img/klipaa.png')}}" width="140px"  alt="Logo Klipa">

        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-list-8" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbar-list-8">
            <ul class="navbar-nav">

            </ul>

            <div class="right-side d-flex">
                <form class="form-inline">
                    <input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-info" type="submit"><i class="fas fa-newspaper-o mr-2"></i>Buat Story</button>
                </form>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/fox.jpg" width="40" height="40" class="rounded-circle">
                        </a>
                        <div class="dropdown-menu  dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">Dashboard</a>
                            <a class="dropdown-item" href="#">Edit Profile</a>
                            <a class="dropdown-item" href="#">Log Out</a>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
    <div class="header-spacer"></div>
    <main role="main" class="container ">
        @yield('content')


    </main>

</div>

<a class="back-to-top" href="#">
    <img src="svg-icons/back-to-top.svg" alt="arrow" class="back-icon">
</a>

<script src="{{asset('js/app.js')}}"></script>
@yield('script')
</body>
</html>
