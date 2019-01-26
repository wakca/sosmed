<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Berita Desa, Berita Desa Hari Ini, Berita Harian Desa, Berita Desa Terbaru, Berita Desa Akurat, Berita Desa Terpercaya, Kabar Desa, Berita Desa Terpopuler, Berita, Info Desa Terkini, Klip, Klipaa, klipa, Berita Hari Ini">
    <meta name="description" content="Penyedia Data dan Info Desa/Kelurahan dari Seluruh Indonesia">
    @yield('meta_og')

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-62900800-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-62900800-2');
    </script>

    <!-- Google Analytics -->
    <script>
        window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
        ga('create', 'UA-62900800-2', 'auto');
        ga('send', 'pageview');
    </script>
    <script async src='https://www.google-analytics.com/analytics.js'></script>
    <!-- End Google Analytics -->

    <link rel="canonical" href="{{ app('url')->current() }}" />
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} || @yield('title')</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
    <nav class="navbar navbar-light bg-white navbar-expand-sm border-bottom shadow-sm fixed-top">
        <a class="navbar-brand" href="{{url('/')}}">
            <img src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/logo_white.png" width="30" height="30" alt="logo">
            Klipaa.com
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-list-8" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbar-list-8">
            <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Blog</a>
            </li>
            </ul>
            
            <div class="right-side d-flex">
            <form class="form-inline">
                <input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-info" type="submit"><i class="fas fa-search"></i></button>
            </form>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/fox.jpg" width="40" height="40" class="rounded-circle">
                </a>
                <div class="dropdown-menu  dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#">Dashboard</a>
                    <a class="dropdown-item" href="#">Edit Profile</a>
                    <a class="dropdown-item" href="#">Log Out</a>
                </div>
                </li>   
            </ul>
            </div>
            
        </div>
    </nav>
    <main role="main" class="container">
        <div class="row">
            <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">

                <div class="ui-block">

                    <!-- News Feed Form  -->

                    <div class="news-feed-form">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active inline-items" data-toggle="tab" href="#home-1" role="tab" aria-expanded="true">

                                    <svg class="olymp-status-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-status-icon"></use></svg>

                                    <span>Status</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link inline-items" data-toggle="tab" href="#profile-1" role="tab" aria-expanded="false">

                                    <svg class="olymp-multimedia-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-multimedia-icon"></use></svg>

                                    <span>Multimedia</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link inline-items" data-toggle="tab" href="#blog" role="tab" aria-expanded="false">
                                    <svg class="olymp-blog-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-blog-icon"></use></svg>

                                    <span>Blog Post</span>
                                </a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="home-1" role="tabpanel" aria-expanded="true">
                                <form>
                                    <div class="author-thumb">
                                        <img src="img/author-page.jpg" alt="author">
                                    </div>
                                    <div class="form-group with-icon label-floating is-empty">
                                        <label class="control-label">Share what you are thinking here...</label>
                                        <textarea class="form-control" placeholder=""></textarea>
                                        <span class="material-input"></span></div>
                                    <div class="add-options-message">
                                        <a href="#" class="options-message" data-toggle="tooltip" data-placement="top" data-original-title="ADD PHOTOS">
                                            <svg class="olymp-camera-icon" data-toggle="modal" data-target="#update-header-photo"><use xlink:href="svg-icons/sprites/icons.svg#olymp-camera-icon"></use></svg>
                                        </a>
                                        <a href="#" class="options-message" data-toggle="tooltip" data-placement="top" data-original-title="TAG YOUR FRIENDS">
                                            <svg class="olymp-computer-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-computer-icon"></use></svg>
                                        </a>

                                        <a href="#" class="options-message" data-toggle="tooltip" data-placement="top" data-original-title="ADD LOCATION">
                                            <svg class="olymp-small-pin-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-small-pin-icon"></use></svg>
                                        </a>

                                        <button class="btn btn-primary btn-md-2">Post Status</button>
                                        <button class="btn btn-md-2 btn-border-think btn-transparent c-grey">Preview</button>

                                    </div>

                                </form>
                            </div>

                            <div class="tab-pane" id="profile-1" role="tabpanel" aria-expanded="true">
                                <form>
                                    <div class="author-thumb">
                                        <img src="img/author-page.jpg" alt="author">
                                    </div>
                                    <div class="form-group with-icon label-floating is-empty">
                                        <label class="control-label">Share what you are thinking here...</label>
                                        <textarea class="form-control" placeholder=""></textarea>
                                        <span class="material-input"></span></div>
                                    <div class="add-options-message">
                                        <a href="#" class="options-message" data-toggle="tooltip" data-placement="top" data-original-title="ADD PHOTOS">
                                            <svg class="olymp-camera-icon" data-toggle="modal" data-target="#update-header-photo"><use xlink:href="svg-icons/sprites/icons.svg#olymp-camera-icon"></use></svg>
                                        </a>
                                        <a href="#" class="options-message" data-toggle="tooltip" data-placement="top" data-original-title="TAG YOUR FRIENDS">
                                            <svg class="olymp-computer-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-computer-icon"></use></svg>
                                        </a>

                                        <a href="#" class="options-message" data-toggle="tooltip" data-placement="top" data-original-title="ADD LOCATION">
                                            <svg class="olymp-small-pin-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-small-pin-icon"></use></svg>
                                        </a>

                                        <button class="btn btn-primary btn-md-2">Post Status</button>
                                        <button class="btn btn-md-2 btn-border-think btn-transparent c-grey">Preview</button>

                                    </div>

                                </form>
                            </div>

                            <div class="tab-pane" id="blog" role="tabpanel" aria-expanded="true">
                                <form>
                                    <div class="author-thumb">
                                        <img src="img/author-page.jpg" alt="author">
                                    </div>
                                    <div class="form-group with-icon label-floating is-empty">
                                        <label class="control-label">Share what you are thinking here...</label>
                                        <textarea class="form-control" placeholder=""></textarea>
                                        <span class="material-input"></span></div>
                                    <div class="add-options-message">
                                        <a href="#" class="options-message" data-toggle="tooltip" data-placement="top" data-original-title="ADD PHOTOS">
                                            <svg class="olymp-camera-icon" data-toggle="modal" data-target="#update-header-photo"><use xlink:href="svg-icons/sprites/icons.svg#olymp-camera-icon"></use></svg>
                                        </a>
                                        <a href="#" class="options-message" data-toggle="tooltip" data-placement="top" data-original-title="TAG YOUR FRIENDS">
                                            <svg class="olymp-computer-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-computer-icon"></use></svg>
                                        </a>

                                        <a href="#" class="options-message" data-toggle="tooltip" data-placement="top" data-original-title="ADD LOCATION">
                                            <svg class="olymp-small-pin-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-small-pin-icon"></use></svg>
                                        </a>

                                        <button class="btn btn-primary btn-md-2">Post Status</button>
                                        <button class="btn btn-md-2 btn-border-think btn-transparent c-grey">Preview</button>

                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- ... end News Feed Form  -->			</div>

                <div id="newsfeed-items-grid">

                    <div class="ui-block">

                        <article class="hentry post video">

                            <div class="post__author author vcard inline-items">
                                <img src="img/avatar7-sm.jpg" alt="author">

                                <div class="author-date">
                                    <a class="h6 post__author-name fn" href="#">Marina Valentine</a> shared a <a href="#">link</a>
                                    <div class="post__date">
                                        <time class="published" datetime="2004-07-24T18:18">
                                            March 4 at 2:05pm
                                        </time>
                                    </div>
                                </div>

                                <div class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>
                                    <ul class="more-dropdown">
                                        <li>
                                            <a href="#">Edit Post</a>
                                        </li>
                                        <li>
                                            <a href="#">Delete Post</a>
                                        </li>
                                        <li>
                                            <a href="#">Turn Off Notifications</a>
                                        </li>
                                        <li>
                                            <a href="#">Select as Featured</a>
                                        </li>
                                    </ul>
                                </div>

                            </div>

                            <p>Hey <a href="#">Cindi</a>, you should really check out this new song by Iron Maid. The next time they come to the city we should totally go!</p>

                            <div class="post-video">
                                <div class="video-thumb">
                                    <img src="img/video-youtube1.jpg" alt="photo">
                                    <a href="https://youtube.com/watch?v=excVFQ2TWig" class="play-video">
                                        <svg class="olymp-play-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-play-icon"></use></svg>
                                    </a>
                                </div>

                                <div class="video-content">
                                    <a href="#" class="h4 title">Iron Maid - ChillGroves</a>
                                    <p>Lorem ipsum dolor sit amet, consectetur ipisicing elit, sed do eiusmod tempor incididunt
                                        ut labore et dolore magna aliqua...
                                    </p>
                                    <a href="#" class="link-site">YOUTUBE.COM</a>
                                </div>
                            </div>

                            <div class="post-additional-info inline-items">

                                <a href="#" class="post-add-icon inline-items">
                                    <svg class="olymp-heart-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-heart-icon"></use></svg>
                                    <span>18</span>
                                </a>

                                <ul class="friends-harmonic">
                                    <li>
                                        <a href="#">
                                            <img src="img/friend-harmonic9.jpg" alt="friend">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="img/friend-harmonic10.jpg" alt="friend">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="img/friend-harmonic7.jpg" alt="friend">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="img/friend-harmonic8.jpg" alt="friend">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="img/friend-harmonic11.jpg" alt="friend">
                                        </a>
                                    </li>
                                </ul>

                                <div class="names-people-likes">
                                    <a href="#">Jenny</a>, <a href="#">Robert</a> and
                                    <br>18 more liked this
                                </div>

                                <div class="comments-shared">
                                    <a href="#" class="post-add-icon inline-items">
                                        <svg class="olymp-speech-balloon-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-speech-balloon-icon"></use></svg>

                                        <span>0</span>
                                    </a>

                                    <a href="#" class="post-add-icon inline-items">
                                        <svg class="olymp-share-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-share-icon"></use></svg>

                                        <span>16</span>
                                    </a>
                                </div>


                            </div>

                            <div class="control-block-button post-control-button">

                                <a href="#" class="btn btn-control">
                                    <svg class="olymp-like-post-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-like-post-icon"></use></svg>
                                </a>

                                <a href="#" class="btn btn-control">
                                    <svg class="olymp-comments-post-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-comments-post-icon"></use></svg>
                                </a>

                                <a href="#" class="btn btn-control">
                                    <svg class="olymp-share-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-share-icon"></use></svg>
                                </a>

                            </div>

                        </article>
                    </div>

                    <div class="ui-block">


                        <article class="hentry post">

                            <div class="post__author author vcard inline-items">
                                <img src="img/avatar10-sm.jpg" alt="author">

                                <div class="author-date">
                                    <a class="h6 post__author-name fn" href="#">Elaine Dreyfuss</a>
                                    <div class="post__date">
                                        <time class="published" datetime="2004-07-24T18:18">
                                            9 hours ago
                                        </time>
                                    </div>
                                </div>

                                <div class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>
                                    <ul class="more-dropdown">
                                        <li>
                                            <a href="#">Edit Post</a>
                                        </li>
                                        <li>
                                            <a href="#">Delete Post</a>
                                        </li>
                                        <li>
                                            <a href="#">Turn Off Notifications</a>
                                        </li>
                                        <li>
                                            <a href="#">Select as Featured</a>
                                        </li>
                                    </ul>
                                </div>

                            </div>

                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempo incididunt ut
                                labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris consequat.
                            </p>

                            <div class="post-additional-info inline-items">

                                <a href="#" class="post-add-icon inline-items">
                                    <svg class="olymp-heart-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-heart-icon"></use></svg>
                                    <span>24</span>
                                </a>

                                <ul class="friends-harmonic">
                                    <li>
                                        <a href="#">
                                            <img src="img/friend-harmonic7.jpg" alt="friend">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="img/friend-harmonic8.jpg" alt="friend">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="img/friend-harmonic9.jpg" alt="friend">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="img/friend-harmonic10.jpg" alt="friend">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="img/friend-harmonic11.jpg" alt="friend">
                                        </a>
                                    </li>
                                </ul>

                                <div class="names-people-likes">
                                    <a href="#">You</a>, <a href="#">Elaine</a> and
                                    <br>22 more liked this
                                </div>


                                <div class="comments-shared">
                                    <a href="#" class="post-add-icon inline-items">
                                        <svg class="olymp-speech-balloon-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-speech-balloon-icon"></use></svg>
                                        <span>17</span>
                                    </a>

                                    <a href="#" class="post-add-icon inline-items">
                                        <svg class="olymp-share-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-share-icon"></use></svg>
                                        <span>24</span>
                                    </a>
                                </div>


                            </div>

                            <div class="control-block-button post-control-button">

                                <a href="#" class="btn btn-control">
                                    <svg class="olymp-like-post-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-like-post-icon"></use></svg>
                                </a>

                                <a href="#" class="btn btn-control">
                                    <svg class="olymp-comments-post-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-comments-post-icon"></use></svg>
                                </a>

                                <a href="#" class="btn btn-control">
                                    <svg class="olymp-share-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-share-icon"></use></svg>
                                </a>

                            </div>

                        </article>

                        <!-- Comments -->

                        <ul class="comments-list">
                            <li class="comment-item">
                                <div class="post__author author vcard inline-items">
                                    <img src="img/author-page.jpg" alt="author">

                                    <div class="author-date">
                                        <a class="h6 post__author-name fn" href="02-ProfilePage.html">James Spiegel</a>
                                        <div class="post__date">
                                            <time class="published" datetime="2004-07-24T18:18">
                                                38 mins ago
                                            </time>
                                        </div>
                                    </div>

                                    <a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>

                                </div>

                                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium der doloremque laudantium.</p>

                                <a href="#" class="post-add-icon inline-items">
                                    <svg class="olymp-heart-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-heart-icon"></use></svg>
                                    <span>3</span>
                                </a>
                                <a href="#" class="reply">Reply</a>
                            </li>
                            <li class="comment-item">
                                <div class="post__author author vcard inline-items">
                                    <img src="img/avatar1-sm.jpg" alt="author">

                                    <div class="author-date">
                                        <a class="h6 post__author-name fn" href="#">Mathilda Brinker</a>
                                        <div class="post__date">
                                            <time class="published" datetime="2004-07-24T18:18">
                                                1 hour ago
                                            </time>
                                        </div>
                                    </div>

                                    <a href="#" class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>

                                </div>

                                <p>Ratione voluptatem sequi en lod nesciunt. Neque porro quisquam est, quinder dolorem ipsum
                                    quia dolor sit amet, consectetur adipisci velit en lorem ipsum duis aute irure dolor in reprehenderit in voluptate velit esse cillum.
                                </p>

                                <a href="#" class="post-add-icon inline-items">
                                    <svg class="olymp-heart-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-heart-icon"></use></svg>
                                    <span>8</span>
                                </a>
                                <a href="#" class="reply">Reply</a>
                            </li>
                        </ul>

                        <!-- ... end Comments -->

                        <a href="#" class="more-comments">View more comments <span>+</span></a>


                        <!-- Comment Form  -->

                        <form class="comment-form inline-items">

                            <div class="post__author author vcard inline-items">
                                <img src="img/author-page.jpg" alt="author">

                                <div class="form-group with-icon-right is-empty">
                                    <textarea class="form-control" placeholder=""></textarea>
                                    <div class="add-options-message">
                                        <a href="#" class="options-message" data-toggle="modal" data-target="#update-header-photo">
                                            <svg class="olymp-camera-icon">
                                                <use xlink:href="svg-icons/sprites/icons.svg#olymp-camera-icon"></use>
                                            </svg>
                                        </a>
                                    </div>
                                    <span class="material-input"></span></div>
                            </div>

                            <button class="btn btn-md-2 btn-primary">Post Comment</button>

                            <button class="btn btn-md-2 btn-border-think c-grey btn-transparent custom-color">Cancel</button>

                        </form>

                        <!-- ... end Comment Form  -->
                    </div>

                    <div class="ui-block">

                        <article class="hentry post has-post-thumbnail">

                            <div class="post__author author vcard inline-items">
                                <img src="img/avatar5-sm.jpg" alt="author">

                                <div class="author-date">
                                    <a class="h6 post__author-name fn" href="#">Green Goo Rock</a>
                                    <div class="post__date">
                                        <time class="published" datetime="2004-07-24T18:18">
                                            March 8 at 6:42pm
                                        </time>
                                    </div>
                                </div>

                                <div class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>
                                    <ul class="more-dropdown">
                                        <li>
                                            <a href="#">Edit Post</a>
                                        </li>
                                        <li>
                                            <a href="#">Delete Post</a>
                                        </li>
                                        <li>
                                            <a href="#">Turn Off Notifications</a>
                                        </li>
                                        <li>
                                            <a href="#">Select as Featured</a>
                                        </li>
                                    </ul>
                                </div>

                            </div>

                            <p>Hey guys! We are gona be playing this Saturday of <a href="#">The Marina Bar</a> for their new Mystic Deer Party.
                                If you wanna hang out and have a really good time, come and join us. We’l be waiting for you!
                            </p>

                            <div class="post-thumb">
                                <img src="img/post__thumb1.jpg" alt="photo">
                            </div>

                            <div class="post-additional-info inline-items">

                                <a href="#" class="post-add-icon inline-items">
                                    <svg class="olymp-heart-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-heart-icon"></use></svg>
                                    <span>49</span>
                                </a>

                                <ul class="friends-harmonic">
                                    <li>
                                        <a href="#">
                                            <img src="img/friend-harmonic9.jpg" alt="friend">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="img/friend-harmonic10.jpg" alt="friend">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="img/friend-harmonic7.jpg" alt="friend">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="img/friend-harmonic8.jpg" alt="friend">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="img/friend-harmonic11.jpg" alt="friend">
                                        </a>
                                    </li>
                                </ul>

                                <div class="names-people-likes">
                                    <a href="#">Jimmy</a>, <a href="#">Andrea</a> and
                                    <br>47 more liked this
                                </div>


                                <div class="comments-shared">
                                    <a href="#" class="post-add-icon inline-items">
                                        <svg class="olymp-speech-balloon-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-speech-balloon-icon"></use></svg>
                                        <span>264</span>
                                    </a>

                                    <a href="#" class="post-add-icon inline-items">
                                        <svg class="olymp-share-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-share-icon"></use></svg>
                                        <span>37</span>
                                    </a>
                                </div>


                            </div>

                            <div class="control-block-button post-control-button">

                                <a href="#" class="btn btn-control">
                                    <svg class="olymp-like-post-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-like-post-icon"></use></svg>
                                </a>

                                <a href="#" class="btn btn-control">
                                    <svg class="olymp-comments-post-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-comments-post-icon"></use></svg>
                                </a>

                                <a href="#" class="btn btn-control">
                                    <svg class="olymp-share-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-share-icon"></use></svg>
                                </a>

                            </div>

                        </article>
                    </div>

                    <div class="ui-block">

                        <article class="hentry post has-post-thumbnail">

                            <div class="post__author author vcard inline-items">
                                <img src="img/avatar3-sm.jpg" alt="author">

                                <div class="author-date">
                                    <a class="h6 post__author-name fn" href="#">Sarah Hetfield</a>
                                    <div class="post__date">
                                        <time class="published" datetime="2004-07-24T18:18">
                                            March 2 at 9:06am
                                        </time>
                                    </div>
                                </div>

                                <div class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>
                                    <ul class="more-dropdown">
                                        <li>
                                            <a href="#">Edit Post</a>
                                        </li>
                                        <li>
                                            <a href="#">Delete Post</a>
                                        </li>
                                        <li>
                                            <a href="#">Turn Off Notifications</a>
                                        </li>
                                        <li>
                                            <a href="#">Select as Featured</a>
                                        </li>
                                    </ul>
                                </div>

                            </div>

                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
                                mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque.
                            </p>

                            <div class="post-additional-info inline-items">

                                <a href="#" class="post-add-icon inline-items">
                                    <svg class="olymp-heart-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-heart-icon"></use></svg>
                                    <span>0 Likes</span>
                                </a>

                                <div class="comments-shared">
                                    <a href="#" class="post-add-icon inline-items">
                                        <svg class="olymp-speech-balloon-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-speech-balloon-icon"></use></svg>
                                        <span>0 Comments</span>
                                    </a>

                                    <a href="#" class="post-add-icon inline-items">
                                        <svg class="olymp-share-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-share-icon"></use></svg>
                                        <span>2 Shares</span>
                                    </a>
                                </div>


                            </div>

                            <div class="control-block-button post-control-button">

                                <a href="#" class="btn btn-control">
                                    <svg class="olymp-like-post-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-like-post-icon"></use></svg>
                                </a>

                                <a href="#" class="btn btn-control">
                                    <svg class="olymp-comments-post-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-comments-post-icon"></use></svg>
                                </a>

                                <a href="#" class="btn btn-control">
                                    <svg class="olymp-share-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-share-icon"></use></svg>
                                </a>

                            </div>

                        </article>
                    </div>

                    <div class="ui-block">

                        <article class="hentry post has-post-thumbnail">

                            <div class="post__author author vcard inline-items">
                                <img src="img/avatar2-sm.jpg" alt="author">

                                <div class="author-date">
                                    <a class="h6 post__author-name fn" href="#">Nicholas Grissom</a>
                                    <div class="post__date">
                                        <time class="published" datetime="2004-07-24T18:18">
                                            March 2 at 8:34am
                                        </time>
                                    </div>
                                </div>

                                <div class="more"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg>
                                    <ul class="more-dropdown">
                                        <li>
                                            <a href="#">Edit Post</a>
                                        </li>
                                        <li>
                                            <a href="#">Delete Post</a>
                                        </li>
                                        <li>
                                            <a href="#">Turn Off Notifications</a>
                                        </li>
                                        <li>
                                            <a href="#">Select as Featured</a>
                                        </li>
                                    </ul>
                                </div>

                            </div>

                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
                                mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                                accusantium doloremque.
                            </p>

                            <div class="post-additional-info inline-items">

                                <a href="#" class="post-add-icon inline-items">
                                    <svg class="olymp-heart-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-heart-icon"></use></svg>
                                    <span>22</span>
                                </a>

                                <ul class="friends-harmonic">
                                    <li>
                                        <a href="#">
                                            <img src="img/friend-harmonic9.jpg" alt="friend">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="img/friend-harmonic10.jpg" alt="friend">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="img/friend-harmonic7.jpg" alt="friend">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="img/friend-harmonic8.jpg" alt="friend">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="img/friend-harmonic11.jpg" alt="friend">
                                        </a>
                                    </li>
                                </ul>

                                <div class="names-people-likes">
                                    <a href="#">Jimmy</a>, <a href="#">Andrea</a> and
                                    <br>47 more liked this
                                </div>


                                <div class="comments-shared">
                                    <a href="#" class="post-add-icon inline-items">
                                        <svg class="olymp-speech-balloon-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-speech-balloon-icon"></use></svg>
                                        <span>0</span>
                                    </a>

                                    <a href="#" class="post-add-icon inline-items">
                                        <svg class="olymp-share-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-share-icon"></use></svg>
                                        <span>2</span>
                                    </a>
                                </div>


                            </div>

                            <div class="control-block-button post-control-button">

                                <a href="#" class="btn btn-control">
                                    <svg class="olymp-like-post-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-like-post-icon"></use></svg>
                                </a>

                                <a href="#" class="btn btn-control">
                                    <svg class="olymp-comments-post-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-comments-post-icon"></use></svg>
                                </a>

                                <a href="#" class="btn btn-control">
                                    <svg class="olymp-share-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-share-icon"></use></svg>
                                </a>

                            </div>

                        </article>
                    </div>

                </div>

                <a id="load-more-button" href="#" class="btn btn-control btn-more" data-load-link="items-to-load.html" data-container="newsfeed-items-grid"><svg class="olymp-three-dots-icon"><use xlink:href="svg-icons/sprites/icons.svg#olymp-three-dots-icon"></use></svg></a>

            </main>
        </div>
    </main>
    <script src="{{asset('js/app.js')}}"></script>
    @yield('script')
</body>
</html>
