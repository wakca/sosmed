@extends('desa.template')
@section('title')
Peta Desa {{ $desa->nama }}
@endsection

@section('content')

    <div role="main" class="main">

        <section class="page-header">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <ul class="breadcrumb">
                            <li><a href="{{route('profil_desa.beranda', $desa->id)}}">Beranda</a></li>
                            <li class="active">Hubungi Kami</li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h1>Hubungi Kami</h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Google Maps - Go to the bottom of the page to change settings and map location. -->
        <iframe src="{{$desa->map ? $desa->map : 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7917.4656460095275!2d107.99719067238848!3d-7.156857284053712!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68b4809110030f%3A0xb5572e5e13bafde2!2sSukarasa%2C+Pangatikan%2C+Kabupaten+Garut%2C+Jawa+Barat!5e0!3m2!1sid!2sid!4v1536908164691'}}" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>

        <div class="container">

            <div class="row">
                <div class="col-lg-6">

                    <div class="alert alert-success d-none mt-4" id="contactSuccess">
                        <strong>Success!</strong> Your message has been sent to us.
                    </div>

                    <div class="alert alert-danger d-none mt-4" id="contactError">
                        <strong>Error!</strong> There was an error sending your message.
                        <span class="text-1 mt-2 d-block" id="mailErrorMessage"></span>
                    </div>

                    <h2 class="mb-3 mt-2"><strong>Hubungi </strong> Kami</h2>
                    @if(session()->has('sukses'))
                        <div class="alert alert-primary">
                            {{session('sukses')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <form id="contactForm" action="{{route('profil_desa.simpan_kontak', $desa->id)}}" method="POST">
                        {{csrf_field()}}
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label>Nama Lengkap *</label>
                                <input type="text" value="" data-msg-required="Please enter your name." maxlength="100" class="form-control" name="nama_lengkap" id="nama_lengkap" required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Email *</label>
                                <input type="email" value="" data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." maxlength="100" class="form-control" name="email" id="email" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label>Subjek</label>
                                <input type="text" value="" data-msg-required="Please enter the subject." maxlength="100" class="form-control" name="subjek" id="subjek" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label>Pesan *</label>
                                <textarea maxlength="5000" data-msg-required="Please enter your message." rows="10" class="form-control" name="pesan" id="pesan" required></textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <input type="submit" class="btn btn-primary btn-lg" data-loading-text="Loading...">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6">

                    <h4 class="heading-primary mt-4">Perhatian!</h4>
                    <p>Siapapun di klipaa mudah mengirim pesan langsung kepada desa / kelurahan juga pesan pada warga desa anda. Ayo buat akun klipaa  agar anda otomatis terhubung secara online dengan semua warga desa anda, anda juga bisa mengisi produk unggulan dan cerita desa/kelurahan anda sendiri.
                        <a href="{{route('register')}}">Klik disini</a> untuk mendaftar cepat.</p>

                    <hr>

                    <h4 class="heading-primary">Alamat <strong>Desa</strong></h4>
                    <ul class="list list-icons list-icons-style-3 mt-4">
                        <li><i class="fa fa-map-marker"></i> <strong>Alamat:</strong> Desa/Kelurahan {{$desa->nama}}, Kecamatan {{$desa->kecamatan->nama}}, Kabupaten/Kota {{$desa->kecamatan->kab->nama}} - {{$desa->kecamatan->kab->prov->nama}}</li>
                    </ul>

                </div>

            </div>

        </div>

    </div>



@endsection

@section('sidebar_peta')

@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

@endsection

@section('scripts')


@endsection