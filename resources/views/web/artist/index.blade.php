@section('hidden_wapper', true)
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
@section('contentCSS')
    <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/css/TabStylesInspiration/normalize.css">
    <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/css/TabStylesInspiration/tabs.css">
    <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/css/TabStylesInspiration/tabstyles.css">
@endsection
@extends('web.layouts.app')
@section('content')
    @include('web.artist.box_artist', ['artist' => $artist, 'previewArtist' => $previewArtist ?? false])
    <div class="container">
        <div class="row row_wrapper">
            <div class="col-md-9">
                @if(!isset($previewArtist))
                <div class="tabs tabs-style-line tab-category">
                    <nav>
                        <ul>
                            <li class="bai-hat tab-current"><a class="bai-hat" onclick="artistTab('/tab_artist', 'music')" href="#music"><span>Bài Hát</span></a></li>
                            <li class="video"><a class="video" onclick="artistTab('/tab_artist', 'video')" href="#video"><span>Video</span></a></li>
                            <li class="album"><a class="album" onclick="artistTab('/tab_artist', 'album')" href="#album"><span>Album</span></a></li>
                            <li class="playlist"><a class="playlist" onclick="artistTab('/tab_artist', 'playlist')" href="#playlist"><span>Playlist</span></a></li>
                        </ul>
                    </nav>
                    <div class="content-wrap tab-content-category">
                        <section id="music" class="content-current"><?php echo $musicHtml ?></section>
                        <section id="video"></section>
                        <section id="album"></section>
                        <section id="playlist"></section>
                    </div>
                </div>
                @endif
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
        (function() {
            [].slice.call( document.querySelectorAll( '.tabs' ) ).forEach( function( el ) {
                new CBPFWTabs( el );
            });
        })();
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
                    },
                    success: function(response) {
                        $('html,body').animate({ scrollTop: 100 }, 400);
                        setTimeout(function(){  waitingDialog.hide(); }, 500);
                        $('#'+tab).html(response);
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
            switchAuth('myModal_login');
            return false;
            <?php
            }
            ?>
            e.preventDefault();
            let falgFav = $('.toggle_wishlist').hasClass('selector');
            $.ajax({
                url: window.location.origin + '/ca-si/favorite',
                type: "POST",
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
                        // let notifType = 'success';
                        // if(response.data !== null)
                        //     notifType = 'default';
                        // Lobibox.notify(notifType, {
                        //     size: 'mini',
                        //     sound: false,
                        //     delay: 1500,
                        //     delayIndicator: false,
                        //     msg: response.message
                        // });
                    }else {
                        alertModal(data.message);
                    }
                }
            });
            $(this).toggleClass('selector');
        });
        <?php
        if(isset($_GET['tab'])) {
        ?>
        $( document ).ready(function() {
            $('.<?php echo $_GET['tab'] ?>').click();
        });
        <?php
        }
        ?>
    </script>
@endsection
