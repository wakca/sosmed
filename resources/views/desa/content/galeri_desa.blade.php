<div class="clearfix">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            @for($i = 0; $i < count($data); $i++)
            <li data-target="#myCarousel" data-slide-to="{{ $i }}" @if($i == 0) class="active" @endif></li>
            @endfor
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            @foreach($data as $key => $galeri)
            <div class="item @if($key == 0) active @endif">
                <img src="{{ asset($galeri->link) }}" alt="{{ $galeri->nama }}">
            </div>
            @endforeach
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>