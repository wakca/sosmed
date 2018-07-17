<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Coming Soon - Start Bootstrap Theme</title>

    <!-- Bootstrap core CSS -->
    <link href="https://blackrockdigital.github.io/startbootstrap-coming-soon/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Merriweather:300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
    <link href="https://blackrockdigital.github.io/startbootstrap-coming-soon/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://blackrockdigital.github.io/startbootstrap-coming-soon/css/coming-soon.min.css" rel="stylesheet">

    <style>
        .image {
            height: inherit;
            width: 100%;
        }
    </style>
</head>

<body>

    <div class="overlay">
        <img src="https://4.bp.blogspot.com/-CZB7Wfs5-PQ/WGOpDZC6OYI/AAAAAAAAAiM/EVdqw_nfT_48INJ1ADRSzUGMkDvcsLxlQCLcB/s1600/019.jpg"
            class="image">

    </div>

    <div class="masthead">
        <div class="masthead-bg"></div>
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-12 my-auto">
                    <div class="masthead-content text-white py-5 py-md-0">
                        <h1 class="mb-3">
                            <small>Selamat Datang di </small>WAKCA</h1>
                        <p class="mb-5">
                            Wakca adalah ...
                        </p>
                        <div class="input-group input-group-newsletter">
                            <input type="email" class="form-control" onkeyup="suggest(this.value);" placeholder="Cari Desa Anda" aria-label="Enter email..."
                                aria-describedby="basic-addon">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="button">Buka</button>
                            </div>
                        </div>
                        <div id="suggest"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="social-icons">
        <ul class="list-unstyled text-center mb-0">
            <li class="list-unstyled-item">
                <a href="#">
                    <i class="fa fa-twitter"></i>
                </a>
            </li>
            <li class="list-unstyled-item">
                <a href="#">
                    <i class="fa fa-facebook"></i>
                </a>
            </li>
            <li class="list-unstyled-item">
                <a href="#">
                    <i class="fa fa-instagram"></i>
                </a>
            </li>
        </ul>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="https://blackrockdigital.github.io/startbootstrap-coming-soon/vendor/jquery/jquery.min.js"></script>
    <script src="https://blackrockdigital.github.io/startbootstrap-coming-soon/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="https://blackrockdigital.github.io/startbootstrap-coming-soon/js/coming-soon.min.js"></script>


    <script>
        function suggest(src) {
            var page = 'suggest.php';
            if (src.length >= 4) {
                var loading = '<p align="center">Loading ...</p>';
                console.log(loading);

                $('#suggest').html(loading);

                $.ajax({
                    type: "GET",
                    url: "{{ route('desa.suggest') }}",
                    data: {
                        "src": src,
                    },
                    cache: true,
                    success: function (response) {
                        $('#suggest').html(data.src);
                    }

                });

            }
            return false;
        }

        //Fungsi untuk memilih kota dan memasukkannya pada input text


        //menyembunyikan form
        function hideStuff(id) {
            document.getElementById(id).style.display = 'none';
        }
    </script>

</body>

</html>