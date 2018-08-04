<nav class="collapse">
    <ul class="nav nav-pills" id="mainNav">

        <li class="">
            <a class="nav-link" href="{{ route('profil_desa.beranda', $desa->id) }}">
                Profil Desa
            </a>
        </li>

        <li class="">
            <a class="nav-link" href="{{ route('profil_desa.selayang_pandang', $desa->id) }}">
                Selayang Pandang
            </a>
        </li>

        <li class="">
            <a class="nav-link" href="{{ route('profil_desa.produk', $desa->id) }}">
                Produk Unggulan
            </a>
        </li>

        

        <li class="">
            <a class="nav-link" href="{{ route('profil_desa.story', $desa->id) }}">
                Story
            </a>
        </li>

        <li class="">
            <a class="nav-link" href="{{ route('profil_desa.dokumen', $desa->id) }}">
                Dokumen
            </a>
        </li>

        <li class="">
            <a class="nav-link" href="{{ route('profil_desa.organisasi', $desa->id) }}">
                Organisasi
            </a>
        </li>

        <li class="">
            <a class="nav-link" href="{{ route('profil_desa.peta', $desa->id) }}">
                Peta
            </a>
        </li>


    </ul>
</nav>
