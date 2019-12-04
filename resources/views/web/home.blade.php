@section('in_home', true)

<?php
use App\Library\Helpers;
// global variable file /case
global $album_hot;
global $album_new;
global $album_old;
global $download_rows;
global $music_new_uploads;
global $video_new_uploads;
global $hot_music_rows;
global $top_uploader_weeks;
global $top_artist_rows;
$catalog = config('constants.catalog');
?>

@extends('web.layouts.app')

@section('content')

@include('cache.def_home_album')
@include('cache.def_home_download')
@include('cache.bxh.bxh_today')
@include('cache.uploader.uploader_week')
@include('cache.top_artist')
<div class="slide_home"
     style="background: url('/imgs/Slice-1.jpg');">
    <div class="container">
        <div class="owl-carousel owl-theme">
            <?php
                array_map(function($item) {
                    ?>
                    <div class="item">
                        <div class="card card1 slide">
                            <div class="card-header"
                                 style="background-image: url({{$item['cover_url']}});">
                                <a href="{{$item['album_url']}}" title="{{$item['music_album']}}">
                                    <span class="icon-play"></span>
                                </a>
                            </div>
                            <div class="card-body">
                                <h3 class="card-title"><a href="{{$item['album_url']}}" title="{{$item['music_album']}}">{{$item['music_album']}}</a></h3>
                                <p class="card-text author"><?php echo $item['music_artist_html'] ?></p>
                                <div class="card-text"><?php echo $item['music_bitrate_html'] ?></div>
                            </div>
                        </div>
                    </div>
                    <?php
                }, Helpers::getRandLimitArr($album_new, LIMIT_HOME_ALBUM_NEW));
            ?>
        </div>
        <script type="text/javascript">
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 20,
                autoplay: true,
                autoplayTimeout: 7000,
                autoplayHoverPause: true,
                slideBy: 4,
                nav: true,
                navText: ['<img src="imgs/top-left.png" alt="">', '<img src="imgs/top-right.png" alt="">'],
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 4
                    }
                }
            })
        </script>
    </div>
