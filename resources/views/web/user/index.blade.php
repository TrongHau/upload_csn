@section('hidden_wapper', true)
<?php
use App\Library\Helpers;
$titleMeta = $user->name . ' - '. Config::get('constants.app.title');
$mySelf = (Auth::check() && Auth::user()->id == $user->id);
$avatar = Helpers::pathAvatar($user->user_avatar, $user->id);
?>
@section('meta')
    <meta name="copyright" content="{{env('APP_URL')}}" />
    <meta name="revisit-after" content="7 Days">
    <meta name="keywords" content="bang xep hang, music, mp3, m4a, flac, lossless, video, mv, hd, mp4, csn, nghe nhạc, tải nhạc, lời bài hát, lyrics">
    <meta name="description" content="Nghe nhạc online chất lượng cao kèm lyrics, chia sẻ và tải nhạc dạng mp3, mp4, m4a, lossless.">
    <link rel="canonical" href="{{url()->current()}}" />
    <link rel="image_src" href="{{$avatar}}" />
    <meta name="title" content="{{$titleMeta}}" />
    <meta property="og:image" content="{{$avatar}}" />
    <meta property="og:url" content="{{url()->current()}}" />
    <meta property="og:title" content="{{$titleMeta}}" />
    <meta property="og:description" content="Nghe nhạc online chất lượng cao kèm lyrics, chia sẻ và tải nhạc dạng mp3, mp4, m4a, lossless." />
    <meta property="og:type" content="website" />
    <meta property="og:updated_time" content="{{time()}}" />
@endsection
@extends('web.layouts.app')
@section('contentCSS')
    <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/css/TabStylesInspiration/normalize.css">
    <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/css/TabStylesInspiration/tabs.css">
    <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/css/TabStylesInspiration/tabstyles.css">
    <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/css/croppie.css">
@endsection
@section('content')
@include('web.user.box_profile', ['user' => $user, 'mySelf' => $mySelf, 'float_edit' => true])
<div class="container">
    <div class="row row_wrapper">
        <div class="col-md-9">
            <div class="tabs tabs-style-line tab-category">
                <nav>
                    <ul>
                        <li class="tab-current playlist"><a onclick="userTab('playlist', '/user/music_playlist')" href="#playlist"><span>Playlist</span></a></li>
                        <li class="music"><a class="music" onclick="userTab('music', '/user/music_favourite')" href="#music"><span><i class="material-icons" style="font-size: 11px;">favorite_border</i> Bài Hát</span></a></li>
                        <li class="video"><a class="video" onclick="userTab('video', '/user/video_favourite')" href="#video"><span><i class="material-icons" style="font-size: 11px;">favorite_border</i> Video</span></a></li>
                        <li class="artist"><a class="artist" onclick="userTab('artist', '/user/artist_favourite')" href="#artist"><span><i class="material-icons" style="font-size: 11px;">favorite_border</i> Ca Sĩ</span></a></li>
                        @if($mySelf || (Auth::check() && Auth::user()->hasPermission('duyet_sua_nhac')))
                        <li class="tu-nhac"><a class="tu-nhac" href="#uploaded" onclick="musicUserTab('musicUploaded')" ><span>Tủ nhạc</span></a></li>
                        @endif
                        @if($mySelf && Auth::check() && Auth::user()->hasPermission('duyet_sua_nhac'))
                            <li class="duyet-nhac"><a class="duyet-nhac" href="#duyet-nhac" onclick="musicUserTab('music_approval')" ><span>Duyệt Nhạc</span></a></li>
                        @endif
                    </ul>
                </nav>
                <div class="content-wrap tab-content-category">
                    <section id="playlist" class="content-current">
                        <div class="d-flex align-items-center justify-content-between" id="header_playlist">
                            <span class="title"></span>
                            @if($mySelf)
                                <span>
                                    <a class="btn btn-danger" href="/user/playlist/them" title="Tạo playlist"><i class="fa fa-pencil" aria-hidden="true"></i> Tạo playlist</a>
                                    <a class="btn btn-secondary" href="/user/playlist/chinh-sua" title=""><i class="fa fa-pencil" aria-hidden="true"></i> Chỉnh sửa</a>
                                    <a class="btn btn-secondary" onclick="pupop_qr_code()" href="javascript:void(0)" title=""><i class="fa fa-qrcode" aria-hidden="true"></i> QR code</a>
                                </span>
                            @endif
                        </div>
                        <div class="row row10px" id="playlist">
                            @if(count($playlist))
                                @foreach($playlist as $key2 => $item)
                                    <?php
                                        $url = Helpers::playlist_url($item->toArray());
                                        $tagHref = $item->playlist_music_total > 0 ? '<a href="'.$url.'" title="'.$item->playlist_title.'">' : '<a href="javascript:void(0)" onclick="alertModal(\'Playlist vẫn chưa có bài hát nào.\');" title="'.$item->playlist_title.'">';
                                    ?>
                                    <div class="col">
                                        <div class="card card1">
                                            <div class="card-header" style="background-image: url({{$item->playlist_cover ? Helpers::file_path($item->playlist_id, env('DATA_URL').MUSIC_PLAYLIST_PATH, true).$item->playlist_id . '.jpg?v=' . time() : '/imgs/avatar_default.png'}});">
                                                <?php echo $tagHref ?><span class="icon-play"></span></a>
                                            </div>
                                            <div class="card-body">
                                                <h3 class="card-title">
                                                    <?php echo $tagHref ?>{{$item->playlist_title}}</a>
                                                </h3>
                                                @if($item->playlist_artist)
                                                    <p class="card-text" style="padding: 0px;">
                                                        <?php
                                                            $artistPlaylist = unserialize($item->playlist_artist);
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
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="center-text-mes"><span>
                                        @if($mySelf)
                                            Bạn chưa có playlist nào, <a href="/user/playlist/them">click vào đây để tạo playlist</a>
                                        @else
                                            {{$user->name}} chưa tạo playlist nào.
                                        @endif
                                </span></div>
                            @endif
                        </div>
                    </section>
                    <section id="music"></section>
                    <section id="video"></section>
                    <section id="artist"></section>
                    <section id="uploaded"></section>
                    <section id="duyet-nhac"></section>
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
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
        </div>

    </div>
