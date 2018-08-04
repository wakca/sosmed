<nav class="collapse">
    <ul class="nav nav-pills" id="mainNav">

        <li class="">
            <a class="nav-link" href="{{ route('index') }}">
                Profil Desa
            </a>
        </li>

        <li class="">
            <a class="nav-link" href="{{ route('index') }}">
                Berita
            </a>
        </li>

        <li class="">
            <a class="nav-link" href="{{ route('index') }}">
                Profil Desa
            </a>
        </li>

        <li class="">
            <a class="nav-link" href="{{ route('index') }}">
                Profil Desa
            </a>
        </li>

        

        @if (!Auth::guest())
        <li class="">
            <a class="nav-link" href="#">
                Dashboard Admin
            </a>
        </li>
        @endif

    </ul>
</nav>