</div>
<div class="container">
    <div class="row row_wrapper">
        <div class="col-md-9">
            <div class="box_header d-flex justify-content-between align-items-end">
                <a class="view_all" href="/mp3/vietnam.html"><h5 class="title m-0">Album mới nhất {{date('Y', time())}}</h5></a>
                <a class="link_more" href="/mp3/vietnam.html" title="Album mới nhất {{date('Y', time())}}">Xem tất cả</a>
            </div>
            <div class="row row10px">
                <?php
                $newMusic = Helpers::getRandLimitArr($album_new, LIMIT_HOME_MUSIC_NEW);
                array_map(function ($i, $item) {
                ?>
                    @if ($i == 5)
                    </div>
                    <div class="row row10px">
                    @endif
                        <div class="col">
                            <div class="card card1">
                                <div class="card-header" style="background-image: url({{$item['cover_url']}});">
                                    <a href="{{$item['album_url']}}" title="{{$item['music_album']}}">
                                        <span class="icon-play"></span>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title"><a href="{{$item['album_url']}}" title="{{$item['music_album']}}">{{$item['music_album']}}</a></h3>
                                    <p class="card-text"><?php echo $item['music_artist_html'] ?></p>
                                </div>
                            </div>
                        </div>
                    <?php
                }, array_keys($newMusic), $newMusic)
                ?>
            </div>
            <div class="box_catalog owl-carousel owl-theme">
                <a href="/nhac-hot/vietnam.html" title="" class="item img-thumbnail swiper-slide" style="background: url('/imgs/bxh/BXH Nhạc Việt Nam_ 245 x 140.png') no-repeat;"><span>BXH Việt Nam</span></a>
                <a href="/nhac-hot/video/v-video.html" title="" class="item img-thumbnail swiper-slide" style="background: url('/imgs/bxh/BXH Video_ 245 x 140.png') no-repeat;"><span>BXH Việt Video</span></a>
                <a href="/nhac-hot/us-uk.html" title="" class="item img-thumbnail swiper-slide" style="background: url('/imgs/bxh/BXH Nhạc Us- UK _ 245 x 140.png') no-repeat;"><span>BXH US - UK</span></a>
                <a href="/nhac-hot/chinese.html" title="" class="item img-thumbnail swiper-slide" style="background: url('/imgs/bxh/BXH Nhạc Hoa _ 245 x 140.png') no-repeat;"><span>BXH Nhạc Hoa</span></a>
                <a href="/nhac-hot/korea.html" title="" class="item img-thumbnail swiper-slide" style="background: url('/imgs/bxh/BXH Nhạc Hàn _ 245 x 140.png') no-repeat;"><span>BXH Nhạc Hàn</span></a>
                <a href="/nhac-hot/japan.html" title="" class="item img-thumbnail swiper-slide" style="background: url('/imgs/bxh/BXH Nhạc Nhật _ 245 x 140.png') no-repeat;"><span>BXH Nhạc Nhật</span></a>
                <a href="/nhac-hot/other.html" title="" class="item img-thumbnail swiper-slide" style="background: url('/imgs/bxh/BXH Nhạc Nước Khác _ 245 x 140.png') no-repeat;"><span>BXH nhạc nước khác</span></a>
                <a href="/nhac-hot/beat-playback.html" title="" class="item img-thumbnail swiper-slide" style="background: url('/imgs/bxh/BXH Beat _ 245 x 140.png') no-repeat;"><span>BXH Beat Playback</span></a>
            </div>
            <!-- Initialize Carousel -->
            <script>
                $('.box_catalog').owlCarousel({
                    margin:10,
                    loop:true,
                    autoWidth:true,
                    items:4,
                    dots:false,
                    nav:true,
                    navText: ['<i class="material-icons">keyboard_arrow_left</i>','<i class="material-icons">keyboard_arrow_right</i>'],
                })
            </script>
            <div class="row row10px">
                <div class="col">
                    <div class="box_header d-flex justify-content-between align-items-end">
                        <a class="view_all" href="/bai-hat-moi.html"><h5 class="title m-0">Bài hát mới chia sẻ</h5></a>
                        <a class="link_more" href="/bai-hat-moi.html" title="Bài hát mới nhất 2018">Xem tất cả</a>
                    </div>
                    <ul class="list-unstyled list_music">
                        <?php
                            array_map(function($item) {
                                $url = $item['music_url'];
                            ?>
                            <li class="media align-items-stretch items-stretch-{{$item['music_id']}}">
                                <div class="media-left align-items-stretch mr-2">
                                    <a href="{{$url}}" title="{{$item['music_title']}}">
                                        <img src="{{$item['cover_html']}}" alt="{{$item['music_title']}}">
                                        <i class="material-icons">play_circle_outline</i>
                                        @if($item['cat_id'] == CAT_BEAT)
                                            <p class="time text-white mb-0 py-1">Beat</p>
                                        @endif
                                    </a>
                                </div>
                                <div class="media-body align-items-stretch d-flex flex-column justify-content-between p-0">
                                    <div>
                                        <h5 class="media-title mt-0 mb-0 title_home_tablet"><a href="{{$url}}" title="{{$item['music_shortlyric'] ?? $item['music_title']}}">{{$item['music_title']}}</a></h5>
                                        <div class="author title_home_tablet"><?php echo $item['music_artist_html'] ?></div>
                                    </div>
                                    <small class="type_music"><?php echo $item['music_bitrate_html']; ?></small>
                                </div>
                                <div class="media-right align-self-center">
                                    <small class="time_stt"><?php echo Helpers::timeElapsedString($item['music_time']); ?></small>
                                    <ul class="list-inline">
                                        <li class="list-inline-item"><a href="{{$url}}" target="_blank" title="nghe riêng nhạc {{$item['music_title']}}"><i class="material-icons">headset</i></a></li>
                                        <li class="list-inline-item"><a onclick="addPlaylistTable('{{str_replace("'", "\'", $item['music_title'])}}', '{{$item['music_id']}}', '{{isset($item['music_artist']) ? $item['music_artist'] : "false"}}', '{{isset($item['music_artist_id']) ? $item['music_artist_id'] : "false"}}')" href="javascript:void(0)" title="thêm vào playlist"><i class="material-icons">playlist_add</i></a></li>
                                        <li class="list-inline-item"><a href="{{Helpers::fbShareLink($url)}}" class="fb-share-link" target="_blank" title="chia sẻ {{$item['music_title']}}"><i class="material-icons">share</i></a></li>
                                    </ul>
                                </div>
                            </li>
                            <?php
                            }, Helpers::getRandLimitArr($music_new_uploads, LIMIT_HOME_ALBUM_OLD));
                        ?>
                    </ul>
                </div>
                <div class="col">
                    <div class="box_header d-flex justify-content-between align-items-end">
                        <a class="view_all" href="/mp3/vietnam.html?tab=vua-download"> <h5 class="title m-0">Download mới nhất</h5></a>
                        <a class="link_more" href="/mp3/vietnam.html?tab=vua-download" title="Xem tất cả download">Xem tất cả</a>
                    </div>
                    <ul class="list-unstyled list_music">
                        <?php
                            array_map(function($item) {
                            $url= $item['music_url'];;
                            ?>
                            <li class="media align-items-stretch">
                                <div class="media-left align-items-stretch mr-2 items-stretch-{{$item['music_id']}}">
                                    <a href="{{$url}}" title="">
                                        <img src="{{$item['cover_html']}}" alt="{{$item['music_title']}}">
                                        <i class="material-icons">play_circle_outline</i>
                                        @if($item['cat_id'] == CAT_BEAT)
                                            <p class="time text-white mb-0 py-1">Beat</p>
                                        @endif
                                    </a>
                                </div>
                                <div class="media-body align-items-stretch d-flex flex-column justify-content-between p-0">
                                    <div>
                                        <h5 class="media-title mt-0 mb-0 title_home_tablet"><a href="{{$url}}" title="{{$item['music_shortlyric'] ?? $item['music_title']}}">{{$item['music_title']}}</a></h5>
                                        <div class="author title_home_tablet"><?php echo $item['music_artist_html'] ?></div>
                                    </div>
                                    <small class="type_music c1"><?php echo $item['music_bitrate_html']; ?></small>
                                </div>
                                <div class="media-right align-self-center">
                                    <small class="time_stt"><?php echo Helpers::timeElapsedString($item['music_time']); ?></small>
                                    <ul class="list-inline">
                                        <li class="list-inline-item"><a href="{{$url}}" title="nghe riêng nhạc {{$item['music_title']}}"target="_blank" ><i class="material-icons">headset</i></a></li>
                                        <li class="list-inline-item"><a onclick="addPlaylistTable('{{str_replace("'", "\'", $item['music_title'])}}', {{$item['music_id']}}, {{isset($item['music_artist']) ? "'".$item['music_artist']."'" : "'false'"}}, {{isset($item['music_artist_id']) ? "'".$item['music_artist_id']."'" : "'false'"}})" href="javascript:void(0)" title="thêm vào playlist"><i class="material-icons">playlist_add</i></a></li>
                                        <li class="list-inline-item"><a href="{{Helpers::fbShareLink($url)}}" class="fb-share-link" target="_blank" title="chia sẻ {{$item['music_title']}}"><i class="material-icons">share</i></a></li>
                                    </ul>
                                </div>
                            </li>
                            <?php
                            }, Helpers::getRandLimitArr($download_rows, LIMIT_HOME_ALBUM_OLD))
                        ?>
                    </ul>
                </div>
                <div class="box_show_add_playlist show_add_playlist card" style="display: none" id="answer-12878316">
                    <div class="card-body d-flex flex-column">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                        <h5 class="card-title box_add_playlist"></h5>
                        <div class="box_show_playlist_popup box_show_playlist mb-2">
                            <div class="list-group">

                            </div>
                        </div>
                        <div class="input-group create_playlist">
                            <input type="text" class="form-control box_text_create_playlist" placeholder="Nhập tên playlist mới cần tạo" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" onclick="btnCreatePlaylist('box_text_create_playlist')" type="button">Tạo Playlist mới</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box_catalog owl-carousel owl-theme">
                @foreach($catalog as $key => $val)
                <a href="/chu-de/{{$key}}.html" title="" class="item img-thumbnail swiper-slide" style="background: url('/imgs/chude/{{$val['img_web']}}') no-repeat;"><span>{{$val['label']}}</span></a>
                @endforeach
            </div>
            <!-- Initialize Carousel -->
            <script>
                $('.box_catalog').owlCarousel({
                    margin:10,
                    loop:true,
                    autoWidth:true,
                    items:4,
                    dots:false,
                    nav:true,
                    navText: ['<i class="material-icons">keyboard_arrow_left</i>','<i class="material-icons">keyboard_arrow_right</i>'],
                })
            </script>
            <div class="box_header d-flex justify-content-between align-items-end">
                <a class="view_all" href="/album-moi.html"><h5 class="title m-0">Album mới</h5></a>
                <a class="link_more" href="/album-moi.html" title="Album mới">Xem tất cả</a>
            </div>
            <div class="row row10px float-col-width">
                <?php
                $albumNew = Helpers::getRandLimitArr($album_old, LIMIT_HOME_ALBUM_NEW_BOTTOM);
                array_map(function ($i, $item) {
                ?>
                    @if ($i == 5)
                    </div>
                    <div class="row row10px">
                    @endif
                        <div class="col">
                            <div class="card card1">
                                <div class="card-header" style="background-image: url({{$item['cover_url']}});">
                                    <a href="{{$item['album_url']}}" title="{{$item['music_album']}}">
                                        <span class="icon-play"></span>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title"><a href="{{$item['album_url']}}" title="{{$item['music_album']}}">{{$item['music_album']}}</a><span class="year-album"> ({{CURRENT_YEAR}})</span></h3>
                                    <p class="card-text"><?php echo $item['music_artist_html'] ?></p>
                                </div>
                            </div>
                        </div>
                <?php
                }, array_keys($albumNew), $albumNew);
                ?>

            </div>
            <div class="box_header d-flex justify-content-between align-items-end">
                <a class="view_all" href="/video-moi.html"><h5 class="title m-0">Video mới</h5></a>
                <a class="link_more" href="/video-moi.html" title="Xem tất Cả Video">Xem tất cả</a>
            </div>
            <div class="row row10px float-col-width-video">
                <?php
                $videoMusic = Helpers::getRandLimitArr($video_new_uploads, LIMIT_HOME_VIDEO_NEW);
                array_map(function ($item) {
                $url= $item['music_url'];
                    ?>
                    <div class="col">
                        <div class="card card1 video">
                            <div class="card-header" style="background-image: url({{$item['cover_html']}});">
                                <a href="{{$url}}" title="{{$item['music_title']}}">
                                    <span class="icon-play"></span>
                                </a>
                            </div>
                            <div class="card-body">
                                <h3 class="card-title"><a href="{{$url}}" title="{{$item['music_title']}}">{{$item['music_title']}}</a></h3>
                                <p class="card-text"><?php echo $item['music_artist_html'] ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                }, $videoMusic)
                ?>
            </div>
        </div>
        <div class="col-md-3 home-bxh">
            <div class="box_header d-flex justify-content-between align-items-end">
                <a class="view_all" href="/nhac-hot.html"><h5 class="title m-0">Bảng xếp hạng</h5></a>
                <a class="link_more" href="/nhac-hot.html" title="">Nghe tất cả<span class="ion-android-arrow-dropright-circle"></span></a>
            </div>
            <ul class="nav nav-tabs" id="myTab_bxh" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-link-bxh="/nhac-hot.html" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">việt nam</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-link-bxh="/nhac-hot.html?tab=us-uk" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">us-uk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-link-bxh="/nhac-hot.html?tab=korea" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">k-pop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-link-bxh="/nhac-hot.html?tab=japan" id="jpop-tab" data-toggle="tab" href="#jpop" role="tab" aria-controls="jpop" aria-selected="false">j-pop</a>
                </li>
            </ul>
            <script>
                $('.home-bxh .nav-tabs').find('.nav-link').click(function () {
                    $('.home-bxh .link_more').attr('href', $(this).data('link-bxh'));
                })
            </script>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <ul class="list-unstyled bxh mb-0">
                        <?php
                        $catMusic = array_slice($hot_music_rows[3], 0, LIMIT_HOME_CAT_MUSIC);
                        array_map(function ($i, $item) {
                        $musicId = Helpers::music_id($item);
                        $url = SUB_BXH_NOW_MUSIC.'vietnam.html?playlist='.++$i;
                        ?>
                        <li class="media {{($i == 1 ? 'first stand' : ($i == 2 ? 'now up' : ($i == 3 ? 'now down' : 'now')))}} align-items-stretch">
                            <div class="media-left mr-3">
                                <span></span>
                                <a href="{{$url}}" title="{{$item['music_title']}}"><img src="{{$item['cover_html']}}" alt="{{$item['music_title']}}">
                                    @if($item['cat_id'] == CAT_BEAT)
                                        <p class="time time-bxh-home text-white mb-0 py-1">Beat</p>
                                    @endif
                                </a>
                            </div>
                            <div class="media-body d-flex flex-column {{$i == 1 ? '' : 'justify-content-between'}}">
                                <h5 class="media-title mt-0 mb-0"><a href="{{$url}}" title="{{$item['music_shortlyric'] ?? $item['music_title']}}">{{$item['music_title']}}</a></h5>
                                <div class="{{$i == 1 ? '' : 'd-flex'}} align-items-center justify-content-between">
                                    <div class="author"><?php echo $item['music_artist_html'] ?></div>
                                    <small class="counter_view">{{number_format($item['music_listen'])}}</small>
                                </div>
                            </div>
                        </li>
                        <?php
                        },array_keys($catMusic), $catMusic)
                        ?>
                    </ul>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <ul class="list-unstyled bxh mb-0">
                    <?php
                    $catMusic = array_slice($hot_music_rows[4], 0, LIMIT_HOME_CAT_MUSIC);
                    array_map(function ($i, $item) {
                    $musicId = Helpers::music_id($item);
                    $url = SUB_BXH_NOW_MUSIC.'us-uk.html?playlist='.++$i;
                    ?>
                    <li class="media {{($i == 1 ? 'first stand' : ($i == 2 ? 'now up' : ($i == 3 ? 'now down' : 'now')))}} align-items-stretch">
                        <div class="media-left mr-3">
                            <span></span>
                            <a href="{{$url}}" title="{{$item['music_title']}}"><img src="{{$item['cover_html']}}" alt="{{$item['music_title']}}">
                            @if($item['cat_id'] == CAT_BEAT)
                                <p class="time time-bxh-home text-white mb-0 py-1">Beat</p>
                            @endif
                            </a>
                        </div>
                        <div class="media-body d-flex flex-column {{$i == 1 ? '' : 'justify-content-between'}}">
                            <h5 class="media-title mt-0 mb-0"><a href="{{$url}}" title="{{$item['music_shortlyric'] ?? $item['music_title']}}">{{$item['music_title']}}</a></h5>
                            <div class="{{$i == 1 ? '' : 'd-flex'}} align-items-center justify-content-between">
                                <div class="author"><?php echo Helpers::rawHtmlArtists($item['music_artist_id'], $item['music_artist']) ?></div>
                                <small class="counter_view">{{number_format($item['music_listen'])}}</small>
                            </div>
                        </div>
                    </li>
                    <?php
                    },array_keys($catMusic), $catMusic)
                    ?>
                    </ul>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <ul class="list-unstyled bxh mb-0">
                    <?php
                    $catMusic = array_slice($hot_music_rows[6], 0, LIMIT_HOME_CAT_MUSIC);
                    array_map(function ($i, $item) {
                    $musicId = Helpers::music_id($item);
                    $url = SUB_BXH_NOW_MUSIC.'korea.html?playlist='.++$i;
                    ?>
                    <li class="media {{($i == 1 ? 'first stand' : ($i == 2 ? 'now up' : ($i == 3 ? 'now down' : 'now')))}} align-items-stretch">
                        <div class="media-left mr-3">
                            <span></span>
                            <a href="{{$url}}" title="{{$item['music_title']}}"><img src="{{$item['cover_html']}}" alt="{{$item['music_title']}}">
                            @if($item['cat_id'] == CAT_BEAT)
                                <p class="time time-bxh-home text-white mb-0 py-1">Beat</p>
                            @endif
                            </a>
                        </div>
                        <div class="media-body d-flex flex-column {{$i == 1 ? '' : 'justify-content-between'}}">
                            <h5 class="media-title mt-0 mb-0"><a href="{{$url}}" title="{{$item['music_shortlyric'] ?? $item['music_title']}}">{{$item['music_title']}}</a></h5>
                            <div class="{{$i == 1 ? '' : 'd-flex'}} align-items-center justify-content-between">
                                <div class="author"><?php echo Helpers::rawHtmlArtists($item['music_artist_id'], $item['music_artist']) ?></div>
                                <small class="counter_view">{{number_format($item['music_listen'])}}</small>
                            </div>
                        </div>
                    </li>
                    <?php
                    },array_keys($catMusic), $catMusic)
                    ?>
                    </ul>
                </div>
                <div class="tab-pane fade" id="jpop" role="tabpanel" aria-labelledby="jpop-tab">
                    <ul class="list-unstyled bxh mb-0">
                    <?php
                    $catMusic = array_slice($hot_music_rows[7], 0, LIMIT_HOME_CAT_MUSIC);
                    array_map(function ($i, $item) {
                    $musicId = Helpers::music_id($item);
                    $url = SUB_BXH_NOW_MUSIC.'japan.html?playlist='.++$i;
                    ?>
                    <li class="media {{($i == 1 ? 'first stand' : ($i == 2 ? 'now up' : ($i == 3 ? 'now down' : 'now')))}} align-items-stretch">
                        <div class="media-left mr-3">
                            <span></span>
                            <a href="{{$url}}" title="{{$item['music_title']}}"><img src="{{$item['cover_html']}}" alt="{{$item['music_title']}}">
                            @if($item['cat_id'] == CAT_BEAT)
                                <p class="time time-bxh-home text-white mb-0 py-1">Beat</p>
                            @endif
                            </a>
                        </div>
                        <div class="media-body d-flex flex-column {{$i == 1 ? '' : 'justify-content-between'}}">
                            <h5 class="media-title mt-0 mb-0"><a href="{{$url}}" title="{{$item['music_shortlyric'] ?? $item['music_title']}}">{{$item['music_title']}}</a></h5>
                            <div class="{{$i == 1 ? '' : 'd-flex'}} align-items-center justify-content-between">
                                <div class="author"><?php echo Helpers::rawHtmlArtists($item['music_artist_id'], $item['music_artist']) ?></div>
                                <small class="counter_view">{{number_format($item['music_listen'])}}</small>
                            </div>
                        </div>
                    </li>
                    <?php
                    },array_keys($catMusic), $catMusic)
                    ?>
                    </ul>
                </div>
            </div>
            <div class="box_space"></div>
            <div class="box_header d-flex justify-content-between align-items-end" style="margin-top: 15px;">
                <a class="view_all" href="/bang-xep-hang/tuan.html"><h5 class="title m-0">BXH upload trong tuần</h5></a>
            </div>
            <ul class="list-unstyled bxh_week mb-0">
                <?php
                array_map(function ($i, $item) {
                ?>
                <li class="media {{($i == 0 ? 'stand' : ($i == 1 ? 'up' : ($i == 2 ? 'down' : '')))}}">
                    <div class="media-left align-self-center"><span></span></div>
                    <div class="media-body">
                        <h5 class="mt-0 mb-0 d-flex align-items-center justify-content-between">
                            <a href="/user/{{$item['music_user_id']}}" title="{{$item['music_username']}}">{{$item['music_username']}}</a>
                            <div class="counter_download">{{number_format($item['download_total'])}}</div>
                        </h5>
                        <div class="d-flex align-items-center justify-content-between">
                            <small class="counter_file">{{number_format($item['music_total'])}} upload (<?php echo Helpers::convertToReadableSize($item['size_total']); ?>)</small>
                            <small class="text">download</small>
                        </div>
                    </div>
                </li>
                <?php
                },array_keys($top_uploader_weeks), $top_uploader_weeks)
                ?>
            </ul>
            <div class="box_space"></div>
            <div class="box_header d-flex justify-content-between align-items-end" style="margin-top: 15px;">
                <a class="view_all" href="#"><h5 class="title m-0">Ca sĩ yêu thích</h5></a>
            </div>
            <div class="singer_grid">
                <?php
