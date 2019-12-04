@section('in_home', true)

<?php
use App\Library\Helpers;
// global variable file /case
global $album_hot;
global $album_new;
global $album_old;
global $download_rows;
global $top_uploader_rows;
global $music_new_uploads;
global $video_new_uploads;
global $album_cat_new;
$catalog = config('constants.catalog');
global $memberVip;
$memberVip = Helpers::checkMemberVip();
?>
@extends('mobile.layouts.app')
@section('content')
    @include('cache.def_home_album')
    @include('cache.def_home_download')
    @include('cache.def_home_album_cat')
    <div class="header">
        @include('mobile.layouts.header_top')
        <!-- swiper1-->
        <div class="header_sub_menu">
            <div data-itemmenu="5" class="swiper-container swiper1">
                <div class="swiper-wrapper">
                    <div class="swiper-slide tabHome selected">Home</div>
                    <div class="swiper-slide theme_all">Chủ đề</div>
                    <div class="swiper-slide album_news">Album mới</div>
                    <div class="swiper-slide music_news">Bài hát mới</div>
                    <div class="swiper-slide video_news">Video mới</div>
                </div>
            </div>
        </div>
    </div>
    <main class="main">
        @if(!$memberVip)
        <div style="position: relative; text-align: center;">
{{--            @if(View::exists('cache.code_ads.mobile_masthead'))--}}
                @include('cache.code_ads.mobile_masthead')
            {{--@endif--}}
        </div>
        @endif
        <div class="sidebar_top">
            <!-- swiper2-->
            <div class="swiper-container swiper2">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div id="pills-home">
                            <div class="owl-carousel owl-theme slider_home pt-3">
                                <?php
                                array_map(function($item) {
                                ?>
                                <a href="{{$item['album_url']}}"><div class="item" style="background: url({{$item['cover_url']}}) no-repeat center;background-size: cover;">
                                        <div class="element text-white">
                                            <h6 class="name_song mb-1">{{$item['music_album']}}</h6>
                                            <p class="name_singer mb-1 author"><?php echo $item['music_artist'] ?></p>
                                            <p class="loss text-pink mb-0"><?php echo $item['music_bitrate_html'] ?></p>
                                        </div>
                                    </div></a>

                                <?php
                                }, Helpers::getRandLimitArr($album_new, LIMIT_HOME_ALBUM_NEW_MOBILE));
                                ?>
                            </div>
                            <div class="container">
                                <div class="block block_baihat">
                                    <div class="block_header d-flex flex-row justify-content-between mb-2">
                                        <h3 class="main_title text-pink mb-0">Bài hát mới nhất</h3>
                                        <a href="javascript:void(0);" onclick="tabHome('music_news')"><span class="text-gray align-self-end">Xem tất cả</span></a>
                                    </div>
                                    <div class="block_baihat_main block_more">
                                        <?php
                                        array_map(function($item) {
                                        $url = $item['music_url'];
                                        ?>
                                        <a href="{{$url}}"><div class="element mb-2">
                                            <div class="image100 mr-2 d-inline-block align-middle" style="background : url('{{$item['cover_html']}}') no-repeat center;background-size: cover;">
                                                @if($item['cat_id'] == CAT_BEAT)
                                                    <p class="time text-white mb-0 py-1">Beat</p>
                                                @endif
                                            </div>
                                            <div class="content d-inline-block align-middle">
                                                <h6 class="name_song text-black mb-1 card-title">{{$item['music_title']}}</h6>
                                                <p class="name_singer text-gray mb-1 author"><?php echo $item['music_artist']; ?></p>
                                                <p class="loss text-pink mb-0"><?php echo $item['music_bitrate_html']; ?></p>
                                            </div>
                                        </div></a>
                                        <?php
                                        }, Helpers::getRandLimitArr($music_new_uploads, LIMIT_HOME_ALBUM_OLD_MOBILE));
                                        ?>
                                    </div>
                                </div>
                                <div class="block block_detail_chude">
                                    <div class="block_header d-flex flex-row justify-content-between mb-2">
                                        <h3 class="main_title text-pink mb-0">Bảng xếp hạng</h3>
                                        <a href="/nhac-hot.html"><span class="text-gray align-self-end">Xem tất cả</span></a>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="/nhac-hot/vietnam.html"><div class="element rounded w-100 mb-2 d-flex flex-column justify-content-center text-center" style="background: url('/imgs/bxh/BXH Nhạc Việt Nam_ 245 x 140.png') no-repeat center;background-size: cover;">
                                                    <h5 class="text-white">VIỆT NAM</h5>
                                                </div></a>
                                        </div>
                                        <div class="col-6">
                                            <a href="/nhac-hot/us-uk.html"><div class="element rounded w-100 mb-2 d-flex flex-column justify-content-center text-center" style="background: url('/imgs/bxh/BXH Nhạc Us- UK _ 245 x 140.png') no-repeat center;background-size: cover;">
                                                    <h5 class="text-white">US-UK</h5>
                                                </div></a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="/nhac-hot/korea.html"><div class="element rounded w-100 mb-2 d-flex flex-column justify-content-center text-center" style="background: url('/imgs/bxh/BXH Nhạc Hàn _ 245 x 140.png') no-repeat center;background-size: cover;">
                                                    <h5 class="text-white">K-POP</h5>
                                                </div></a>
                                        </div>
                                        <div class="col-6">
                                            <a href="/nhac-hot/japan.html"><div class="element rounded w-100 mb-2 d-flex flex-column justify-content-center text-center" style="background: url('/imgs/bxh/BXH Nhạc Nhật _ 245 x 140.png') no-repeat center;background-size: cover;">
                                                    <h5 class="text-white">J-POP</h5>
                                                </div></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="block block_album">
                                    <div class="block_header d-flex flex-row justify-content-between mb-2">
                                        <h3 class="main_title text-pink mb-0">Album mới nhất {{date('Y', time())}}</h3>
                                        <a class="link_more" href="javascript:void(0);" onclick="tabHome('album_news')" title="Album mới nhất {{date('Y', time())}}"><span class="text-gray align-self-end">Xem tất cả</span></a>
                                    </div>
                                    <div class="block_album_main d-flex flex-wrap">
                                        <div class="slide-album owl-theme owl-carousel">
                                            <?php
                                            $newMusic = Helpers::getRandLimitArr($album_new, LIMIT_HOME_MUSIC_NEW);
                                            $newMusic1 = array_slice($newMusic, 0, 4);
                                            $newMusic2 = array_slice($newMusic, 5, 9);
                                            array_map(function ($item) {
                                            ?>
                                            <div class="item element">
                                                <a href="{{$item['album_url']}}"><div class="image rounded" style="background: url({{$item['cover_url']}}) no-repeat center;background-size: cover"></div></a>
                                                <div class="content mt-3">
                                                    <a href="{{$item['album_url']}}"><h6 class="name_song mb-1 card-title">{{$item['music_album']}}</h6></a>
                                                    <p class="name_singer text-gray mb-1 author"><?php echo $item['music_artist_html'] ?></p>
                                                    <p class="loss text-pink mb-0"><?php echo $item['music_bitrate_html'] ?></p>
                                                </div>
                                            </div>
                                            <?php
                                            }, $newMusic1)
                                            ?>
                                        </div>
                                        <div class="slide-album owl-theme owl-carousel">
                                            <?php
                                            array_map(function ($item) {
                                            ?>
                                            <div class="item element">
                                                <a href="{{$item['album_url']}}"><div class="image rounded" style="background: url({{$item['cover_url']}}) no-repeat center;background-size: cover"></div></a>
                                                <div class="content mt-3">
                                                    <a href="{{$item['album_url']}}"><h6 class="name_song mb-1 card-title">{{$item['music_album']}}</h6></a>
                                                    <p class="name_singer text-gray mb-1 author"><?php echo $item['music_artist_html'] ?></p>
                                                    <p class="loss text-pink mb-0"><?php echo $item['music_bitrate_html'] ?></p>
                                                </div>
                                            </div>
                                            <?php
                                            }, $newMusic2)
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="block block_detail_chude">
                                    <div class="block_header d-flex flex-row justify-content-between mb-2">
                                        <h3 class="main_title text-pink mb-0">Chủ đề</h3>
                                        <a href="javascript:void(0);" onclick="tabHome('theme_all')"><span class="text-gray align-self-end">Xem tất cả</span></a>
                                    </div>
                                    <div class="slide-chude owl-carousel owl-theme">
                                    @foreach($catalog as $key => $val)
                                        <div class="item">
                                            <a href="/chu-de/{{$key}}.html"><div class="element rounded w-100 mb-3 d-flex flex-column justify-content-center text-center" style="background: url('/imgs/chude/{{$val['img_web']}}') no-repeat center;background-size: cover;">
                                                    <h5 class="text-white">{{$val['label']}}</h5>
                                                </div></a>
                                        </div>
                                    @if($key == 3)
                                        @break;
                                    @endif
                                    @endforeach
                                    </div>
                                </div>
                                <div class="block block_video">
                                    <div class="block_header d-flex flex-row justify-content-between mb-2">
                                        <h3 class="main_title text-pink mb-0">Video mới nhất</h3>
                                        <a href="javascript:void(0);" onclick="tabHome('video_news')"><span class="text-gray align-self-end">Xem tất cả</span></a>
                                    </div>
                                    <div class="block_video_main d-flex flex-wrap">
                                        <?php
                                        $videoMusic = Helpers::getRandLimitArr($video_new_uploads, LIMIT_HOME_VIDEO_NEW_MOBILE);
                                        array_map(function ($item) {
                                        $url= $item['music_url'];
                                        ?>
                                        <div class="element">
                                            <a href="{{$url}}"><div class="image" style="background: url({{$item['cover_html']}}) no-repeat center;background-size: cover">
                                                    @if($item['music_listen'] > 0 )
                                                    <p class="view text-white mb-0 px-2 py-1"><img src="/mobile/assets/images/img_camera.png" width="16" /> <?php echo Helpers::numberShorten($item['music_listen']) ?></p>
                                                    @endif
                                                    <p class="time text-white mb-0 px-2 py-1"><img src="/mobile/assets/images/ic_menu_clock.png" width="14" /> {{$item['music_length'] >= 3600 ? gmdate("H:i:s", $item['music_length']) : gmdate("i:s", $item['music_length'])}}</p>
                                                </div></a>
                                            <div class="content mt-3">
                                                <a href="{{$url}}"><h6 class="name_song mb-1 card-title">{{$item['music_title']}}</h6></a>
                                                <p class="name_singer text-gray mb-1 author"><?php echo $item['music_artist_html'] ?></p>
                                            </div>
                                        </div>
                                        <?php
                                        }, $videoMusic)
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="container">
                            <div class="block block_detail_chude">
                                @foreach($catalog as $key => $val)
                                    <a href="/chu-de/{{$key}}.html"><div class="element rounded w-100 mb-3 d-flex flex-column justify-content-center text-center" style="background: url('/imgs/chude/{{$val['img_web']}}') no-repeat center;background-size: cover;">
                                            <h5 class="text-white">{{$val['label']}}</h5>
                                        </div></a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="container">
                            <div class="block block_album">
                                <div class="block_header d-flex flex-row justify-content-between mb-2">
                                    <h3 class="main_title text-pink mb-0">Album Việt Nam</h3>
                                    <span class="align-self-end"><a class="text-gray" href="/mp3/vietnam.html?tab=album-moi">Xem tất cả</a></span>
                                </div>
                                <div class="block_album_main d-flex flex-wrap">
                                    <div class="slide-album owl-theme owl-carousel">
                                        <?php
                                        $musicNewCat = Helpers::getRandLimitArr($album_cat_new[3], LIMIT_HOME_CAT_MUSIC);
                                        array_map(function ($item) {
                                        ?>
                                        <div class="item element">
                                            <a href="{{$item['album_url']}}"><div style="background: url({{$item['cover_url']}}) no-repeat center;background-size: cover;" class="image rounded"></div></a>
                                            <div class="content mt-3">
                                                <a href="{{$item['album_url']}}"><h6 class="name_song mb-1 card-title">{{$item['music_album']}}</h6></a>
                                                <p class="name_singer text-gray mb-1 author"><?php echo $item['music_artist_html'] ?></p>
                                                <p class="loss text-pink mb-0"><?php echo $item['music_bitrate_html'] ?></p>
                                            </div>
                                        </div>
                                        <?php
                                        }, $musicNewCat)
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="block block_album">
                                <div class="block_header d-flex flex-row justify-content-between mb-2">
                                    <h3 class="main_title text-pink mb-0">Album US-UK</h3>
                                    <span class="align-self-end"><a class="text-gray" href="/mp3/us-uk.html?tab=album-moi">Xem tất cả</a></span>
                                </div>
                                <div class="block_album_main d-flex flex-wrap">
                                    <div class="slide-album owl-theme owl-carousel owl-loaded owl-drag">
                                        <div class="owl-stage-outer">
                                            <div class="owl-stage" style="transform: translate3d(-584px, 0px, 0px); transition: all 0s ease 0s; width: 1559px;">
                                                <?php
                                                $musicNewCat = Helpers::getRandLimitArr($album_cat_new[4], LIMIT_HOME_CAT_MUSIC);
                                                array_map(function ($item) {
                                                ?>
                                                <div class="owl-item cloned" style="width: 184.783px; margin-right: 10px;">
                                                    <div class="item element">
                                                        <a href="{{$item['album_url']}}"><div class="image rounded" style="background: url({{$item['cover_url']}}) no-repeat center;background-size: cover"></div></a>
                                                        <div class="content mt-3">
                                                            <h6 class="name_song mb-1 card-title">{{$item['music_album']}}</h6>
                                                            <a href="{{$item['album_url']}}"><p class="name_singer text-gray mb-1 author"><?php echo $item['music_artist_html'] ?></p></a>
                                                            <p class="loss text-pink mb-0"><?php echo $item['music_bitrate_html'] ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                }, $musicNewCat)
                                                ?>
                                            </div>
                                        </div>
                                        <div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button><button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button></div>
                                        <div class="owl-dots disabled"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="block block_album">
                                <div class="block_header d-flex flex-row justify-content-between mb-2">
                                    <h3 class="main_title text-pink mb-0">Album Hoa</h3>
                                    <span class="align-self-end"><a class="text-gray" href="/mp3/chinese.html?tab=album-moi">Xem tất cả</a></span>
                                </div>
                                <div class="block_album_main d-flex flex-wrap">
                                    <div class="slide-album owl-theme owl-carousel owl-loaded owl-drag">
                                        <div class="owl-stage-outer">
                                            <div class="owl-stage" style="transform: translate3d(-584px, 0px, 0px); transition: all 0s ease 0s; width: 1559px;">
                                                <?php
                                                $musicNewCat = Helpers::getRandLimitArr($album_cat_new[5], LIMIT_HOME_CAT_MUSIC);
                                                array_map(function ($item) {
                                                ?>
                                                <div class="owl-item cloned" style="width: 184.783px; margin-right: 10px;">
                                                    <div class="item element">
                                                        <a href="{{$item['album_url']}}"><div class="image rounded" style="background: url({{$item['cover_url']}}) no-repeat center;background-size: cover"></div></a>
                                                        <div class="content mt-3">
                                                            <h6 class="name_song mb-1 card-title">{{$item['music_album']}}</h6>
                                                            <a href="{{$item['album_url']}}"><p class="name_singer text-gray mb-1 author"><?php echo $item['music_artist_html'] ?></p></a>
                                                            <p class="loss text-pink mb-0"><?php echo $item['music_bitrate_html'] ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                }, $musicNewCat)
                                                ?>
                                            </div>
                                        </div>
                                        <div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button><button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button></div>
                                        <div class="owl-dots disabled"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="block block_album">
                                <div class="block_header d-flex flex-row justify-content-between mb-2">
                                    <h3 class="main_title text-pink mb-0">Album K-Pop</h3>
                                    <span class="align-self-end"><a class="text-gray" href="/mp3/korea.html?tab=album-moi">Xem tất cả</a></span>
                                </div>
                                <div class="block_album_main d-flex flex-wrap">
                                    <div class="slide-album owl-theme owl-carousel owl-loaded owl-drag">
                                        <div class="owl-stage-outer">
                                            <div class="owl-stage" style="transform: translate3d(-584px, 0px, 0px); transition: all 0s ease 0s; width: 1559px;">
                                                <?php
                                                $musicNewCat = Helpers::getRandLimitArr($album_cat_new[6], LIMIT_HOME_CAT_MUSIC);
                                                array_map(function ($item) {
                                                ?>
                                                <div class="owl-item cloned" style="width: 184.783px; margin-right: 10px;">
                                                    <div class="item element">
                                                        <a href="{{$item['album_url']}}"><div class="image rounded" style="background: url({{$item['cover_url']}}) no-repeat center;background-size: cover"></div></a>
                                                        <div class="content mt-3">
                                                            <h6 class="name_song mb-1 card-title">{{$item['music_album']}}</h6>
                                                            <a href="{{$item['album_url']}}"><p class="name_singer text-gray mb-1 author"><?php echo $item['music_artist_html'] ?></p></a>
                                                            <p class="loss text-pink mb-0"><?php echo $item['music_bitrate_html'] ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                }, $musicNewCat)
                                                ?>
                                            </div>
                                        </div>
                                        <div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button><button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button></div>
                                        <div class="owl-dots disabled"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="block block_album">
                                <div class="block_header d-flex flex-row justify-content-between mb-2">
                                    <h3 class="main_title text-pink mb-0">Album J-Pop</h3>
                                    <span class="align-self-end"><a class="text-gray" href="/mp3/japan.html?tab=album-moi">Xem tất cả</a></span>
                                </div>
                                <div class="block_album_main d-flex flex-wrap">
                                    <div class="slide-album owl-theme owl-carousel owl-loaded owl-drag">
                                        <div class="owl-stage-outer">
                                            <div class="owl-stage" style="transform: translate3d(-584px, 0px, 0px); transition: all 0s ease 0s; width: 1559px;">
                                                <?php
                                                $musicNewCat = Helpers::getRandLimitArr($album_cat_new[7], LIMIT_HOME_CAT_MUSIC);
                                                array_map(function ($item) {
                                                ?>
                                                <div class="owl-item cloned" style="width: 184.783px; margin-right: 10px;">
                                                    <div class="item element">
                                                        <a href="{{$item['album_url']}}"><div class="image rounded" style="background: url({{$item['cover_url']}}) no-repeat center;background-size: cover"></div></a>
                                                        <div class="content mt-3">
                                                            <h6 class="name_song mb-1 card-title">{{$item['music_album']}}</h6>
                                                            <a href="{{$item['album_url']}}"><p class="name_singer text-gray mb-1 author"><?php echo $item['music_artist_html'] ?></p></a>
                                                            <p class="loss text-pink mb-0"><?php echo $item['music_bitrate_html'] ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                }, $musicNewCat)
                                                ?>
                                            </div>
                                        </div>
                                        <div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button><button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button></div>
                                        <div class="owl-dots disabled"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="container">
                            <div class="block block_baihat">
                                <div class="block_baihat_main block_more" id="music_news">
                                    <?php
                                    array_map(function($item) {
                                    $url = $item['music_url'];
                                    ?>
                                    <div class="element mb-2">
                                        <a href="{{$url}}"><div class="image100 mr-2 d-inline-block align-middle" style="background : url('{{$item['cover_html']}}') no-repeat center;background-size: cover;">
                                                @if($item['cat_id'] == CAT_BEAT)
                                                    <p class="time text-white mb-0 py-1">Beat</p>
                                                @endif
                                            </div></a>
                                        <div class="content d-inline-block align-middle">
                                            <a href="{{$url}}"><h6 class="name_song text-black mb-1 card-title">{{$item['music_title']}}</h6></a>
                                            <p class="name_singer text-gray mb-1 author"><?php echo $item['music_artist_html']; ?></p>
                                            <p class="loss text-pink mb-0"><?php echo $item['music_bitrate_html']; ?></p>
                                        </div>
                                    </div>
                                    <?php
                                    }, $music_new_uploads);
                                    ?>
                                    <center>
                                        <ul class="pagination">
                                            <li class="disabled"><span>«</span></li>
                                            <li class="active"><span>1</span></li>
                                            <li><a href="/tab_category?page=2">2</a></li>
                                            <li><a href="/tab_category?page=3">3</a></li>
                                            <li class="disabled"><span>...</span></li>
                                            <li><a href="/tab_category?page=51425">63425</a></li>
                                            <li><a href="/tab_category?page=51426">63426</a></li>
                                            <li><a href="/tab_category?page=2" rel="next">»</a></li>
                                        </ul>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="container">
                            <div class="block_bxhvideo block_more">
                                <div class="block_baihat_main block_more" id="video_news">
                                    <?php
                                    array_map(function($item) {
                                    $url = $item['music_url'];
                                    ?>
                                    <div class="element py-3 border-bottom">
                                        <a href="{{$url}}">
                                            <div class="image mr-2 d-inline-block align-middle" style="background : url({{$item['cover_html']}}) no-repeat center;background-size: cover;">
                                                <p class="time"><img src="/mobile/assets/images/icon/ic_menu_clock.png" width="14"> {{$item['music_length'] >= 3600 ? gmdate("H:i:s", $item['music_length']) : gmdate("i:s", $item['music_length'])}}</p>
                                            </div>
                                        </a>
                                        <div class="content d-inline-block align-middle">
                                            <a href="{{$url}}"><h6 class="name_song text-black mb-1 card-title">{{$item['music_title']}}</h6></a>
                                            <p class="name_singer text-gray mb-1 author"><?php echo $item['music_artist_html']; ?></p>
                                        </div>
                                    </div>
                                    <?php
                                    }, $video_new_uploads);
                                    ?>
                                    <center>
                                        <ul class="pagination">
                                            <li class="disabled"><span>«</span></li>
                                            <li class="active"><span>1</span></li>
                                            <li><a href="/tab_category?page=2">2</a></li>
                                            <li><a href="/tab_category?page=3">3</a></li>
                                            <li class="disabled"><span>...</span></li>
                                            <li><a href="/tab_category?page=51425">51425</a></li>
                                            <li><a href="/tab_category?page=51426">51426</a></li>
                                            <li><a href="/tab_category?page=2" rel="next">»</a></li>
                                        </ul>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('contentJS')
    <script>
        function tabHome(tab) {
            $('.' + tab).click();
        }
        $('#music_news').find('.pagination li a').on('click', function (e) {
            e.preventDefault();
            musicPage($(this).attr('href'), 'music_news');
        });
        $('#video_news').find('.pagination li a').on('click', function (e) {
            e.preventDefault();
            musicPage($(this).attr('href'), 'video_news');
        });
        function musicPage(url, tab) {
            $.ajax({
                url: window.location.origin + url,
                type: "POST",
                dataType: "html",
                data: {
                    'tab': tab == 'music_news' ? 'music' : tab == 'video_news' ? 'video' : 'cover'
                },
                beforeSend: function () {
                    if(loaded) return false;
                    loaded = true;
                    $('html,body').animate({ scrollTop: 0 }, 400);
                },
                success: function(response) {
                    $('#' + tab).html(response);
                    $('#' + tab).find('.pagination li a').on('click', function (e) {
                        e.preventDefault();
                        musicPage($(this).attr('href'), tab);
                    });
                    swiper2.update();
                }
            });
        }
    </script>
@endsection
