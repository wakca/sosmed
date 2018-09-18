<div class='panel panel-default profile-card ' id="user-{{ $profile->id }}">
    <div class='panel-heading'>
        {{--<img class="media-object" width='100%' src="/photos/{{ isset($profile->photo) ? $profile->photo : 'av-default.jpg' }}" alt="{{ $profile->name }}">--}}
        <img class="media-object" width='100%' src="{{$profile->photo ? url('/storage/'.$profile->photo) : url('/photos/av-default.jpg')}}" alt="{{ $profile->name }}">
        <h2 class="media-heading margin-top"  title='{{ $profile->name }} &#64;{{ $profile->username }}'>{{ $profile->name }}</h2>
        &#64;{{ $profile->username }} {!! Getter::getVerified($profile->verified) !!}
        @if(Auth::Id() != $profile->id)
            <p></p>{!! Getter::isFollowing($profile->id,Auth::Id()) == true ? "<button id='follow-btn' class='btn btn-sm btn-primary' onclick='follow(".$profile->id.")'>Following</button>":"<button id='follow-btn' class='btn btn-sm btn-default' onclick='follow(".$profile->id.")'>+ Follow</button>" !!}
            <a id='message-btn' class='btn btn-sm btn-default' href='/messages/{{$profile->username}}'><span class='glyphicon glyphicon-envelope'></span> Pesan</a>
        @endif
    </div>
    <div class='panel-body'>
        <ul class='nav nav-justified'>
          <li><a href='/{{ $profile->username }}/posts'><span class='smallest-text'>POSTS</span><span class='card-num center-text'>{{ Getter::getNumPosts($profile->id) }}</span></a></li>
          <li><a href='/{{ $profile->username }}/followers'><span class='smallest-text'>FOLLOWERS</span><span class='card-num center-text'>{{ Getter::getNumFollowers($profile->id) }}</span></a></li>
          <li><a href='/{{ $profile->username }}/following'><span class='smallest-text'>FOLLOWING</span><span class='card-num center-text'>{{ Getter::getNumFollowing($profile->id) }}</span></a></li>
        </ul>
    </div>
</div>
<div class='panel panel-default margin-bottom'>
    <div class='panel-heading'>
        <h4 class='media-heading'>Informasi Detail</h4>
    </div>
    <div class='panel-body padding'>
        <table>
            <tr>
                <td>Jenis Kelamin</td>
                <td>: {{ $profile->jk }}</td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td>: {{ IndoTgl::tglIndo($profile->tgl_lahir) }}</td>
            </tr>
            <tr>
                <td>Provinsi</td>
                <td>: {{ isset($profile->prov) ? $profile->prov->nama : '' }}</td>
            </tr>
            <tr>
                <td>Kabupaten/Kota</td>
                <td>: {{ isset($profile->kab) ? $profile->kab->nama : '' }}</td>
            </tr>
            <tr>
                <td>Kecamatan</td>
                <td>: {{ isset($profile->kec) ? $profile->kec->nama : '' }}</td>
            </tr>
            <tr>
                <td>Desa/Kelurahan</td>
                <td>: {{ isset($profile->des) ? $profile->des->nama : '' }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>: {{ $profile->alamat }}</td>
            </tr>             
        </table>
        @if($profile->id == Auth::Id())
            <div class='margin-top'>
                <a href='/profile-setting' class='btn btn-sm btn-default'>Edit Profil</a>
            </div>
        @endif
    </div>
</div>