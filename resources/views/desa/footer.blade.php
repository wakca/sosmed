<footer class="short" id="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h4>Tentang Klipaa</h4>
                <p>klipaa adalah layanan instan untuk web desa dan kelurahan di Indonesia..</p>
                <hr class="light">
            </div>
            <div class="col-lg-3 col-lg-offset-1">
                <h5 class="mb-2">Kontak Desa</h5>
                <span class="phone">{{ $desa ?  $desa->telepon : ''}}</span>
                <ul class="list list-icons list-icons-sm">
                    <li><i class="fa fa-envelope"></i> <a href="mailto:{{ $desa ? $desa->email : '' }}">{{ $desa ? $desa->email : '' }}</a></li>
                    <li><i class="fa fa-commenting"></i> <a href="#"> Kritik & Saran</a></li>
                </ul>
                <ul class="social-icons">
                    <li class="social-icons-facebook"><a href="{{ $desa ? $desa->facebook : '' }}" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                    <li class="social-icons-twitter"><a href="{{ $desa ? $desa->twitter : '' }}" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                    <li class="social-icons-instagram"><a href="{{ $desa ? $desa->instagram : ''}}" target="_blank" title="Instagram"><i class="fa fa-instagram"></i></a></li>
                </ul>
                <hr>
                <ul class="list list-icons list-icons-sm">
                    <li><i class="fa fa-key"></i> <a href="{{ route('admin.dashboard') }}"> Login Administrator</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-11">
                    <p>
                        © Copyright {{ date('Y') }}. All Rights Reserved.
                        <div class="pull-right">

                        </div>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
