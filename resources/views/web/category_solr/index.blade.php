<?php
use App\Library\Helpers;
$titleMeta = $caption . ' - '. Config::get('constants.app.title');
global $hot_music_rows;
if($category->cat_id == CAT_VIDEO)
    global $hot_video_rows;
$bxhCatExists = false;
$parentTitle = str_replace('Nhạc ', '', explode(" >", $caption)[0]);
if($category->cat_id == 3 || $category->cat_id == 4 || $category->cat_id == 6 || $category->cat_id == 7)
    $bxhCatExists = true;
?>
@section('meta')
    <meta name="copyright" content="{{env('APP_URL')}}" />
    <meta name="revisit-after" content="7 Days">
    <meta name="keywords" content="bang xep hang, music, mp3, m4a, flac, lossless, video, mv, hd, mp4, csn, nghe nhạc, tải nhạc, lời bài hát, lyrics">
    <meta name="description" content="Nghe nhạc online chất lượng cao kèm lyrics, chia sẻ và tải nhạc dạng mp3, mp4, m4a, lossless.">
    <link rel="canonical" href="{{url()->current()}}" />
    <link rel="image_src" href="{{env('APP_URL')}}/imgs/no_cover.png" />
    <meta name="title" content="{{$titleMeta}}" />
    <meta property="og:image" content="{{env('APP_URL')}}/imgs/no_cover.png" />
    <meta property="og:url" content="{{url()->current()}}" />
    <meta property="og:title" content="{{$titleMeta}}" />
    <meta property="og:description" content="Nghe nhạc online chất lượng cao kèm lyrics, chia sẻ và tải nhạc dạng mp3, mp4, m4a, lossless." />
    <meta property="og:type" content="website" />
    <meta property="og:updated_time" content="{{time()}}" />
@endsection
@include('cache.bxh.bxh_today')
@extends('web.layouts.app')
@section('contentCSS')
    <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/css/TabStylesInspiration/normalize.css">
    <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/css/TabStylesInspiration/tabs.css">
    <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/css/TabStylesInspiration/tabstyles.css">
