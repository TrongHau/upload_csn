<?php
use App\Library\Helpers;
$titleMeta = 'Danh sách nhạc vừa nghe - '. Config::get('constants.app.title');
global $memberVip;
$memberVip = Helpers::checkMemberVip();
?>
@section('meta')
    <meta name="copyright" content="{{env('APP_URL')}}" />
    <meta name="revisit-after" content="7 Days">
    <meta name="keywords" content="bang xep hang, music, mp3, m4a, flac, lossless, video, mv, hd, mp4, csn, nghe nhạc, tải nhạc, lời bài hát, lyrics">
    <meta name="description" content="Nghe nhạc online chất lượng cao kèm lyrics, chia sẻ và tải nhạc dạng mp3, mp4, m4a, lossless.">
    <link rel="canonical" href="{{url()->current()}}" />
    <link rel="image_src" href="{{env('APP_URL')}}/imgs/cover_bxh.png" />
    <meta name="title" content="{{$titleMeta}}" />
    <meta property="og:image" content="{{env('APP_URL')}}/imgs/cover_bxh.png" />
    <meta property="og:url" content="{{url()->current()}}" />
    <meta property="og:title" content="{{$titleMeta}}" />
    <meta property="og:description" content="Nghe nhạc online chất lượng cao kèm lyrics, chia sẻ và tải nhạc dạng mp3, mp4, m4a, lossless." />
    <meta property="og:type" content="website" />
    <meta property="og:updated_time" content="{{time()}}" />
@endsection
@extends('mobile.layouts.app')
@section('content')
<div class="header">
    @include('mobile.layouts.header_top')
    <!-- swiper1-->
    <div class="header_sub_menu">
        <div data-itemmenu="4" class="swiper-container swiper1">
            <div class="swiper-wrapper">
                <div class="swiper-slide tab-music selected">Nhạc vừa nghe</div>
                <div class="swiper-slide tab-video">Video vừa nghe</div>
            </div>
        </div>
    </div>
</div>
<main class="main">
    @if(!$memberVip)
    <div style="position: relative; text-align: center;">
{{--        @if(View::exists('cache.code_ads.mobile_masthead'))--}}
            @include('cache.code_ads.mobile_masthead')
        {{--@endif--}}
    </div>
    @endif
    <div class="sidebar_top">
        <!-- swiper2-->
        <div class="swiper-container swiper2">
            <div class="swiper-wrapper">
                <div class="swiper-slide block_bxhbaihat block_more tab-music music">
                    <?php
                    $i = 1;
                    array_map(function ($item) use (&$i) {
                    if($item->cat_id != CAT_VIDEO) {
                        $url =  Helpers::listen_url([
                            'music_id'=> $item->music_id,
                            'cat_id' => $item->cat_id,
                            'cat_level' => $item->cat_level,
                            'music_title_url' => $item->music_title_url,
                        ]);
                        ?>
                            <div class="element py-3 border-bottom">
                                <div class="number_wrap text-center text-orange_ d-inline-block align-middle mx-3">
                                    <p class="number m-0">{{$i}}</p>
                                </div>
                                <a href="{{$url}}"><div class="image100 mr-2 d-inline-block align-middle" style="background : url('{{Helpers::cover_url($item->cover_id)}}') no-repeat center;background-size: cover;">
                                    </div></a>
                                <div class="content d-inline-block align-middle">
                                    <a href="{{$url}}"><h6 class="name_song text-black mb-1 card-title">{{$item->music_title}}</h6></a>
                                    <p class="name_singer text-gray mb-1 author"><?php echo Helpers::rawHtmlArtists($item->music_artist_id, $item->music_artist) ?></p>
                                    <p class="loss text-pink mb-0"><?php echo Helpers::bitrate2str($item->music_bitrate); ?></p>
                                </div>
                            </div>
                        <?php
                        $i++;
                    }
                    }, $musics);
                    ?>
                </div>
                <div class="swiper-slide tab-video block_bxhvideo">
                        <?php
                        $i = 1;
                        array_map(function ($item) use (&$i) {
                        if($item->cat_id == CAT_VIDEO) {
                            $url =  Helpers::listen_url([
                                'music_id'=> $item->music_id,
                                'cat_id' => $item->cat_id,
                                'cat_level' => $item->cat_level,
                                'music_title_url' => $item->music_title_url,
                            ]);
                            ?>
                            <div class="element py-3 border-bottom">
                                <div class="number_wrap text-center text-orange_ d-inline-block align-middle mx-3">
                                    <p class="number m-0">{{$i}}</p>
                                </div>
                                <a href="{{$url}}">
                                    <div class="image mr-2 d-inline-block align-middle" style="background : url({{Helpers::thumbnail_url(['music_id' => $item->music_id, 'cat_id' => $item->cat_id])}}) no-repeat center;background-size: cover;">
                                        <p class="time"><img src="/mobile/assets/images/icon/ic_menu_clock.png" width="14"> {{$item->music_length >= 3600 ? gmdate("H:i:s", $item->music_length) : gmdate("i:s", $item->music_length)}}</p>
                                    </div>
                                </a>
                                <div class="content d-inline-block align-middle">
                                    <a href="{{$url}}"><h6 class="name_song text-black mb-1 card-title">{{$item->music_title}}</h6></a>
                                    <p class="name_singer text-gray mb-1 author"><?php echo Helpers::rawHtmlArtists($item->music_artist_id, $item->music_artist) ?></p>
                                    <p class="loss text-pink mb-0"><?php echo Helpers::bitrate2str($item->music_bitrate); ?></p>
                                </div>
                            </div>
                            <?php
                            $i++;
                        }
                        }, $musics);
                        ?>
                    </div>
            </div>
        </div>
    </div>
</main>
@endsection
