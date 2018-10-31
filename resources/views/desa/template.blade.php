
<!DOCTYPE html>
<html class="boxed">
    <head>

		<!-- Basic -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Beranda Desa {{ $desa ?  $desa->nama : '' }}</title>

		<meta name="keywords" content="{{ $desa ?  'Halaman Profil Desa'.$desa->nama : '' }} " />
		<meta name="description" content="{{ $desa ? 'Halaman Profil Desa '.$desa->nama : '' }}">
		@if($desa->foto_desa)
			<meta content="{{url('/storage/'.$desa->foto_desa)}}" property="og:image"/>
		@endif
		<meta name="author" content="{{ $desa ? $desa->nama : '' }}">

		<meta name="csrf-token" content="{{ csrf_token() }}">

		<!-- Favicon -->
        {{-- <link rel="shortcut icon" href="{{ $desa ? asset($desa->lambang) : '' }}" type="image/x-icon" /> --}}

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">

		<!-- Vendor CSS -->
        <link rel="stylesheet" href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ asset('frontend/vendor/font-awesome/css/font-awesome.min.css') }}">
		<link rel="stylesheet" href="{{ asset('frontend/vendor/animate/animate.min.css') }}">
		<link rel="stylesheet" href="{{ asset('frontend/vendor/simple-line-icons/css/simple-line-icons.min.css') }}">
		<link rel="stylesheet" href="{{ asset('frontend/vendor/owl.carousel/assets/owl.carousel.min.css') }}">
		<link rel="stylesheet" href="{{ asset('frontend/vendor/owl.carousel/assets/owl.theme.default.min.css') }}">
		<link rel="stylesheet" href="{{ asset('frontend/vendor/magnific-popup/magnific-popup.min.css') }}">

		<!-- Theme CSS -->
		<link rel="stylesheet" href="{{ asset('frontend/css/theme.css') }}">
		<link rel="stylesheet" href="{{ asset('frontend/css/theme-elements.css') }}">
		<link rel="stylesheet" href="{{ asset('frontend/css/theme-blog.css') }}">
		<link rel="stylesheet" href="{{ asset('frontend/css/theme-shop.css') }}">

		<!-- Current Page CSS -->
		<link rel="stylesheet" href="{{ asset('frontend/vendor/rs-plugin/css/settings.css') }}">
		<link rel="stylesheet" href="{{ asset('frontend/vendor/rs-plugin/css/layers.css') }}">
		<link rel="stylesheet" href="{{ asset('frontend/vendor/rs-plugin/css/navigation.css') }}">
		<link rel="stylesheet" href="{{ asset('frontend/vendor/circle-flip-slideshow/css/component.css') }}">


		<!-- Demo CSS -->


		<!-- Skin CSS -->
		<link rel="stylesheet" href="{{ asset('frontend/css/skins/default.css') }}">
		<link rel="stylesheet" href="{{ asset('frontend/css/sidebar.css') }}">

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">

		@yield('style')

		<!-- Head Libs -->
		<script src="{{ asset('frontend/vendor/modernizr/modernizr.min.js') }}"></script>

	</head>
	<body style="background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTxFOxaZ97dPDknLxKm_JDnpbQcMMl3VpnMF8HDgRbDl-ssFM7y')">
		<div class="body">
            @include('desa.header')
            <div role="main" class="main">

                {{--  <section class="page-header">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <ul class="breadcrumb">
                                    <li><a href="#">Home</a></li>
                                    <li class="active">Portfolio</li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h1>Right Sidebar</h1>
                            </div>
                        </div>
                    </div>
                </section>  --}}
                @yield('map')
                <div class="container">
					<div style="margin-top: 20px"></div>
                    @yield('content')
                    <hr>

					@include('desa.footer_content')

                </div>
            </div>
            @include('desa.footer')
        </div>

		<!-- Vendor -->
		<script src="{{ asset('frontend/vendor/jquery/jquery.min.js') }}"></script>
		<script src="{{ asset('frontend/vendor/jquery.appear/jquery.appear.min.js') }}"></script>
		<script src="{{ asset('frontend/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
		<script src="{{ asset('frontend/vendor/jquery-cookie/jquery-cookie.min.js') }}"></script>
		<script src="{{ asset('frontend/vendor/popper/umd/popper.min.js') }}"></script>
		<script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('frontend/vendor/common/common.min.js') }}"></script>
		<script src="{{ asset('frontend/vendor/jquery.validation/jquery.validation.min.js') }}"></script>
		<script src="{{ asset('frontend/vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.min.js') }}"></script>
		<script src="{{ asset('frontend/vendor/jquery.gmap/jquery.gmap.min.js') }}"></script>
		<script src="{{ asset('frontend/vendor/jquery.lazyload/jquery.lazyload.min.js') }}"></script>
		<script src="{{ asset('frontend/vendor/isotope/jquery.isotope.min.js') }}"></script>
		<script src="{{ asset('frontend/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
		<script src="{{ asset('frontend/vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
		<script src="{{ asset('frontend/vendor/vide/vide.min.js') }}"></script>

		<!-- Theme Base, Components and Settings -->
		<script src="{{ asset('frontend/js/theme.js') }}"></script>

		<!-- Current Page Vendor and Views -->
		<script src="{{ asset('frontend/vendor/rs-plugin/js/jquery.themepunch.tools.min.js') }}"></script>
		<script src="{{ asset('frontend/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script>
		<script src="{{ asset('frontend/vendor/circle-flip-slideshow/js/jquery.flipshow.min.js') }}"></script>
		<script src="{{ asset('frontend/js/views/view.home.js') }}"></script>


		<!-- Theme Custom -->
		<script src="{{ asset('frontend/js/custom.js') }}"></script>

		<!-- Theme Initialization Files -->
		<script src="{{ asset('frontend/js/theme.init.js') }}"></script>

		<!-- Examples -->
		<script src="{{ asset('frontend/js/examples/examples.demos.js') }}"></script>

		<!-- Google Analytics: Change UA-XXXXX-X to be your site's ID. Go to http://www.google.com/analytics/ for more information.
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-12345678-1', 'auto');
			ga('send', 'pageview');
		</script>
		 -->

		 <script type="text/javascript">
			 var url_web = "{{urlencode(url()->current())}}";
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

			function shareWhatsApp()
			{
				event.preventDefault();
				console.log('share Whatsapp');
				window.open('https://wa.me/?text='+url_web, 'newwindow','width=800,height=600');
                return false;
			}


		</script>

		  <!-- Kirim Pesan -->
		<script>
			$( "#kirim_pesan" ).submit(function( event ) {
				event.preventDefault();
				
				var data = $("#kirim_pesan").serialize();;

				console.log(data);

				$.post('/profil_desa/{{ $desa->id }}/kirim_pesan', function( data ) {
					console.log(data);
				});
			});

			$( "#form_login" ).submit(function( event ) {
				event.preventDefault();
				
				var data = $("#form_login").serialize();;

				console.log(data)

				$.post('/profil_desa/{{ $desa->id }}/kirim_pesan', function( data ) {
					console.log(data);
				});
			});
			$(document).ready(function(){
                $('p img').css('width', '100%');
                $('h3 img').css('width', '100%');

                $('table').css({'width': '100%', 'border-collapse': 'collapse', 'overflow' : 'auto'});
				$('table').addClass('table-responsive');
				
			});
		</script>
		<!-- End of Kirim Pesan -->

		@yield('script')

	</body>
</html>
