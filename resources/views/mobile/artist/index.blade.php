<?php
use App\Library\Helpers;
$titleMeta = $artist->artist_nickname . ' - '. Config::get('constants.app.title');
$avtArtist = $artist->artist_avatar ? Helpers::file_path($artist->artist_id, PUBLIC_AVATAR_ARTIST_PATH, true) . $artist->artist_avatar : env('APP_URL').'/imgs/no_avatar.png';
?>
@section('meta')
    <meta name="author" content="{{$artist->artist_nickname}}">
    <meta name="copyright" content="{{env('APP_URL')}}" />
    <meta name="revisit-after" content="7 Days">
    <meta name="keywords" content="{{$artist->artist_nickname}}, nhac {{$artist->artist_nickname}}, thong tin {{$artist->artist_nickname}}, bai hat moi, video hot, album hay nhất">
    <meta name="description" content="{{$artist->artist_nickname}}, trang thông tin chính thức về nhạc {{$artist->artist_nickname}}, toàn bộ bài hát mới, video mới nhất và album hay nhất của {{$artist->artist_nickname}}">
    <link rel="canonical" href="{{url()->current()}}" />
    <link rel="image_src" href="{{$avtArtist}}" />
    <meta name="title" content="{{$artist->artist_nickname}}" />
    <meta property="og:image" content="{{$avtArtist}}" />
    <meta property="og:url" content="{{url()->current()}}" />
    <meta property="og:title" content="{{$artist->artist_nickname}}" />
    <meta property="og:description" content="{{$artist->artist_nickname}}, trang thông tin chính thức về nhạc {{$artist->artist_nickname}}, toàn bộ bài hát mới, video mới nhất và album hay nhất của {{$artist->artist_nickname}}" />
    <meta property="og:type" content="website" />
    <meta property="og:updated_time" content="{{time()}}" />
@endsection
@extends('mobile.layouts.app')
@section('content')
    <div class="header">
        @include('mobile.layouts.header_top')
    </div>
    <main class="main main_profile">
        <section style="background: url('{{$artist->artist_cover ?  Helpers::file_path($artist->artist_id, PUBLIC_COVER_ARTIST_PATH, true).$artist->artist_cover : '/imgs/no_cover_artist.jpg'}}'); background-position: center; background-repeat: no-repeat;" class="block_banner_singer">
            <div class="thumb-mask py-4" style="position: inherit; height: 100%;">
            <div class="container">
                <div class="box_profile_singer">
                    <div class="box_profile__body text-center">
                        <h4 class="singer_name mb-3">{{$artist->artist_nickname}}</h4>
                        <ul class="list-inline navbar justify-content-center p-0 mb-4 menu_option">
                            <li class="list-inline-item"><a href="/nghe-bat-hat-ca-si/{{$artistUrl}}" class="btn btn-secondary btn-gradien btn-radius"><span>Play</span></a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)" class="wishlist toggle_wishlist {{$artistFavourite ? 'selector' : ''}}"><i aria-hidden="true" class="fa fa-heart-o"></i></a></li>
                            {{--<li class="list-inline-item">--}}
                                {{--<div class="dropdown"><a id="dropdownMenuSinger" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i aria-hidden="true" class="fa fa-ellipsis-h"></i></a>--}}
                                    {{--<div aria-labelledby="dropdownMenuSinger" class="dropdown-menu"><a href="#" class="dropdown-item">Bắt đầu Radio</a><a href="#" class="dropdown-item">Lưu vào thư viện</a><a href="#" class="dropdown-item">Sao chép Liên kết Nghệ sĩ</a></div>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                        </ul>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <!-- swiper1-->
        <div data-itemmenu="4" class="swiper-container swiper1 swiper_wauto">
            <div class="swiper-wrapper">
                <div class="swiper-slide selected"><span class="d-inline-block align-middle">Bài Hát</span></div>
                <div class="swiper-slide" onclick="artistTab('/tab_artist', 'video')"><a class="d-inline-block align-middle">Video</a></div>
                <div class="swiper-slide" onclick="artistTab('/tab_artist', 'album')"><a class="d-inline-block align-middle">Album</a></div>
                <div class="swiper-slide" onclick="artistTab('/tab_artist', 'playlist')"><span class="d-inline-block align-middle">Playlist</span></div>
            </div>
        </div>
        <!-- swiper2-->
        <div class="swiper-container swiper2">
            <div class="swiper-wrapper">
                <div data-tab="bat-hat" class="swiper-slide">
                    <div class="container">
                        <div class="block block_baihat">
                            <div class="block_baihat_main block_more" id="music"><?php echo $musicHtml ?></div>
                        </div>
                    </div>
                </div>
                <div data-tab="video" class="swiper-slide">
                    <div class="container">
                        <div class="block_player block_bxhvideo">
                            <div class="block_baihat_main block_more" id="video"></div>
                        </div>
                    </div>
                </div>
                <div data-tab="album" class="swiper-slide">
                    <div class="container">
                        <div class="block block_album block_profile_playlist" >
                            <div class="row row-sm" id="album"></div>
                        </div>
                    </div>
                </div>
                <div data-tab="playlist" class="swiper-slide">
                    <div class="container">
                        <div class="block block_album block_profile_playlist">
                            <div class="row row-sm" id="playlist"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('contentJS')
<script>
    $('#music').find('.pagination li a').on('click', function (e) {
        e.preventDefault();
        artistTab(($(this).attr('href')), 'music', true);
    });
    function artistTab(url, tab, floatTab = false) {
        if(($('#'+tab).html()).length == 0 || floatTab) {
            $.ajax({
                url: window.location.origin + url,
                type: "GET",
                dataType: "html",
                data: {
                    'artist': '<?php echo $artist->artist_nickname; ?>',
                    'artist_id': '<?php echo $artist->artist_id; ?>',
                    'tab': tab ? tab : 'music'
                },
                beforeSend: function () {
                    if(loaded) return false;
                    loaded = true;
                    $('html,body').animate({ scrollTop: 0 }, 400);
                },
                success: function(response) {
                    $('#'+tab).html(response);
                    swiper2.update();
                    $('#'+tab).find('.pagination li a').on('click', function (e) {
                        e.preventDefault();
                        artistTab($(this).attr('href'), tab, true);
                    });
                }
            });
        }
    }
    $('.toggle_wishlist').click(function(e) {
        <?php
        if(!Auth::check()) {
        ?>
        window.location.href = '/login?back_url=' + window.location.href;
        return false;
        <?php
        }
        ?>
        e.preventDefault();
        let falgFav = $('.toggle_wishlist').hasClass('selector');
        $.ajax({
            url: window.location.origin + '/ca-si/favorite',
            type: "GET",
            dataType: "json",
            data: {
                'type': falgFav,
                'name': '<?php echo $artist->artist_nickname; ?>',
                'artist_id' : '<?php echo $artist->artist_id; ?>',
            },
            beforeSend: function () {
                if(loaded) return false;
                loaded = true;
            },
            success: function(response) {
                if(response.success) {

                }else {
                    alertModal(data.message);
                }
            }
        });
    });
    function slideSwiperChange(swiper){
        let tabSelected = $('.swiper2').find('.swiper-slide-active');
        let tab =  tabSelected.data('tab');
        if(tab == 'video') {
            artistTab('/tab_artist', 'video')
        }
        if(tab == 'album') {
            artistTab('/tab_artist', 'album')
        }
        if(tab == 'playlist') {
            artistTab('/tab_artist', 'playlist')
        }
    }
</script>
@endsection