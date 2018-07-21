<div class='panel panel-default profile-card margin-bottom'>
    <div class='panel-heading'>
        <div class="media">
            <div class="media-body" id="title">Pencarian : {{ $query }}</div>
        </div>
    </div>
    <div class='panel-body'>
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Desa</th>
                        <th>Kecamatan</th>
                        <th>Aksi</th>
                        <th>Aksi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($desa as $list_desa)
                    <tr>
                        <td>{{ $list_desa->nama }} - {{ $list_desa->id }}</td>
                        <td>{{ $list_desa->kecamatan->nama }} - {{ $list_desa->kecamatan->id }}</td>
                        <td>{{ $list_desa->kecamatan->kab->nama }} - {{ $list_desa->kecamatan->kab->id }}</td>
                        <td>{{ $list_desa->kecamatan->kab->prov->nama }} - {{ $list_desa->kecamatan->kab->prov->id }}</td>
                        <td>
                            <a href="{{ route('profil_desa.beranda', $list_desa->id) }}" class="btn btn-xs btn-primary">Kunjungi</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