//                $artistRows = Helpers::getRandLimitArr($top_artist_rows, LIMIT_HOME_ARTIST);
                $artistRows = $top_artist_rows;
                array_map(function ($i, $item) {
                ?>
                    <a href="{{$item['artist_url']}}" title="{{$item['music_artist']}}" class="img-thumbnail singer {{$i == 0 ? 'c1' : ''}}" style="background-image: url({{$item['artist_avatar']}});">
                        <span>{{$item['music_artist']}}</span>
                    </a>
                <?php
                },array_keys($artistRows), $artistRows)
                ?>
            </div>
            <div class="box_space"></div>
        </div>
    </div>
</div>
@endsection
@section('contentJS')
<script>
    //////////////////////////
    ////Add Playlist////////
    ////////////////////////
    function loadPlayList(music_id) {
        <?php
        if(!Auth::check()) {
        ?>
        switchAuth('myModal_login');
        return false;
        <?php
            }
            ?>
        $.ajax({
            url: window.location.origin + "/user/playlist/danh-sach-playlist",
            type: "GET",
            dataType: "json",
            data: {music_id: music_id},
            beforeSend: function () {
                $('.box_show_playlist .list-group').html('');
                if(loaded) return false;
                loaded = true;
            },
            success: function(data) {
                if(data.success) {
                    var stringBoxHtml = '';
                    if(data.data) {
                        $.each(data.data, function (index, val) {
                            stringBoxHtml += stringItemBoxPlaylist(val.playlist_title, val.playlist_music_total, val.playlist_id, val.music_exists, val.playlist_time);
                        });
                    }
                    $('.box_show_playlist .list-group').html(stringBoxHtml);
                }else{
                    alertModal(data.message);
                }

            }
            });
    }
    function stringItemBoxPlaylist(playlist_title, playlist_music_total, playlist_id, music_exist, playlist_time){
        return '<div onclick="addBoxMusicPlaylist(' + playlist_id + ')" class="playlist_id_' + playlist_id + ' ' + (music_exist ? 'music-exists' : '') + '"><a href="javascript:void(0)" class="list-group-item list-group-item-action d-flex title_playlist">' + playlist_title + ' (<span>' + playlist_music_total + '</span>)' + (music_exist ? '<i class="material-icons icon-box-playlist"> check </i>' : '') + '</a></div>';
    }
    function stringItemPlaylist(playlist_title, playlist_music_total, playlist_id, music_exist, playlist_time){
        return '<li onclick="addMusicPlaylist(' + playlist_id + ', false, false, false)" class="d-flex justify-content-between playlist_id_' + playlist_id + ' ' + (music_exist ? 'music-exists' : '') + '"><a class="title_playlist" href="javascript:void(0)" title="' + playlist_title + '">' + playlist_title + ' (<span>' + playlist_music_total + '</span>)</a>' + (music_exist ? '<i class="material-icons"> check </i>' : '') + '<time>' + convertDateTime(playlist_time) + '</time></li>';
    }
    function btnCreatePlaylist(box_text_create_playlist) {
        var titlePlaylist = $('.' + box_text_create_playlist);
        <?php
        if(!Auth::check()) {
        ?>
        switchAuth('myModal_login');
        return false;
        <?php
            }
            ?>
        if(!titlePlaylist.val()) {
            alertModal('Bạn chưa nhập tên playlist mới.');
            return false;
        }
        $.ajax({
            url: window.location.origin + "/user/playlist/create-playlist",
            type: "POST",
            dataType: "json",
            data: {'music_id': musicId, 'playlist_title': titlePlaylist.val()},
            beforeSend: function () {
                if(loaded) return false;
                loaded = true;
            },
            success: function(data) {
                if(data.success) {
                    console.log(data.data);
                    $('.playlist-csn .list-unstyled').prepend(stringItemPlaylist(data.data.playlist_title, data.data.playlist_music_total, data.data.playlist_id, false, data.data.playlist_time));
                    $('.box_show_playlist_popup .list-group').prepend(stringItemBoxPlaylist(data.data.playlist_title, data.data.playlist_music_total, data.data.playlist_id, false, data.data.playlist_time));
                    titlePlaylist.val("");
                    $('.playlist-csn').animate({scrollTop: $('.playlist-csn .list-unstyled').height()}, 'slow');
                    $('.box_show_playlist_popup').animate({scrollTop: $('.box_show_playlist_popup .list-group').height()}, 'slow');
                }else{
                    alertModal(data.message);
                }
            }
        });
    }

    function addMusicPlaylist(playlistId, musicAddId, artistAdd, artistIdAdd) {
        const playlistIdSelect = $('.playlist_id_' + playlistId);
        var countPlaylist = playlistIdSelect.find('.title_playlist span');
        $.ajax({
            url: window.location.origin + "/user/playlist/add-music-playlist",
            type: "POST",
            dataType: "json",
            data: {'playlist_id': playlistId, 'music_id': (musicAddId == false ? musicId : musicAddId), 'artist': (artistAdd == false ? artists : artistAdd), 'artist_id': (artistIdAdd == false ? artistIds : artistIdAdd)},
            beforeSend: function () {
                if(loaded) return false;
                loaded = true;
                if(playlistIdSelect.hasClass('music-exists')) {
                    countPlaylist.html(parseInt(countPlaylist.html()) - 1);
                    playlistIdSelect.removeClass('music-exists');
                    playlistIdSelect.find('.material-icons').remove();
                }else{
                    countPlaylist.html(parseInt(countPlaylist.html()) + 1);
                    playlistIdSelect.addClass('music-exists');
                    playlistIdSelect.find('a').prepend('<i class="material-icons icon-box-playlist"> check </i>');
                }
            },
            success: function(data) {
                if(data.success) {
                    if(data.data) {
                    }else{
                    }
                }else{
                    alertModal(data.message);
                }
            }
        });
    }
    var boxMusicId = '';
    var boxArtists = '';
    var boxArtistIds = '';
    var musicId = '';
    function addPlaylistTable(musicName, setId, setArtist, setArtistId) {
        <?php
        if(!Auth::check()) {
            ?>
                switchAuth('myModal_login');
                return false;
            <?php
        }
        ?>
        boxMusicId = setId;
        musicId = setId;
        boxArtists = setArtist;
        boxArtistIds = setArtistId;
        $('.box_add_playlist').html('Thêm bài hát <span class="text-pink">' + musicName + '</span> vào danh sách Playlist');
        $('.show_add_playlist').css('display', 'inherit');
        $('body').append('<div id="boxOutPlaylist" style="display: block; z-index: 99999;" role="dialog" class="modal"> </div>');
        window.onclick = function(event) {
            if(event.target == document.getElementById('boxOutPlaylist')) {
                $('.show_add_playlist').css('display', 'none');
                $('#boxOutPlaylist').remove();
            }
        }
        loadPlayList(setId);
    }
    function addBoxMusicPlaylist(playlist_id) {
        addMusicPlaylist(playlist_id, boxMusicId, boxArtists, boxArtistIds);
    }
    $('.show_add_playlist').find('.close').on('click', function () {
        $('.show_add_playlist').css('display', 'none');
        $('#boxOutPlaylist').remove();
    })
    $(".show_add_playlist").draggable();
</script>
<style>
    .show_add_playlist {
        left: 275.5px;
        top: 980px;
    }
    .show_add_playlist .card-body{
        padding: 10px!important;
    }
</style>
@endsection