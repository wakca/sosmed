<?php header('Access-Control-Allow-Origin: *'); ?>
<!DOCTYPE html>
<!-- Template by Quackit.com -->
<html lang="en">
<head>

    <?php
        
    ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>@yield('title')</title>

    <!-- Bootstrap Core CSS -->
    <link href="https://bootswatch.com/3/cosmo/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS: You can use this stylesheet to override any Bootstrap styles and/or apply your own styles -->
    <link href="{!! asset('css/custom.css') !!}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" id="color"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style media="screen">
        .btn-circle {
            width: 30px;
            height: 30px;
            text-align: center;
            padding: 6px 0;
            font-size: 12px;
            line-height: 1.428571429;
            border-radius: 15px;
        }
        .btn-circle.btn-lg {
            width: 50px;
            height: 50px;
            padding: 10px 16px;
            font-size: 18px;
            line-height: 1.33;
            border-radius: 25px;
        }
        .btn-circle.btn-xl {
            width: 70px;
            height: 70px;
            padding: 10px 16px;
            font-size: 24px;
            line-height: 1.33;
            border-radius: 35px;
        }

    </style>

    @yield('styles')

</head>

<body >

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Logo and responsive toggle -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">@yield('title')</a>
            </div>
            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav">
                    @if($desa)
                        <li @if(Request::segment(3) == 'beranda') class="active" @endif>
                            <a href="{{ route('profil_desa.beranda', $desa->id) }}">Profil</a>
                        </li>
                        <li @if(Request::segment(3) == 'berita') class="active" @endif>
                                <a href="{{ route('profil_desa.peta', $desa->id) }}">Berita</a>
                            </li>
                        <li @if(Request::segment(3) == 'peta') class="active" @endif>
                            <a href="{{ route('profil_desa.peta', $desa->id) }}">Peta</a>
                        </li>
                        <li @if(Request::segment(3) == 'produk') class="active" @endif>
                            <a href="{{ route('profil_desa.produk', $desa->id) }}">Produk Unggulan</a>
                        </li>
                        <li @if(Request::segment(3) == 'story') class="active" @endif>
                            <a href="{{ route('profil_desa.story', $desa->id) }}">Story</a>
                        </li>
                        <li class="pull-right">
                            <a href="/">Beranda Klipaa</a>
                        </li>
                    @endif
                    
                </ul>

                <!-- Search -->
				<form class="navbar-form navbar-right" method="GET" action="/" role="search">
					<div class="form-group">
						<input type="text" name="query" class="form-control">
					</div>
					<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span> Search</button>
				</form>

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <div style="margin-top:50px"></div>

    <div class="container">
        <div class="row">

            <div class="col-md-8 col-xs-12">
                @yield('content')
            </div>
    
            <div class="col-md-4 col-xs-12">
                @yield('sidebar_peta')
                @if($desa)
                <h2>
                    Informasi Desa
                </h2>
                <ul class="list-group">
                    <li class="list-group-item"><a href="javascript:void(0);" id="selayang_pandang">Selayang Pandang</a></li>
                    <li class="list-group-item"><a href="javascript:void(0);" id="produk_unggulan">Produk Unggulan</a></li>
                    <li class="list-group-item"><a href="javascript:void(0);" id="profil_desa">Profil Desa</a></li>
                    <li class="list-group-item"><a href="javascript:void(0);" id="kabar_desa">Kabar Desa</a></li>
                    <li class="list-group-item"><a href="javascript:void(0);" id="proyek_desa">Data Proyek</a></li>
                    <li class="list-group-item"><a href="javascript:void(0);" id="galeri_desa">Galeri Desa</a></li>
                    <li class="list-group-item"><a href="javascript:void(0);" id="organisasi_desa">Organisasi Desa</a></li>
                    <li class="list-group-item"><a href="javascript:void(0);" id="dokumen_desa">Dokumen Desa</a></li>
                </ul>
                @endif
            </div>
        </div>
    </div>


	{{-- <footer>
		<div class="footer-blurb">
			<div class="container">
				<div class="row">
					<div class="col-sm-3 footer-blurb-item">
						<h3><span class="glyphicon glyphicon-text-size"></span> Dynamic</h3>
						<p>Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits. Dramatically visualize customer directed convergence without revolutionary ROI.</p>
						<p><a class="btn btn-default" href="#">Procrastinate</a></p>
					</div>
					<div class="col-sm-3 footer-blurb-item">
						<h3><span class="glyphicon glyphicon-wrench"></span> Efficient</h3>
						<p>Dramatically maintain clicks-and-mortar solutions without functional solutions. Efficiently unleash cross-media information without cross-media value. Quickly maximize timely deliverables for real-time schemas. </p>
						<p><a class="btn btn-default" href="#">Unleash</a></p>
					</div>
					<div class="col-sm-3 footer-blurb-item">
						<h3><span class="glyphicon glyphicon-paperclip"></span> Complete</h3>
						<p>Professionally cultivate one-to-one customer service with robust ideas. Completely synergize resource taxing relationships via premier niche markets. Dynamically innovate resource-leveling customer service for state of the art customer service.</p>
						<p><a class="btn btn-default" href="#">Complete</a></p>
					</div>
					<div class="col-sm-3 footer-blurb-item">

						<!-- Thumbnails -->
						<h3><span class="glyphicon glyphicon-camera"></span> Phosfluorescent</h3>
							<div class="row">
								<div class="col-xs-6">
									<a href="#" class="thumbnail">
										<img src="#" alt="">
									</a>
								</div>
								<div class="col-xs-6">
									<a href="#" class="thumbnail">
										<img src="#" alt="">
									</a>
								</div>
								<div class="col-xs-6">
									<a href="#" class="thumbnail">
										<img src="#" alt="">
									</a>
								</div>
								<div class="col-xs-6">
									<a href="#" class="thumbnail">
										<img src="#" alt="">
									</a>
								</div>
							</div>

					</div>

				</div>
				<!-- /.row -->
			</div>
        </div>

        <div class="small-print footer-bottom">
        	<div class="container">
                <div class="row">

    			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

    				<div class="copyright">

    					© 2018, Sistem Informasi Desa

    				</div>

    			</div>

    			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

    				<div class="design">

    					 <a target="_blank" href="http://www.webenlance.com">Made with <i class="fa fa-heart fa-lg"></i> in Garut</a>

    				</div>

    			</div>
        	</div>
        </div>
	</footer> --}}


    <!-- jQuery -->
    <script src="{!! asset('js/jquery-1.11.3.min.js') !!}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{!! asset('js/bootstrap.min.js') !!}"></script>

    <script src="{!! asset('js/sosmed_share.min.js') !!}"></script>

    <!--Social Links -->
    <script type="text/javascript">
        function shareFb(url)
        {
            window.open('https://www.facebook.com/sharer/sharer.php?u=' + url , 'newwindow','width=800,height=600');
            return false;
        }

        function shareTwitter(text, url)
        {
            window.open('https://twitter.com/intent/tweet?text='+ text +'&amp;url=' + url , 'newwindow','width=800,height=600');
            return false;
        }

    </script>

    @yield('scripts')

</body>

</html>
