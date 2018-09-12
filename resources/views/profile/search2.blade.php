<div class='panel panel-default'>
    <div class='panel-heading'><span class='glyphicon glyphicon-search'></span> Filter Pencarian</div>
    <div class='panel-body'>
        <form method='GET' action='/advanced-search'>
             {{ csrf_field() }}
             <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="keyword" class="control-label">Nama atau Username</label>
                <input id="keyword" type="text" class="form-control" name="keyword" value="{{ $oldkey }}">

                @if ($errors->has('keyword'))
                    <span class="help-block">
                        <strong>{{ $errors->first('keyword') }}</strong>
                    </span>
                @endif
            </div>
             <div class="form-group">
                <label for="provinsi" class="control-label">Provinsi</label>

                    <select name='provinsi' id='provinsi' class='form-control'>
                        <option value=''>Pilih</option>
                        @foreach($provinsi as $prov)
                            <option value='{{ $prov->id }}' {{ ($oldprov == $prov->id?'selected':'') }}>{{ $prov->nama }}</option>
                        @endforeach
                    </select>
            </div>
                
            <div class="form-group">
                <label for="kabupaten" class="control-label">Kabupaten/Kota</label>

                    <select name='kabupaten' id='kabupaten' class='form-control'>
                        <option value=''>Pilih</option>
                    </select>
            </div>
                
            <div class="form-group">
                <label for="kecamatan" class="control-label">Kecamatan</label>

                    <select name='kecamatan' id='kecamatan' class='form-control'>
                        <option value=''>Pilih</option>
                    </select>
            </div>
                
            <div class="form-group">
                <label for="desa" class="control-label">Desa/Kelurahan</label>

                    <select name='desa' id='desa' class='form-control'>
                        <option value=''>Pilih</option>
                    </select>
            </div>
            <div class="form-group">
                <label for="kelamin" class="control-label">Jenis Kelamin</label>
                <div class='input-group'>
                    <label class="radio-inline">
                      <input type="radio" name="jk" id="jkAll" value="" {{ empty($oldjk) ? "checked":"" }}> Semua
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="jk" id="jkLaki" value="Laki-laki" {{ $oldjk == 'Laki-laki' ? "checked":"" }}> Laki-laki
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="jk" id="jkPer" value="Perempuan" {{ $oldjk == 'Perempuan' ? "checked":"" }}> Perempuan
                    </label>
                </div>
            </div>
                
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    <span class='glyphicon glyphicon-search'></span> Cari
                </button>
            </div>
        </form>
    </div>
</div>
@section('script2')
    <script type='text/javascript'>
        $(document).ready(function(){
           $prov = $("#provinsi");
           $kab = $("#kabupaten");
           $kec = $("#kecamatan");
           $desa = $("#desa");
           
           $oldprov = '{{ $oldprov }}';
           $oldkab = '{{ $oldkab }}';
           $oldkec = '{{ $oldkec }}';
           $olddesa = '{{ $olddes }}';
           
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