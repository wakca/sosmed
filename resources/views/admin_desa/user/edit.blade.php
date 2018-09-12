<div class="card ">
    <div class="header">
        <h4 class="title">Edit User</h4>
    </div>
    <div class='content'>
        <div class="alert alert-danger print-error-msg" style="display:none">
            <ul></ul>
        </div>
        <form class="form-horizontal" id='postForm' role="form" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center">
                    <h5>Setting Profil
                    </h5>
                </div>
            </div>
            <div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
                <label for="photo" class="col-md-4 control-label">Photo</label>
                <div class="row">
                    <div class="col-xs-6 col-md-3">
                      <a href="#" class="thumbnail">
                        <img src="../../../photos/{{ isset($user->photo) ? $user->photo : 'av-default.jpg' }}" alt="Foto Profil">
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
                    <input id="name" type="text" class="form-control" name="name" value="{{old('name',$user->name) }}" required autofocus>

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
                        <option value='Laki-laki' {{ (old('jk',$user->jk) == 'Laki-laki'?'selected':'') }}>Laki-laki</option>
                        <option value='Perempuan' {{ (old('jk',$user->jk) == 'Perempuan'?'selected':'') }}>Perempuan</option>
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
                $tgl = $user->tgl_lahir;
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
                            <option value='{{ $prov->id }}' {{ (old('provinsi',$user->provinsi) == $prov->id?'selected':'') }}>{{ $prov->nama }}</option>
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
                    <textarea id="alamat" class="form-control" name="alamat" required>{{old('alamat',$user->alamat) }}</textarea>

                    @if ($errors->has('alamat'))
                        <span class="help-block">
                            <strong>{{ $errors->first('alamat') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center">
                    <h5>Setting Akun
                    </h5>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Username</label>

                <div class="col-md-6">
                    <input id="username" type="text" class="form-control" name="username" value="{{ $user->username }}" disabled>
                </div>
            </div>
                
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">E-Mail</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email',$user->email) }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">Password</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password">

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                    <small>Kosongkan password dan confirmasi password jika password tidak ingin diubah!</small>
                </div>
            </div>
                            
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                <div class="progress" style='display:none;'>
                        <div class="progress-bar progress-bar-striped active" role="progressbar" style="width: 0%;">
                          0%
                        </div>
                </div>
                    <button id='post' type="submit" class="btn btn-primary">
                        Update
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>       
@section('script')
    <script src="{{ asset('js/jquery.form.min.js') }}"></script>
    <script type="text/javascript">
        var num = 1;
        var progress = $('.progress');
        var bar = $('.progress-bar');
        var btnPost = $('#post');

        $(document).ready(function(){
            $prov = $("#provinsi");
            $kab = $("#kabupaten");
            $kec = $("#kecamatan");
            $desa = $("#desa");
            
            $oldprov = '{{ old('provinsi',$user->provinsi) }}';
            $oldkab = '{{ old('kabupaten',$user->kabupaten) }}';
            $oldkec = '{{ old('kecamatan',$user->kecamatan) }}';
            $olddesa = '{{ old('desa',$user->desa) }}';
            
            //if already selected
            if ($oldprov != '') {
                 $.ajax({
                     url:'../../../location/get-kab/'+$oldprov,
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
                     url:'../../../location/get-kec/'+$oldkab,
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
                     url:'../../../location/get-desa/'+$oldkec,
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
                         url:'../../../location/get-kab/'+$(this).val(),
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
                         url:'../../../location/get-kec/'+$(this).val(),
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
                         url:'../../../location/get-desa/'+$(this).val(),
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
           
             var options = {
                beforeSend: function() {
                    var percentVal = '0%';
                    progress.show();
                    bar.css('width',percentVal)
                    bar.html(percentVal);
                    btnPost.text('Menyimpan...');
                    btnPost.attr('disabled',true);
                },
                uploadProgress: function(event, position, total, percentComplete) {
                    var percentVal = percentComplete + '%';
                    bar.css('width',percentVal)
                    bar.html(percentVal);
                },
                success: function() {
                    var percentVal = '100%';
                    bar.css('width',percentVal)
                    bar.html(percentVal);
                },
                complete: function(response) 
                {
                    if($.isEmptyObject(response.responseJSON.error)){
                        window.location='{{ route('admin.user') }}';
                    }else{
                        progress.hide();
                        btnPost.text('Update');
                        btnPost.attr('disabled',false);
                        printErrorMsg(response.responseJSON.error);
                    }
                },
                clearForm: false,
                resetForm: false
            };
            
            $("#postForm").ajaxForm(options);
        });
          
            function printErrorMsg (msg) {
              $(".print-error-msg").find("ul").html('');
              $(".print-error-msg").css('display','block');
              $.each( msg, function( key, value ) {
                  $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
              });
            }
    </script>
@endsection