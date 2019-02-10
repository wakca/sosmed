@extends('layouts.app')
@section('content')
    <!-- Modal Tags -->
    <div class="modal fade" id='modal-tags' tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><span class='glyphicon glyphicon-tag'></span> Tampilkan Story berdasarkan tag</h4>
                </div>
                <div id='list-tags'>
                    <ul class='list-group'>
                        <li class="list-group-item {{ app('url')->current() == route('index')?"active":"" }}"><a href='{{ route('index') }}' >Semua</a></li>
                        @foreach($tags as $tag)
                            <li class="list-group-item {{ app('url')->current() == route('story.tag',['tag' => $tag->name])?"active":"" }}"><a href='{{ route('story.tag',['tag' => $tag->name]) }}'>{{ ucfirst($tag->name) }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class='container bgstory'>
        <div class='row'>
            <div class='col-md-3 list-tag'>
                <div data-spy="affix" data-offset-top="60" data-offset-bottom="200" class='panel panel-default'>
                    <div class='panel-heading'><i class='glyphicon glyphicon-tag'></i> Apa yang sedang terjadi ?</div>
                    <ul class='list-group'>
                        <li class="list-group-item {{ app('url')->current() == route('index')?"active":"" }}"><a href='{{ route('index') }}' >Semua</a></li>
                        @foreach($tags as $tag)
                            <li class="list-group-item {{ app('url')->current() == route('story.tag',['tag' => $tag->name])?"active":"" }}"><a href='{{ route('story.tag',['tag' => $tag->name]) }}'>{{ ucfirst($tag->name) }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class='col-md-6 col-xs-12'>

                <div class='mobile-tag'>
                    <div class="input-group">
                        <input type="text" name="search" id="search" placeholder="Cari Desa / Kelurahan Berdasarkan Nama atau Kode" class="form-control">
                        <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary ml-2" id="submit" onclick="submit()">
                            <span class="glyphicon glyphicon-search"></span>
                            Cari
                        </button>
                    </span>
                    </div>
                    <div id="suggest"></div>
                </div>
                <div class="wrapper">
                    <div class="story">
                        <div class="row story-container">
                            <div id="carouselHitsStory" class="carousel slide mt-3 mb-3" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <?php $id_carousel = 0; ?>
                                    @forelse($hits_story as $hits)
                                        <li data-target="#carouselHitsStory" data-slide-to="{{$id_carousel}}" class="active"></li>
                                        <?php
                                            $id_carousel++;
                                            ?>
                                    @empty

                                    @endforelse
                                </ol>
                                <div class="carousel-inner">
                                    <?php $id_body_carousel = 0; ?>
                                    @forelse($hits_story as $storyhits)
                                        <div class="carousel-item {{$id_body_carousel == 0 ? 'active' : ''}}">
                                            <img class="d-block w-100" src="{{Getter::getStoryThumb($storyhits->content, $storyhits->title)}}" style="height: 400px; width: 800px;" alt="{{$storyhits->title}}">
                                            <div class="carousel-caption d-none d-md-block">

                                                <h5><a href="https://google.com">{{$storyhits->title}}</a></h5>
                                                <p>{{ strlen(strip_tags($storyhits->content)) > 100 ? str_limit(strip_tags($storyhits->content),100)."...":strip_tags($storyhits->content) }}</p>
                                            </div>
                                        </div>
                                        <?php $id_body_carousel++; ?>
                                    @empty
                                    @endforelse
                                </div>
                                <a class="carousel-control-prev" href="#carouselHitsStory" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselHitsStory" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id='wrapper'>

                    <div id='story '>

                        <div class='row story-container mt-5' id='list-story'>
                            @foreach($stories as $story)
                                <div class="card story flex-md-row mb-2 shadow-sm h-md-250 ">
                                    <div class="card-body d-flex flex-column align-items-start">

                                        @forelse($story->tags as $tag)
                                        <strong class="d-inline-block mb-2 badge badge-primary">{{$tag->name}}</strong>
                                        @empty

                                        @endforelse
                                        <h5 class="mb-0">
                                            <a class="text-dark" href="#">{{$story->title}}</a>
                                        </h5>

                                        <div class="mb-2 text-muted">{{ Date::parse($story->created_at)->ago() }}</div>
                                        <p class="card-text mb-auto">{{ strlen(strip_tags($story->content)) > 100 ? str_limit(strip_tags($story->content),100)."...":strip_tags($story->content) }}</p>

                                        <a href="#">Continue reading</a>
                                    </div>
                                    <img class="bd-placeholder-img card-img-right flex-auto d-none d-lg-block" src="{{Getter::getStoryThumb($story->content, $story->title)}}" style="width: 200px; height: 250px;"/>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class='hidden-div'>{{ $stories-> links() }}</div>
                    <div class='center-text' id='load-more'>
                    </div>
                </div>

            </div>

            <div class='col-md-3 list-tag'>

                <div class="card shadow-sm">
                    <div class="card-body">
                        Ini Merupakan Widget Untuk Saran Teman
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/jquery.infinitescroll.min.js') }}"></script>
    <script type='text/javascript'>
        function openTags() {
            $("#modal-tags").modal("show");
        }
        function submit()
        {
            var src = $("#search").val();

            if(src.length == 0){
                $('#suggest').empty();
            } else {

                $.ajax({
                    type: "GET",
                    url: "/api/search_desa/"+src,
                    data: {
                        "src": src,
                    },
                    cache: true,
                    success: function (data) {
                        console.log(src);
                        console.log(data);
                        $('#suggest').empty();
                        $('#suggest').html(data);
                    }

                });
            }
        }
        $(function() {
            var $affixElement = $('div[data-spy="affix"]');
            $affixElement.width($affixElement.parent().width());
        });
        $(document).ready(function(){
            $('.story-container .story:nth-child(3n - 1)').addClass('story-container-col2');
            $('.story-container .story:nth-child(3n)').addClass('story-container-col3');

            $('.story-container-col2').appendTo('.story-container').removeClass('story-container-col2');
            $('.story-container-col3').appendTo('.story-container').removeClass('story-container-col3');

            var loading_options = {
                finishedMsg:'',
                msgText:'',
                selector: '#load-more',
                speed:'normal',
            };

            $('#list-story').infinitescroll({
                loading : loading_options,
                navSelector : "#wrapper .pagination",
                nextSelector : "#wrapper .pagination li.active + li a",
                itemSelector : "#list-story div.story",
            });
        });

    </script>
@endsection