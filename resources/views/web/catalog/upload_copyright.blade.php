<?php
use App\Library\Helpers;
$titleMeta = 'Danh sách nhạc bị cấm upload';
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
@extends('web.layouts.app')
@section('contentCSS')
    <style>
        .counter {
            color: #0a0a0a!important;
        }
        .icon_search{
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            font-size: 20px;
            color: #B6B6B6;
            display: -webkit-inline-box;
            display: -ms-inline-flexbox;
            display: inline-flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            min-width: 50px;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row row_wrapper">
            <div class="col-md-9">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade active show" id="cat-3" role="tabpanel" aria-labelledby="home-tab">
                        <div class="media media-tab">
                            <div class="media-left">
                                <h2 class="media-title">Danh sách bài hát bị cấm Upload</h2>
                            </div>
                        </div>
                        <div class="form-group m-0" style="position: relative;">
                            <i class="material-icons icon_search">search</i>
                            <input style="padding-left: 40px; font-family: 'SFProDisplay-Italic';" type="search" name="q" class="form-control ui-autocomplete-input search_list_blocked" value="" placeholder="Nhập bài hát cần tìm" autocomplete="off">
                        </div>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active tab_bxh tab_music_blocked" data-cat_url="vietnam" id="cat-3-music" role="tabpanel" aria-labelledby="nav-home-tab">
                                <?php echo $htmlMusic; ?>
                            </div>
                        </div>
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
        $('.search_list_blocked').autocomplete({
            minLength: 1,
            source: function( request, response ) {
                musicPage(window.location.origin + '/upload_copyright.html');
            }
        });

        $('.tab_music_blocked').find('.pagination li a').on('click', function (e) {
            e.preventDefault();
            musicPage($(this).attr('href'));
        });
        function musicPage(url, pushPage = true) {
            $.ajax({
                url: url,
                type: "GET",
                dataType: "html",
                data: {
                    'search': $('.search_list_blocked').val(),
                    'load_ajax' : true
                },
                beforeSend: function () {
                    if(loaded) return false;
                    loaded = true;
                    $('html,body').animate({ scrollTop: 0 }, 400);
                },
                success: function(response) {
                    $('.tab_music_blocked').html(response);
                    $('.tab_music_blocked').find('.pagination li a').on('click', function (e) {
                        e.preventDefault();
                        musicPage($(this).attr('href'));
                    });
                    $('.ui-autocomplete-loading').removeClass('ui-autocomplete-loading');
                }
            });
        }
    </script>
@endsection
