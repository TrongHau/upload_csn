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
                    <div class="swiper-slide selected vietnam selected">Album VN</div>
                    <div class="swiper-slide tab-music us-uk">Album US-UK</div>
                    <div class="swiper-slide tab-music chinese">Album Hoa</div>
                    <div class="swiper-slide tab-music korea">Album Hàn</div>
                    <div class="swiper-slide tab-music japan">Album Nhật</div>
                    <div class="swiper-slide tab-music france">AlbumPháp</div>
                    <div class="swiper-slide tab-music other">Album Nước Khác</div>
                    <div class="swiper-slide tab-music beat-playback">Album Playback</div>
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
                    <div class="swiper-slide block_bxhbaihat block_more tab-music music">

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('contentJS')
    <script>
        <?php
        if(isset($_GET['tab'])) {
        ?>
        $( document ).ready(function() {
            setTimeout(function(){
                $('.<?php echo $_GET['tab'] ?>').click();
            }, 2000);

        });
        <?php
        }
        ?>
    </script>
@endsection
