<?php
use App\Library\Helpers;
$titleMeta = $caption . ' - '. Config::get('constants.app.title');
?>
@section('meta')
    <meta name="copyright" content="{{env('APP_URL')}}" />
    <meta name="revisit-after" content="7 Days">
    <meta name="keywords" content="bang xep hang, music, mp3, m4a, flac, lossless, video, mv, hd, mp4, csn, nghe nhạc, tải nhạc, lời bài hát, lyrics">
    <meta name="description" content="Nghe nhạc online chất lượng cao kèm lyrics, chia sẻ và tải nhạc dạng mp3, mp4, m4a, lossless.">
    <link rel="canonical" href="{{url()->current()}}" />
    <link rel="image_src" href="{{env('APP_URL')}}/imgs/cover_bxh.png" />
    <meta name="title" content="{{$caption}}" />
    <meta property="og:image" content="{{env('APP_URL')}}/imgs/cover_bxh.png" />
    <meta property="og:url" content="{{url()->current()}}" />
    <meta property="og:title" content="{{$caption}}" />
    <meta property="og:description" content="Nghe nhạc online chất lượng cao kèm lyrics, chia sẻ và tải nhạc dạng mp3, mp4, m4a, lossless." />
    <meta property="og:type" content="website" />
    <meta property="og:updated_time" content="{{time()}}" />
@endsection
@extends('mobile.layouts.app')
@section('contentCSS')
@endsection
@section('content')
    <div class="header">
        @include('mobile.layouts.header_top')
    </div>
    <main class="main main_player">
        <div class="sidebar_top">
            <div id="pills-tabContent" class="tab-content">
                <div id="pills-thongtin" role="tabpanel" aria-labelledby="pills-thongtin-tab" class="tab-pane fade active show">
                    <div class="block_thongtin">
                        <div class="swiper-container swiper2 swiper-container-horizontal swiper-container-autoheight">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide swiper-slide-active">
                                    <div class="container">
                                        <div class="block block_album block_profile_playlist">
                                            <div class="block_header d-flex flex-row justify-content-between mb-2">
                                                <h3 class="main_title text-pink mb-0">{{$caption}}</h3>
                                            </div>
                                            <div class="row row-sm" id="album">
                                                <?php
                                                array_map(function ($item) {
                                                $url = Helpers::playlist_url($item);
                                                ?>
                                                <div class="col-6">
                                                    <div class="item element">
                                                        <a href="{{$url}}"><div style="background: url({{$item['playlist_cover'] ? Helpers::file_path($item['playlist_id'], env('DATA_URL').MUSIC_PLAYLIST_PATH, true).$item['playlist_id'] . '.png?v=' . time() : '/imgs/avatar_default.png'}}) no-repeat center;background-size: cover;" class="image rounded"></div></a>
                                                        <div class="content mt-3">
                                                            <a href="{{$url}}"><h6 class="name_song mb-1 card-title">{{$item['playlist_title']}}</h6></a>
                                                            <p class="name_singer text-gray mb-1 author">
                                                                <?php
                                                                $artistPlaylist = unserialize($item['playlist_artist']);
                                                                if($artistPlaylist) {
                                                                    $artistNames = [];
                                                                    $artistIds = [];
                                                                    $i = 0;
                                                                    foreach($artistPlaylist as $key => $item) {
                                                                        $artistNames[] = $item['name'];
                                                                        $artistIds[] = $key;
                                                                        if(++$i == 2)
                                                                            break;
                                                                    }
                                                                    echo Helpers::rawHtmlArtists(implode(';', $artistIds), implode(';', $artistNames));
                                                                }
                                                                ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                }, $playlist->toArray());
                                                ?>
                                            </div>
                                        </div>
                                    </div>
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

    </script>
@endsection