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
    <meta property="fb:app_id" content="419934814770318" />
    <meta property="og:image" content="{{env('APP_URL')}}/imgs/cover_bxh.png" />
    <meta property="og:url" content="{{url()->current()}}" />
    <meta property="og:title" content="{{$caption}}" />
    <meta property="og:description" content="Nghe nhạc online chất lượng cao kèm lyrics, chia sẻ và tải nhạc dạng mp3, mp4, m4a, lossless." />
    <meta property="og:type" content="website" />
    <meta property="og:updated_time" content="{{time()}}" />
@endsection
@extends('web.layouts.app')
@section('contentCSS')
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
                    <div class="content-wrap tab-content-category">
                        <section id="video_2018" class="content-current">

                            <div class="row row10px float-col-width">
                                <?php
                                array_map(function ($item) {
                                $url = Helpers::playlist_url($item);
                                ?>
                                <div class="col">
                                    <div class="card card1">
                                        <div class="card-header" style="background-image: url({{$item['playlist_cover'] ? Helpers::file_path($item['playlist_id'], env('DATA_URL').MUSIC_PLAYLIST_PATH, true).$item['playlist_id'] . '.jpg' : '/imgs/avatar_default.png'}});">
                                            <a href="{{$url}}" title="{{$item['playlist_title']}}">
                                                <span class="icon-play"></span>
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <h3 class="card-title"><a href="{{$url}}" title="{{$item['playlist_title']}}">{{$item['playlist_title']}}</a></h3>
                                            <p class="card-text">
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

                        </section>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                @include('web.layouts.right_banner')
            </div>
        </div>
    </div>
@endsection
@section('contentJS')
    <script>
    </script>
@endsection


