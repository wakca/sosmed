<h5 class="widget-title">

    Download APK SID</h5>
<a href="">
    <img src="https://www.androidhive.info/wp-content/uploads/2015/09/download-button-playstore.png" alt="Download APK" style="width: 100%"
        class="img-responsive">
</a>
<hr>

<h5 class="widget-title">Sambutan Kepala Desa</h5>

<img src="{{ $desa ? asset($desa->foto_kepdes)  : ''}}" style="width: 100%" class="img img-responsive" alt="Foto Kepala Desa {{ $desa ?  $desa->nama_kades : '' }}">
<center>
    <p>
        <strong>{{ $desa ? $desa->nama_kades : 'Tanpa Nama' }}</strong>
        <br>{{ $desa ? $desa->nip_kades ? $desa->nip_kades : '' : '' }}</p>
</center>
<a href="#" class="btn btn-primary btn-block btn-xs">Sambutan Kepala Desa</a>
<div class="clearfix" style="margin-top: 10px">
    <div class="pull-right">
    </div>
</div>
<hr>

<h5 class="widget-title">Peta Desa</h5>
@if($desa)
<iframe src="{{$desa->iframe ? $desa->iframe : 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15833.16637235431!2d107.77289472442763!3d-7.207537416744992!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68bb9e816644dd%3A0x3ac77ef8d1253e7!2sPasirwangi%2C+Garut+Regency%2C+West+Java!5e0!3m2!1sen!2sid!4v1521578091434'}}"
    width="100%" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
@endif


<hr>
