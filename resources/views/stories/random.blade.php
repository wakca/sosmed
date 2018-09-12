<div class='panel panel-bordered panel-default'>
    <div class='panel-heading'>Cerita menarik lainnya</div>
    <div class='panel-body list-story'>
        @foreach($random as $rand)
            <ul >
                <li><a href='{{ route('story.view',['slug' => $rand->slug]) }}'>{{ $rand->title }}</a></li>
            </ul>
        @endforeach
    </div>
</div>