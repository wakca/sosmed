@extends('layouts.app')
@section('title','Edit Profile Anda | ')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Profile</div>
                <div class="panel-body">
                    @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </p>
                    @endif
                    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ route('profile.update') }}">
                        {{ csrf_field() }}
                        
                        <div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
                            <label for="photo" class="col-md-4 control-label">Photo</label>
                            <div class="row">
                                <div class="col-xs-6 col-md-3">
                                  <a href="#" class="thumbnail">
                                    <img src="/photos/{{ isset($profil->photo) ? $profil->photo : 'av-default.jpg' }}" alt="Foto Profil">
                                  </a>
                                </div>
                            </div>
                            <label for="" class="col-md-4 control-label"></label>    
                            <div class="col-md-6">
                                <input id="photo" type="file" class="form-control" name="photo">

                                @if ($errors->has('photo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nama Lengkap</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{old('name',$profil->name) }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                            
                        <div class="form-group{{ $errors->has('jk') ? ' has-error' : '' }}">
                            <label for="jk" class="col-md-4 control-label">Jenis Kelamin</label>

                            <div class="col-md-6">
                                <select name='jk' id='jk' class='form-control' required>
                                    <option value=''>Pilih</option>
                                    <option value='Laki-laki' {{ (old('jk',$profil->jk) == 'Laki-laki'?'selected':'') }}>Laki-laki</option>
                                    <option value='Perempuan' {{ (old('jk',$profil->jk) == 'Perempuan'?'selected':'') }}>Perempuan</option>
                                </select>
                                    
                                @if ($errors->has('jk'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('jk') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                            
                        <div class="form-group{{ $errors->has('tgl') ? ' has-error' : '' }}">
                            <label for="tanggal_lahir" class="col-md-4 control-label">Tanggal Lahir</label>
                            @php
                            $tgl = $profil->tgl_lahir;
                            $tanggal = substr($tgl,8,2);
                            $bulan   = substr($tgl,5,2);
                            $tahun   = substr($tgl,0,4);
                            @endphp
                            <div class="col-md-6">
                                <select name='tgl' id='tgl' class="form-control" style='width:auto;display:inline;' required>
                                    <option value=''>Tanggal</option>
                                    @for($i = 01;$i <= 31;$i++)
                                        <option value='{{ $i }}' {{ (old('tgl',$tanggal) == $i?'selected':'') }}>{{ $i }}</option>
                                    @endfor
                                </select>
                                    
                                <select name='bln' id='bln' class="form-control" style='width:auto;display:inline;' required>
                                    <option value=''>Bulan</option>
                                    @for($i = 1;$i <= 12;$i++)
                                        <option value='{{ $i }}' {{ (old('bln',$bulan) == $i?'selected':'') }}>{{ IndoTgl::bulanIndo($i) }}</option>
                                    @endfor
                                </select>
                                
                                <select name='thn' id='thn' class="form-control" style='width:auto;display:inline;' required>
                                    <option value=''>Tahun</option>
                                    @for($i = date('Y');$i >= 1960;$i--)
                                        <option value='{{ $i }}' {{ (old('thn',$tahun) == $i?'selected':'') }}>{{ $i }}</option>
                                    @endfor
                                </select>
                                @if ($errors->has('tgl'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tgl') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                                                       
                        <div class="form-group{{ $errors->has('provinsi') ? ' has-error' : '' }}">
                            <label for="provinsi" class="col-md-4 control-label">Provinsi</label>

                            <div class="col-md-6">
                                <select name='provinsi' id='provinsi' class='form-control' required>
                                    <option value=''>Pilih</option>
                                    @foreach($provinsi as $prov)
                                        <option value='{{ $prov->id }}' {{ (old('provinsi',$profil->provinsi) == $prov->id?'selected':'') }}>{{ $prov->nama }}</option>
                                    @endforeach
                                </select>
                                    
                                @if ($errors->has('provinsi'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('provinsi') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                            
                        <div class="form-group{{ $errors->has('kabupaten') ? ' has-error' : '' }}">
                            <label for="kabupaten" class="col-md-4 control-label">Kabupaten/Kota</label>

                            <div class="col-md-6">
                                <select name='kabupaten' id='kabupaten' class='form-control' required>
                                    <option value=''>Pilih</option>
                                </select>
                                @if ($errors->has('kabupaten'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('kabupaten') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                            
                        <div class="form-group{{ $errors->has('kecamatan') ? ' has-error' : '' }}">
                            <label for="kecamatan" class="col-md-4 control-label">Kecamatan</label>

                            <div class="col-md-6">
                                <select name='kecamatan' id='kecamatan' class='form-control' required>
                                    <option value=''>Pilih</option>
                                </select>
                                @if ($errors->has('kecamatan'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('kecamatan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                            
                        <div class="form-group{{ $errors->has('desa') ? ' has-error' : '' }}">
                            <label for="desa" class="col-md-4 control-label">Desa/Kelurahan</label>

                            <div class="col-md-6">
                                <select name='desa' id='desa' class='form-control' required>
                                    <option value=''>Pilih</option>
                                </select>
                                @if ($errors->has('desa'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('desa') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                            
                        <div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Alamat</label>

                            <div class="col-md-6">
                                <textarea id="alamat" class="form-control" name="alamat" required>{{old('alamat',$profil->alamat) }}</textarea>

                                @if ($errors->has('alamat'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('alamat') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script type='text/javascript'>
        $(document).ready(function(){
           $prov = $("#provinsi");
           $kab = $("#kabupaten");
           $kec = $("#kecamatan");
           $desa = $("#desa");
           
           $oldprov = '{{ old('provinsi',$profil->provinsi) }}';
           $oldkab = '{{ old('kabupaten',$profil->kabupaten) }}';
           $oldkec = '{{ old('kecamatan',$profil->kecamatan) }}';
           $olddesa = '{{ old('desa',$profil->desa) }}';
           
           //if already selected
           if ($oldprov != '') {
                $.ajax({
                    url:'/location/get-kab/'+$oldprov,
                    type:'GET',
                    dataType:'json',
                    success:function(data){
                       $kab.html('<option value=\'\'>Pilih</option>');
                       $.each(data,function(i,data){
                            $kab.append('<option value='+data.id+' '+($oldkab == data.id?'selected':'')+'>'+data.nama+'</option>');
                       });
                    }
                });
           }
            
           if ($oldkab != '') {
                $.ajax({
                    url:'/location/get-kec/'+$oldkab,
                    type:'GET',
                    dataType:'json',
                    success:function(data){
                       $kec.html('<option value=\'\'>Pilih</option>');
                       $.each(data,function(i,data){
                            $kec.append('<option value='+data.id+' '+($oldkec == data.id?'selected':'')+'>'+data.nama+'</option>');
                       });
                    }
                });
            }
            
            if ($oldkec != '') {
                $.ajax({
                    url:'/location/get-desa/'+$oldkec,
                    type:'GET',
                    dataType:'json',
                    success:function(data){
                       $desa.html('<option value=\'\'>Pilih</option>');
                       $.each(data,function(i,data){
                            $desa.append('<option value='+data.id+' '+($olddesa == data.id?'selected':'')+'>'+data.nama+'</option>');
                       });
                    }
                });
            }
            
            //onchange
           $prov.change(function(){
                if ($(this).val() != '') {
                    $.ajax({
                        url:'/location/get-kab/'+$(this).val(),
                        type:'GET',
                        dataType:'json',
                        success:function(data){
                           $kab.html('<option value=\'\'>Pilih</option>');
                           $.each(data,function(i,data){
                                $kab.append('<option value='+data.id+'>'+data.nama+'</option>');
                           });
                        }
                    });
                }
                else{
                    $kab.html('<option value=\'\'>Pilih</option>');
                    $kec.html('<option value=\'\'>Pilih</option>');
                    $desa.html('<option value=\'\'>Pilih</option>');
                }
           });
           
           $kab.change(function(){
                if ($(this).val() != '') {
                    $.ajax({
                        url:'/location/get-kec/'+$(this).val(),
                        type:'GET',
                        dataType:'json',
                        success:function(data){
                           $kec.html('<option value=\'\'>Pilih</option>');
                           $.each(data,function(i,data){
                                $kec.append('<option value='+data.id+'>'+data.nama+'</option>');
                           });
                        }
                    });
                }
                else{
                    $kec.html('<option value=\'\'>Pilih</option>');
                    $desa.html('<option value=\'\'>Pilih</option>');
                }
           });
           
           $kec.change(function(){
                if ($(this).val() != '') {
                    $.ajax({
                        url:'/location/get-desa/'+$(this).val(),
                        type:'GET',
                        dataType:'json',
                        success:function(data){
                           $desa.html('<option value=\'\'>Pilih</option>');
                           $.each(data,function(i,data){
                                $desa.append('<option value='+data.id+'>'+data.nama+'</option>');
                           });
                        }
                    });
                }
                else{
                    $desa.html('<option value=\'\'>Pilih</option>');
                }
           });
        });
    </script>
@endsection