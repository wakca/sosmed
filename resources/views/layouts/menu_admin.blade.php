<ul class="nav">
    <!-- Super Admin -->
    @if(Auth::user()->level == 3)
    <li @if(Request::segment(2) == 'dashboard') class="active" @endif>
        <a href="{{ route('admin.dashboard') }}">
            <i class="pe-7s-graph"></i>
            <p>Dashboard</p>
        </a>
    </li>
    <li @if(Request::segment(2) == 'user') class="active" @endif>
        <a href="{{ route('admin.user') }}">
            <i class="pe-7s-users"></i>
            <p>Users</p>
        </a>
    </li>

    <li @if(Request::segment(2) == 'pengurus') class="active" @endif>
        <a href="{{ route('admin.pengurus') }}">
            <i class="pe-7s-user"></i>
            <p>Pengurus Desa</p>
        </a>
    </li>

    <li @if(Request::segment(2) == 'story') class="active" @endif>
        <a href="{{ route('admin.story') }}">
            <i class="pe-7s-news-paper"></i>
            <p>Story</p>
        </a>
    </li>
    <li @if(Request::segment(2) == 'tag') class="active" @endif>
        <a href="{{ route('admin.tag') }}">
            <i class="pe-7s-ticket"></i>
            <p>Tag</p>
        </a>
    </li>
    <li @if(Request::segment(2) == 'post') class="active" @endif>
        <a href="{{ route('admin.post') }}">
            <i class="pe-7s-pen"></i>
            <p>Post</p>
        </a>
    </li>
    <li @if(Request::segment(2) == 'comment') class="active" @endif>
        <a href="{{ route('admin.comment') }}">
            <i class="pe-7s-comment"></i>
            <p>Comment</p>
        </a>
    </li>
    <!-- /Super Admin -->

    <!-- Admin Desa -->
    @elseif(Auth::user()->level == 2)
    <li @if(Request::segment(2) == 'dashboard') class="active" @endif>
        <a href="{{ route('admin_desa.dashboard') }}">
            <i class="pe-7s-graph"></i>
            <p>Dashboard</p>
        </a>
    </li>
    
    <li @if(Request::segment(2) == 'konten_desa') class="active" @endif>
        <a href="{{ route('admin_desa.content') }}">
            <i class="fa fa-file-o"></i>
            <p>Konten Desa</p>
        </a>
    </li>

    <li @if(Request::segment(2) == 'user') class="active" @endif>
        <a href="{{ route('admin_desa.user.index') }}">
            <i class="fa fa-users"></i>
            <p>Users</p>
        </a>
    </li>

    <li @if(Request::segment(2) == 'story') class="active" @endif>
        <a href="{{ route('admin_desa.asu.index') }}">
            <i class="fa fa-list"></i>
            <p>Story</p>
        </a>
    </li>
    @endif
    <!-- /Admin Desa -->
</ul>