<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Media Digital Warga">
    <meta content='Klipaa.com' property='og:site_name'/>
    <meta content='website' property='og:type'/>
    <meta content="{{ asset('img/logo.png') }}" property="og:image"/>
    <meta content="@yield('title'){{ config('app.name', 'Laravel') }}" property='og:title'/>
    <meta content='{{ app('url')->current() }}' property='og:url'/>
    <meta content='Menghubungkan tetangga dan sahabat' property='og:description'/>
    <link rel="canonical" href="{{ app('url')->current() }}" />
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title'){{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-glyphicons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/ekko-lightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
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
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    @if (Auth::guest())
                        <ul class="nav nav-pills navbar-toggle collapsed">
                            <!-- Authentication Links -->
                            
                            <li><a href='/desa'>Kanal Desa <span id='message'></span></a></li>
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Daftar</a></li>
                        </ul>
                    @else
                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span id='notif-icon' class='collapsed'></span>
                        <span id='message-icon' class='collapsed'></span>
                    </button>
                    @endif
                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>
                
                <div class="collapse navbar-collapse" id="app-navbar-collapse">

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                        
                            <li><a href='/desa'>Kanal Desa <span id='message'></span></a></li>
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Daftar</a></li>
                        @else
                            <li><a href='/beranda'>Beranda</a></li>
                            <li><a href='/story'>Story</a></li>
                            <li><a href='/notifications'>Pemberitahuan <span id='notif'></span></a></li>
                            <li><a href='/messages'>Pesan <span id='message'></span></a></li>
                            <li><a href='/desa'>Kanal Desa <span id='message'></span></a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <i class='glyphicon glyphicon-user'></i> {{ isset(Auth::user()->name)?Auth::user()->name : Auth::user()->username }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    {!! Auth::user()->level == 3 ?"<li><a href='/admin/dashboard'>Halaman Administrator</a></li>":"" !!}
                                    {!! Auth::user()->level == 2 ?"<li><a href='/admin_desa/dashboard'>Halaman Admin Desa</a></li>":"" !!}
                                    <li><a href="/{{ Auth::user()->username }}">My Profile</a></li>
                                    <li><a href='/account-setting'>Pengaturan Akun</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                    @if(!Auth::guest())
                    <form class="navbar-form navbar-right" method='GET' action='/search'>
                        {{ csrf_field() }}
                       <div class="input-group">
                        <input type="text" class="form-control" name='keyword' placeholder="Cari Seseorang ?" required>
                        <span class="input-group-btn">
                          <button class="btn btn-default" type="submit"><span class='glyphicon glyphicon-search'></span></button>
                        </span>
                      </div><!-- /input-group -->
                    </form>
                    @endif
                </div>
            </div>
        </nav>
        <div class='margin-separator'></div>
        @yield('content')
        <div class='footer-page'>
        <div class='container center-text'>
            <ul class="nav nav-pills">
                <li><a href="#">Tentang</a></li>
                <li><a href="#">S & K</a></li>
                <li><a href="#">Partner</a></li>
                <li><a href="#">Kontak</a></li>
            </ul>
        </div>
        </div>
    </div>
    <!-- Scripts -->
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
        window.setInterval(getNumNotif, 1100);
        function getNumNotif() {
            $("#notif").load('/notifications/count','fast');
            $("#message").load('/messages/count','fast');
            $("#message").load('/messages/group/count','fast');
            $("#notif-icon").load('/notifications/count','fast');
            $("#message-icon").load('/messages/count','fast');
        }
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox();
        });
    </script>
    @endif
</body>
</html>