</div>
<style>
    .pagination {
        margin: 0px;
    }
</style>
<script>
    (function() {
        [].slice.call( document.querySelectorAll( '.tabs' ) ).forEach( function( el ) {
            new CBPFWTabs( el );
        });
    })();
    var firstUploaded = true;
    var firstApproval = true;
    function musicUserTab(tab) {
        let urlCurrent = window.location.origin + window.location.pathname;
        if(tab == 'music_approval') {
            history.pushState({urlPath: urlCurrent + '?tab=duyet-nhac'},"", urlCurrent + '?tab=duyet-nhac')
        }else{
            history.pushState({urlPath: urlCurrent + '?tab=tu-nhac'},"", urlCurrent + '?tab=tu-nhac')
        }
        if(tab == 'musicUploaded' && firstUploaded) {
            firstUploaded = false;
            musicUploaded('/user/music_uploaded', 'upload', 'all');
        }
        if(tab == 'music_approval' && firstApproval) {
            firstApproval = false;
            musicUploaded('/user/music_uploaded', 'approval', 'all');
        }
    }
    function musicUploaded(url, page, stage) {
        var uploaded = $('#uploaded');
        var approval = $('#duyet-nhac');
        $.ajax({
            url: url,
            type: "POST",
            dataType: "html",
            data: {
                'page_tab' : page,
                'stage' : stage,
                'user_id' : '<?php echo $user->id ?>'
            },
            async: false,
            beforeSend: function () {
                if(loaded) return false;
                loaded = true;
                waitingDialog.show();
            },
            success: function(response) {
                waitingDialog.hide();
                if(page == 'upload') {
                    if(stage == 'all') {
                        uploaded.html(response);
                    }else{
                        uploaded = $('.stage_' + stage);
                        $('.stage_' + stage).html(response);
                    }
                    uploaded.find('.pagination li a').on('click', function (e) {
                        e.preventDefault();
                        musicUploaded($(this).attr('href'), 'upload', $(this).parents().parents().parents().data('page'));
                    });
                }else {
                    if(stage == 'all') {
                        approval.html(response);
                    }else{
                        approval = $('.stage_' + stage);
                        $('.stage_' + stage).html(response);
                    }
                    approval.find('.pagination li a').on('click', function (e) {
                        e.preventDefault();
                        musicUploaded($(this).attr('href'), 'approval', $(this).parents().parents().parents().data('page'));
                    });
                }
            }
        });
    }
    function userTab(tab, url, float = false) {
        let urlCurrent = window.location.origin + window.location.pathname;
        history.pushState({urlPath: urlCurrent + '?tab=' + tab},"", urlCurrent + '?tab=' + tab)
        var tabContent = $('#' + tab);
        if(tabContent.html().length == 0 || float) {
            $.ajax({
                url: url,
                type: "POST",
                dataType: "html",
                data: {
                    'user_id': '<?php echo $user->user_id ?>'
                },
                beforeSend: function () {
                    if(loaded) return false;
                    loaded = true;
                    waitingDialog.show();
                },
                success: function(response) {
                    waitingDialog.hide();
                    tabContent.html(response);
                    tabContent.find('.pagination li a').on('click', function (e) {
                        e.preventDefault();
                        userTab(tab, $(this).attr('href'), true);
                    });
                }
            });
        }

    }
    function favourite(title, type, music_id) {
        <?php
        if(!Auth::check()) {
        ?>
        switchAuth('myModal_login');
        return false;
        <?php
        }
        ?>
        let falgFav = $('.wishlist-' + music_id).hasClass('selector');
        $.ajax({
            url: type == 'artist' ? '/ca-si/favorite' : '/music/favourite',
            type: "POST",
            dataType: "json",
            data: {
                'type': falgFav,
                'type_of': type,
                'name': title,
                'music_id' : music_id,
                'artist_id' : music_id,
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
        $('.wishlist-' + music_id).toggleClass('selector');
    }
    <?php
    if(isset($_GET['tab'])) {
    ?>
    $( document ).ready(function() {
        $('.<?php echo $_GET['tab'] ?>').click();
    });
    <?php
    }
    ?>
    function pupop_qr_code() {
        $.ajax({
            url: '/user/qr_code',
            type: "POST",
            dataType: "html",
            data: {
            },
            beforeSend: function () {
                if(loaded) return false;
                loaded = true;
            },
            success: function(response) {
                confirmModal(response + '<p>Thời gian tồn tại Qr code: <span id="time">05:00</span></p>', 'QR Code đăng nhập', 'modal-sm');
                $('.btn-ok').addClass('hidden');
                $('.close_confirm').html('Đóng');
                var fiveMinutes = 60 * 5,
                    display = document.querySelector('#time');
                startTimer(fiveMinutes, display);
            }
        });
    }
    function startTimer(duration, display) {
        var timer = duration, minutes, seconds;
        setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + ":" + seconds;

            if (--timer < 0) {
                timer = duration;
                $('.close_confirm').click()
            }
        }, 1000);
    }

</script>
@endsection