@endsection
@section('content')
    <div class="container">
        <div class="row row_wrapper">
            <div class="col-md-9">
                <div class="tabs tabs-style-line tab-category">
                    <div class="media media-tab">
                        <div class="media-left">
                            <h2 class="media-title">{{$caption}}</h2>
                        </div>
                    </div>
                    @if($category->cat_id != CATEGORY_ID_VIDEO)
                    <nav>
                        <ul>
                            <li class="tab-current"><a onclick="categoryTab('/tab_category', 'album-{{CURRENT_YEAR}}')" class="album-{{CURRENT_YEAR}}" href="#album_{{CURRENT_YEAR}}"><span>Album {{CURRENT_YEAR}}</span></a></li>
                            <li><a onclick="categoryTab('/tab_category', 'album-moi')" class="album-moi" href="#album-moi"><span>ALbum mới</span></a></li>
                            <li><a onclick="categoryTab('/tab_category', 'bai-hat-moi')" class="bai-hat-moi" href="#bai-hat-moi"><span>Bài Hát mới</span></a></li>
                            <li><a onclick="categoryTab('/tab_category', 'vua-download')" class="vua-download" href="#vua-download"><span>Vừa download</span></a></li>
                        </ul>
                    </nav>
                    <div class="content-wrap tab-content-category">
                        <section id="album-{{CURRENT_YEAR}}" class="content-current"><?php echo $firstTab ?></section>
                        <section id="album-moi"></section>
                        <section id="bai-hat-moi"></section>
                        <section id="vua-download"></section>
                    </div>
                    @else
                    <nav>
                        <ul>
                            <li class="tab-current video-{{CURRENT_YEAR}}"><a onclick="categoryTab('/tab_category', 'video-{{CURRENT_YEAR}}')" href="#video-{{CURRENT_YEAR}}"><span>Video {{CURRENT_YEAR}}</span></a></li>
                            <li class="video-moi"><a class="video-moi" onclick="categoryTab('/tab_category', 'video-moi')" href="#video-moi"><span>Video mới</span></a></li>
                            <li class="video-vua-download"><a class="video-vua-download" onclick="categoryTab('/tab_category', 'video-vua-download')" href="#video-vua-download"><span>Vừa download</span></a></li>
                        </ul>
                    </nav>
                    <div class="content-wrap tab-content-category">
                        <section id="video-{{CURRENT_YEAR}}" class="content-current"><?php echo $firstTab ?></section>
                        <section id="video-moi"></section>
                        <section id="video-vua-download"></section>
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                @include('web.layouts.right_banner', ['short' => true])
                <div class="box_space"></div>
                <div class="box_header d-flex justify-content-between align-items-end">
                    <a class="view_all" href="/nhac-hot.html"><h5 class="title m-0">Bảng xếp hạng</h5></a>
                    <a class="link_more" href="/nhac-hot.html?tab={{$category->cat_url}}" title="">Nghe tất cả<span class="ion-android-arrow-dropright-circle"></span></a>
                </div>
                <ul class="nav nav-tabs" id="myTab_bxh" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link {{$category->cat_id == 3 ? 'active' : ''}}" data-link-bxh="/nhac-hot.html" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">việt nam</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{$category->cat_id == 4 ? 'active' : ''}}" data-link-bxh="/nhac-hot.html?tab=us-uk" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">us-uk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{$category->cat_id == 6 ? 'active' : ''}}" data-link-bxh="/nhac-hot.html?tab=korea" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">k-pop</a>
                    </li>
                    @if($bxhCatExists)
                    <li class="nav-item">
                        <a class="nav-link {{$category->cat_id == 7 ? 'active' : ''}}" data-link-bxh="/nhac-hot.html?tab=japan" id="jpop-tab" data-toggle="tab" href="#jpop" role="tab" aria-controls="jpop" aria-selected="false">j-pop</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link active" id="jpop-tab" data-toggle="tab" data-link-bxh="/nhac-hot.html?tab={{$category->cat_url}}" href="#jpop" role="tab" aria-controls="jpop" aria-selected="false">{{$parentTitle}}</a>
                    </li>
                    @endif
                </ul>
                <script>
                    $('.home-bxh .nav-tabs').find('.nav-link').click(function () {
                        $('.home-bxh .link_more').attr('href', $(this).data('link-bxh'));
                    })
                </script>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade {{$category->cat_id == 3 ? 'show active' : ''}}" id="home" role="tabpanel" aria-labelledby="home-tab">
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
                                    <a href="{{$url}}" title="{{$item['music_title']}}"><img src="{{Helpers::cover_url($item['cover_id'])}}" alt="{{$item['music_title']}}"></a>
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
                    <div class="tab-pane fade {{$category->cat_id == 4 ? 'show active' : ''}}" id="profile" role="tabpanel" aria-labelledby="profile-tab">
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
                                    <a href="{{$url}}" title="{{$item['music_title']}}"><img src="{{Helpers::cover_url($item['cover_id'])}}" alt="{{$item['music_title']}}"></a>
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
                    <div class="tab-pane fade {{$category->cat_id == 6 ? 'show active' : ''}}" id="contact" role="tabpanel" aria-labelledby="contact-tab">
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
                                    <a href="{{$url}}" title="{{$item['music_title']}}"><img src="{{Helpers::cover_url($item['cover_id'])}}" alt="{{$item['music_title']}}"></a>
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
                    @if($bxhCatExists)
                        <div class="tab-pane fade {{$category->cat_id == 7 ? 'show active' : ''}}" id="jpop" role="tabpanel" aria-labelledby="jpop-tab">
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
                                        <a href="{{$url}}" title="{{$item['music_title']}}"><img src="{{Helpers::cover_url($item['cover_id'])}}" alt="{{$item['music_title']}}"></a>
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
                    @else
                        <div class="tab-pane fade show active" id="jpop" role="tabpanel" aria-labelledby="jpop-tab">
                            <ul class="list-unstyled bxh mb-0">
                                <?php
                                $preFixUrl = $category->cat_url == 'video' ? 'v-video' : $category->cat_url;
                                if($category->cat_id == CAT_VIDEO){
                                    $preFixUrl = 'video/'.$preFixUrl;
                                    $bxhVideo = $hot_video_rows[$category->cat_level == 0 ? 1 : $category->cat_level] ?? $hot_video_rows[1];
                                    $catMusic = $hot_video_rows ? array_slice($bxhVideo, 0, LIMIT_HOME_CAT_MUSIC) : [];
                                }else{
                                    $catMusic = $hot_music_rows ? array_slice($hot_music_rows[$category->cat_id], 0, LIMIT_HOME_CAT_MUSIC) : [];
                                }
                                array_map(function ($i, $item) use ($category, $preFixUrl) {
                                $musicId = Helpers::music_id($item);
                                $url = SUB_BXH_NOW_MUSIC.$preFixUrl.'.html?playlist='.++$i;
                                ?>
                                <li class="media {{($i == 1 ? 'first stand' : ($i == 2 ? 'now up' : ($i == 3 ? 'now down' : 'now')))}} align-items-stretch">
                                    <div class="media-left mr-3">
                                        <span></span>
                                        <a href="{{$url}}" title="{{$item['music_title']}}"><img src="{{$category->cat_id == CAT_VIDEO ? Helpers::thumbnail_url($item) : Helpers::cover_url($item['cover_id'])}}" alt="{{$item['music_title']}}"></a>
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
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
@section('contentJS')
<script src="/js/cbpFWTabs.js"></script>
<script>
    (function() {
        [].slice.call( document.querySelectorAll( '.tabs' ) ).forEach( function( el ) {
            new CBPFWTabs( el );
        });
    })();
    $('#album-<?php echo CURRENT_YEAR ?>').find('.pagination li a').on('click', function (e) {
        e.preventDefault();
        categoryTab($(this).attr('href'), 'album-<?php echo CURRENT_YEAR ?>', true);
    });
    $('#video-<?php echo CURRENT_YEAR ?>').find('.pagination li a').on('click', function (e) {
        e.preventDefault();
        categoryTab($(this).attr('href'), 'video-<?php echo CURRENT_YEAR ?>', true);
    });
    var urlFloat = '';
    // jQuery
    window.addEventListener('popstate', function(e) {
        // var state = e.originalEvent.state;
        var tab = findGetParameter('tab');
        var page = findGetParameter('page');
        urlFloat = '/tab_category' + (page ? '?page=' + page : '');
        if(tab == null) {
            $('.album-<?php echo CURRENT_YEAR ?>').parent().click();
            $('.album-<?php echo CURRENT_YEAR ?>').click();
        }else{
            $('.' + tab).parent().click();
            $('.' + tab).click();
        }
    });


    function categoryTab(url, tab, floatTab = false, pushHistory = true) {
        if(!urlFloat) {
            var page = parseFloat(url.substr(url.indexOf("?page=") + 6));
            page = isNaN(page) ? 1 : page;
            window.history.pushState({}, '', window.location.pathname + '?tab=' + tab + (page != 1 ? '&page=' + page : ''));
        }
        if(urlFloat) {
            floatTab = true;
            url = urlFloat;
            urlFloat = '';
        }
        if(($('#'+tab).html()).length == 0 || floatTab) {
            $.ajax({
                url: window.location.origin + url,
                type: "POST",
                dataType: "html",
                data: {
                    'cat_id': <?php echo $category->cat_id; ?>,
                    'cat_level' : <?php echo $category->cat_level; ?>,
                    'tab': tab ? tab : 'album_<?php echo CURRENT_YEAR ?>'
                },
                beforeSend: function () {
                    if(loaded) return false;
                    loaded = true;
                    $('html,body').animate({ scrollTop: 0 }, 400);
                },
                success: function(response) {
                    waitingDialog.hide();
                    $('#'+tab).html(response);
                    $('#'+tab).find('.pagination li a').on('click', function (e) {
                        e.preventDefault();
                        categoryTab($(this).attr('href'), tab, true);
                    });
                }
            });
        }
    }
    <?php
        if(isset($_GET['tab'])) {
            ?>
            $( document ).ready(function() {
                $('.<?php echo $_GET['tab'] ?>').parent().click();
                $('.<?php echo $_GET['tab'] ?>').click();
            });
            <?php
        }
    ?>
    if(!$('.tab-content-category').find('section').first().html()) {
        $('.tab-category').find('li:nth-child(2)').click();
        $('.tab-category').find('li:nth-child(2)').find('a').click();
    }
</script>
@endsection


