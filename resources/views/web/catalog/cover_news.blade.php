<?php
use App\Library\Helpers;
$title = 'Album mới';
if(isset($_GET['page']))
    $title = $title.' trang '.$_GET['page'];
$titleMeta = $title.' - '. Config::get('constants.app.title');
?>
@section('meta')
    <meta name="copyright" content="{{env('APP_URL')}}" />
    <meta name="revisit-after" content="7 Days">
    <meta name="keywords" content="bang xep hang, music, mp3, m4a, flac, lossless, video, mv, hd, mp4, csn, nghe nhạc, tải nhạc, lời bài hát, lyrics">
    <meta name="description" content="Nghe nhạc online chất lượng cao kèm lyrics, chia sẻ và tải nhạc dạng mp3, mp4, m4a, lossless.">
    <link rel="canonical" href="{{url()->current()}}" />
    <link rel="image_src" href="{{env('APP_URL')}}/imgs/cover_bxh.png" />
    <meta name="title" content="{{$title}}" />
    <meta property="og:image" content="{{env('APP_URL')}}/imgs/cover_bxh.png" />
    <meta property="og:url" content="{{url()->current()}}" />
    <meta property="og:title" content="{{$title}}" />
    <meta property="og:description" content="Nghe nhạc online chất lượng cao kèm lyrics, chia sẻ và tải nhạc dạng mp3, mp4, m4a, lossless." />
    <meta property="og:type" content="website" />
    <meta property="og:updated_time" content="{{time()}}" />
@endsection
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
                            <h2 class="media-title">{{$title}}</h2>
                        </div>
                    </div>
                    <div class="content-wrap tab-content-category">
                        <section id="cover_news" class="content-current">
                            <?php echo $htmlCover?>
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
    <script src="/js/cbpFWTabs.js"></script>
    <script>
        $('#cover_news').find('.pagination li a').on('click', function (e) {
            e.preventDefault();
            musicPage($(this).attr('href'));
        });
        window.addEventListener('popstate', function(e) {
            // var state = e.originalEvent.state;
            var page = findGetParameter('page', 1);
            musicPage('/tab_category' + (page != 1 ? '?page=' + page : ''), false);
        });
        function musicPage(url, pushPage = true) {
            if(pushPage) {
                var page = parseFloat(url.substr(url.indexOf("?page=") + 6));
                page = isNaN(page) ? 1 : page;
                window.history.pushState({}, '', window.location.pathname +  (page != 1 ? '?page=' + page : ''));
                $('.tab-category .media-title').html('Album mới trang ' + page)
            }
            $.ajax({
                url: window.location.origin + url,
                type: "POST",
                dataType: "html",
                data: {
                    'tab': 'cover'
                },
                beforeSend: function () {
                    if(loaded) return false;
                    loaded = true;
                    $('html,body').animate({ scrollTop: 0 }, 400);
                },
                success: function(response) {
                    $('#cover_news').html(response);
                    $('#cover_news').find('.pagination li a').on('click', function (e) {
                        e.preventDefault();
                        musicPage($(this).attr('href'));
                    });
                }
            });
        }
    </script>
@endsection


