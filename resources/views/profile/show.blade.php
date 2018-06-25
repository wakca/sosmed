@extends('layouts.app')
@section('title','Profile | ')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ isset($profil->name)?$profil->name : $profil->username }}</div>
                <div class="panel-body">
                    @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </p>
                    @endif                        
                    
                        <table width='100%'>
                            <tr>
                                <td>Photo</td>
                                <td><div class="row">
                                        <div class="col-xs-6 col-md-3">
                                            <a href="#" class="thumbnail">
                                              <img src="/photos/{{ isset($profil->photo) ? $profil->photo : 'av-default.jpg' }}" alt="Foto Profil">
                                            </a>
                                          </div>
                                      </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>: {{ $profil->jk }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <td>: {{ IndoTgl::tglIndo($profil->tgl_lahir) }}</td>
                            </tr>
                            <tr>
                                <td>Provinsi</td>
                                <td>: {{ isset($profil->prov) ? $profil->prov->nama : '' }}</td>
                            </tr>
                            <tr>
                                <td>Kabupaten/Kota</td>
                                <td>: {{ isset($profil->kab) ? $profil->kab->nama : '' }}</td>
                            </tr>
                            <tr>
                                <td>Kecamatan</td>
                                <td>: {{ isset($profil->kec) ? $profil->kec->nama : '' }}</td>
                            </tr>
                            <tr>
                                <td>Desa/Kelurahan</td>
                                <td>: {{ isset($profil->des) ? $profil->des->nama : '' }}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>: {{ $profil->alamat }}</td>
                            </tr>
                        </table>
                            
                        @if(Auth::user()->id != $profil->id)
                            @if(isset($follow) && $follow->status == 'Y')
                                <button id='follow-btn' class='btn btn-primary' onclick='follow({{$profil->id}})'>Following</button>
                            @else
                                <button id='follow-btn' class='btn btn-default' onclick='follow({{$profil->id}})'>+ Follow</button>
                            @endif
                        @else
                            <a href='/profile-setting' class='btn btn-sm btn-default'>Pengaturan Profil</a> <a href='/account-setting' class='btn btn-sm btn-default'>Pengaturan Akun</a>
                        @endif
                        <h3>Followers</h3>
                        @foreach($follower as $followers)
                            <li><a href='/{{ $followers->username }}'>{{ isset($followers->name) ? $followers->name : $followers->username  }}</a></li>
                        @endforeach
                        
                        <h3>Following</h3>
                        @foreach($following as $following)
                            <li><a href='/{{ $following->username }}'>{{ isset($following->name) ? $following->name : $following->username}}</a></li>
                        @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script type='text/javascript'>
       function follow(id) {
          $.ajax({
            url:'/follow/'+id,
            type:'GET',
            dataType:'json',
            success:function(data){
                if (data.status == 'following') {
                    $('#follow-btn').removeClass('btn-default').addClass('btn-primary').text('Following');
                }
                else{
                    $('#follow-btn').removeClass('btn-primary').addClass('btn-default').text('+ Follow');
                }
            }
          });
       }
    </script>
@endsection