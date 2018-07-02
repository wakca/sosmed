<ul class="nav">
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
</ul>