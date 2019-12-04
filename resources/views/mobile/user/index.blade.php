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
    <link rel="image_src" href="<?php echo $avatar ?>" />
    <meta name="title" content="{{$titleMeta}}" />
    <meta property="fb:app_id" content="419934814770318" />
    <meta property="og:image" content="<?php echo $avatar ?>" />
    <meta property="og:url" content="{{url()->current()}}" />
    <meta property="og:title" content="{{$titleMeta}}" />
    <meta property="og:description" content="Nghe nhạc online chất lượng cao kèm lyrics, chia sẻ và tải nhạc dạng mp3, mp4, m4a, lossless." />
    <meta property="og:type" content="website" />
    <meta property="og:updated_time" content="{{time()}}" />
@endsection
@extends('mobile.layouts.app')
@section('contentCSS')
    <link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/css/croppie.css">
@endsection
@section('content')
    <div class="header">
        @include('mobile.layouts.header_top')
    </div>
    <main class="main main_profile">
        <section class="block_box_profile">
            <div class="container">
                <div class="box_profile py-3">
                    <div class="box_profile__header"><a href="{{'/user/'.$user->id}}"><img id="view_user_avatar_2" src="<?php echo $avatar ?>?time={{time()}}" alt="{{$user->name}}"></a></div>
                    <div class="box_profile__body">
                        <h4 class="media-title user_name">{{$user->name}}</h4>
                        <ul class="list-inline">
                            <li class="list-inline-item"><strong>{{number_format($user->user_music)}}</strong><small> upload</small></li>
                        </ul>
                        @if($mySelf)
                        <button type="button" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-secondary btn-gradien btn-radius modal-edit-profile"><span>Chỉnh sửa </span><i aria-hidden="true" class="fa fa-pencil"></i></button>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <!-- swiper1-->
        <div data-itemmenu="4" class="swiper-container swiper1 swiper_wauto">
            <div class="swiper-wrapper">
                <div class="swiper-slide selected"><span class="d-inline-block align-middle">Playlist</span></div>
                <div class="swiper-slide bai-hat" onclick="userTab('music', '/user/music_favourite')"><span class="d-inline-block align-middle"><i class="material-icons" style="font-size: 11px;">favorite_border</i> Bài Hát</span></div>
                <div class="swiper-slide video" onclick="userTab('video', '/user/video_favourite')"><a class="d-inline-block align-middle"><i class="material-icons" style="font-size: 11px;">favorite_border</i> Video</a></div>
                <div class="swiper-slide ca-si" onclick="userTab('artist', '/user/artist_favourite')"><a class="d-inline-block align-middle"><i class="material-icons" style="font-size: 11px;">favorite_border</i> Ca Sĩ</a></div>
                <div class="swiper-slide tu-nhac" onclick="musicUserTab('musicUploaded')"><a class="d-inline-block align-middle">Tủ nhạc</a></div>
            </div>
        </div>
        <!-- swiper2-->
        <div class="swiper-container swiper2">
            <div class="swiper-wrapper">
                <div data-tab="playlist" class="swiper-slide">
                    <div class="container">
                        @if($mySelf)
                        <div class="block_header d-flex flex-row justify-content-around pt-3">
                            <a href="/user/playlist/them"> <button type="button" class="btn btn-danger btn-gradien btn-radius">			<i aria-hidden="true" class="fa fa-pencil"></i><span>Tạo playlist</span></button></a>
                            <a href="/user/playlist/chinh-sua"> <button type="button" class="btn btn-secondary-grey btn-radius">			<i aria-hidden="true" class="fa fa-pencil"></i><span>Chỉnh sửa</span></button></a>
                        </div>
                        @endif
                        <div class="block block_album block_profile_playlist">
                            <div class="row row-sm">
                                @if(count($playlist))
                                    @foreach($playlist as $key2 => $item)
                                        <?php
                                        $url = Helpers::playlist_url($item->toArray());
                                        $tagHref = $item->playlist_music_total > 0 ? '<a href="'.$url.'" title="'.$item->playlist_title.'">' : '<a href="javascript:void(0)" onclick="alertModal(\'Playlist vẫn chưa có bài hát nào.\');" title="'.$item->playlist_title.'">';
                                        ?>
                                        <div class="col-6">
                                            <div class="item element">

                                                <?php echo $tagHref ?><div style="background: url({{$item->playlist_cover ? Helpers::file_path($item->playlist_id, env('DATA_URL').MUSIC_PLAYLIST_PATH, true).$item->playlist_id . '.png?v=' . time() : '/imgs/avatar_default.png'}}) no-repeat center;background-size: cover;" class="image rounded"></div></a>
                                                <div class="content mt-3">
                                                    <?php echo $tagHref ?><h6 class="name_song mb-1 card-title">{{$item->playlist_title}}</h6></a>
                                                    @if($item->playlist_artist)
                                                    <p class="name_singer text-gray mb-1 author">
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
                                                        ?></p>
                                                    @endif
                                                    <p class="loss text-pink mb-0">Lossless</p>
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
                        </div>
                    </div>
                </div>
                <div data-tab="bat-hat" class="swiper-slide">
                    <div class="container">
                        <div class="block block_baihat">
                            <div class="block_baihat_main block_more" id="music"></div>
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
                <div data-tab="ca-si" class="swiper-slide">
                    <div class="container">
                        <div class="block block_album block_profile_playlist" id="artist"></div>
                    </div>
                </div>
                <div data-tab="tu-nhac" class="swiper-slide">
                    <div class="container" id="uploaded"></div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('popupMusic')
    <div class="wrap-edit-profile d-hidden">
        <div class="box_edit_profile">
            <div class="container py-3">
                <div id="resizer-demo"></div>
                <div class="box_title mb-3">
                    <h4 class="text-center">Chỉnh sửa tài khoản</h4>
                </div>
                <div class="box_profile pb-3">
                    <div class="box_profile__header"><a href="#" id="upload-avatar-crop">
                            <img id="view_user_avatar" src="<?php echo Helpers::pathAvatar($user->user_avatar, $user->id) ?>?time={{time()}}" alt="{{$user->name}}">
                        </a></div>
                    <div class="box_profile__body text-center">
                        <h4 class="media-title user_name">{{$user->name}}</h4>
                        <form>
                            <label data-toggle="modal" data-target="#changeAvatarModal" class="btn btn-secondary btn-gradien btn-radius changeAvatarButton"><i aria-hidden="true" class="fa fa-camera"></i> Thay đổi ảnh đại diện
                                <input id="upload" type="file" name="choose_user_avatar" class="d-none">
                                <input type="text" hidden name="user_avatar" value="" alt="" class="form-control-file" id="user_avatar">
                            </label>
                        </form>
                    </div>
                </div>
                <div class="box_body">
                    <form action="" method="get" accept-charset="utf-8" class="profile_submit1">
                        <div class="form-group">
                            <label for="username">Tên Tài Khoản</label>
                            <input id="username" {{$user->username ? 'disabled ' : ''}}type="text" id="username" value="{{$user->username}}" placeholder="bắt buộc nhập" class="form-control">
                        </div>
                        @if(!$user->username)
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Mật khẩu</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="" value="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name">Nhập lại mật khẩu</label>
                                    <input type="password" class="form-control" id="repassword" name="repassword" placeholder="" value="">
                                </div>
                            </div>
                        @else
                            <span href="javascript:void(0);" title="" class="btn_change_password" onclick="showChangePassWord();">Thay đổi mật khẩu <br/></span>
                            <div class="form-row input_change_pass" style="display: none">
                                <div class="form-group col-md-6">
                                    <label for="name">Mật khẩu cũ</label>
                                    <input type="password" class="form-control" id="current_password" name="current_password" placeholder="" value="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name">Mật khẩu mới</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="" value="">
                                </div>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="exampleInputEmail12">Link URL của bạn</label>
                            <input type="text" class="form-control disabled" disabled id="exampleInputEmail12" placeholder="" value="{{env('APP_URL').'/user/'.$user->id}}">
                        </div>
                        <div class="form-group">
                            <label for="name">Tên</label>
                            <input id="name" type="text" name="name" aria-describedby="emailHelp" placeholder="" value="{{$user->name}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="user_gender">Giới tính</label>
                            <select name="user_gender" id="user_gender" class="form-control">
                                <option {{ ($user->user_gender == 0 ? 'selected' : '') }} value="0">Nam</option>
                                <option {{ ($user->user_gender == 1 ? 'selected' : '') }} value="1">Nữ</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="user_birthday">Số điện thoại</label>
                            <input type="text" class="form-control"  name="user_phone_number" id="user_phone_number" placeholder="" value="{{$user->user_phone_number}}">
                        </div>
                        <div class="form-group">
                            <label for="user_phone_number">Ngày Sinh</label>
                            <input type="date" class="form-control"  name="user_birthday" id="user_birthday" aria-describedby="phone" placeholder="" value="{{$user->user_birthday}}">
                        </div>
                        <div class="form-group">
                            <label for="user_interests">Thông tin</label>
                            <textarea class="form-control" id="user_interests" name="user_interests" rows="3">{{$user->user_interests}}</textarea>
                        </div>
                        <div class="text-right"><a href="#" class="cancel cancel_model_profile">Hủy</a>
                            <button onclick="updateProfile();" class="btn btn-secondary ml-3">Hoàn tất</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal-->
    <div id="changeAvatarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="content clearfix">
                        <div id="upload-avatar"></div>
                    </div>
                </div>
                <div class="text-center mb-4">
                    <button type="button" data-dismiss="modal" class="btn btn-radius">Hủy</button>
                    <button type="button" class="btn btn-primary btn-gradien btn-radius upload-result">Cập nhật</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('contentJS')
    <script type="text/javascript" src="/js/croppie.js"></script>
    <script>
        var oldViewAvatar = $('#view_user_avatar').attr("src");
        var oldAvatar = $('#user_avatar').val();
        $('.profile_submit1').submit(false);
        function showChangePassWord() {
            $('.input_change_pass').toggle('slow');
        }
        var $uploadCrop = $('#upload-avatar').croppie({
            enableExif: true,
            enableZoom: true,
            viewport: {
                width: 220,
                height: 220,
                type: 'circle'
            },
            boundary: {
                width: 260,
                height: 260
            },
            enableOrientation: true,
            mouseWheelZoom: '',
        });
        if ($('#upload')) {
            var inputfile = $("#upload");
            $('#upload').on('change', function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $uploadCrop.croppie('bind', {
                        url: e.target.result
                    }).then(function() {
                        console.log('jQuery bind complete');
                    });
                }
                reader.readAsDataURL(this.files[0]);
            });
        }
        $('.upload-result').on('click', function(ev) {
            var action = $(this).data('action');
            $uploadCrop.croppie('result', {
                type: 'canvas',
                size: {
                    width: 500,
                    height: 500
                }
            }).then(function(resp) {
                $("#upload-avatar-crop img").attr('src', resp);
                $("#user_avatar").val(resp);
                $("#changeAvatarModal").modal('hide');
                /*$.ajax({
                    url: action,
                    type: "POST",
                    data: { "image": resp },
                    success: function(data) {
                        html = '<img src="' + resp + '" />';
                        $("#upload-avatar-crop").html(html);
                        $('body').find('.avatar-ajax').css({
                            'background': `url(${data}) center center no-repeat`,
                            'backgroundSize': `cover`
                        });
                    }
                });*/
            });
        });
        $('.cancel_model_profile').click(function(e) {
            $('#user_avatar').val('');
            $('#view_user_avatar').attr("src", oldViewAvatar);
            e.preventDefault();
            var $body = $(this).parents('body');
        });
        var openModal = function(button, containerModal) {
            $(button).click(function(e) {
                e.preventDefault();
                var height = $(containerModal).innerHeight();
                var $body = $(this).parents('body');
                $body.addClass('overlay');
                $body.find(containerModal).fadeIn('400');
                $body.scrollTop(0);
                <?php
                if(!$user->username) {
                    ?>
                    alertModal('Lần đăng nhập với tài khoản facebook hoặc google sẽ cập nhật thêm thông tin tên tài khoản và mật khẩu.');
                    <?php
                }
                ?>
            });

        }
        var closeModal = function(button, containerModal) {
            $(button).click(function(e) {
                e.preventDefault();
                var $body = $(this).parents('body');
                $body.removeClass('overlay');
                $body.find(containerModal).fadeOut('400');
                $body.scrollTop(0);
            });
        }
        openModal('.modal-edit-profile', '.wrap-edit-profile');
        closeModal('.cancel_model_profile', '.wrap-edit-profile');
        function updateProfile() {
            resetInputLogin();
            if(($('.profile_submit1').find('#username').val()) < 4) {
                var $body = $(this).parents('body');
                $("#username").focus();
                addErrorInput($('#username'), 'Tên tài khoản không được để trống và lớn hơn 4 ký tự');
                return false;
            }
            if(($('.profile_submit1').find('#name').val()).length < 4) {
                $("#name").focus();
                addErrorInput($('#name'), 'Tên không được để trống và lớn hơn 4 ký tự');
                return false;
            }
            $.ajax({
                url: "/user/update",
                type: "POST",
                dataType: 'json',
                data: {
                    'name': $('.profile_submit1').find('#name').val(),
                    'user_gender': $('.profile_submit1').find('#user_gender').val(),
                    'user_birthday': $('.profile_submit1').find('#user_birthday').val(),
                    'user_phone_number': $('.profile_submit1').find('#user_phone_number').val(),
                    'user_interests': $('.profile_submit1').find('#user_interests').val(),
                    'user_avatar': $('#user_avatar').val(),
                    'username': $('#username').val(),
                    'password': $('#password').val(),
                    'repassword': $('#repassword').val(),
                    'current_password': $('#current_password').val()
                },
                beforeSend: function () {
                    if(loaded) return false;
                    loaded = true;
                },
                statusCode: {
                    401: function () {
                        window.location.replace('/login');
                        return false;
                    }
                },
                success: function (response) {
                    waitingDialog.hide();
                    if(response.success) {
                        if($('#user_avatar').val()){
                            let urlImageAvt = '<?php echo (strpos($user->user_avatar, "http") !== false) ? "" : Helpers::file_path($user->id, PUBLIC_AVATAR_PATH, true) ?>' + response.data.user_avatar + '?v=' + Date.now();
                            $("#view_user_avatar_2").attr("src", urlImageAvt)
                            $('#user_avatar').val("");
                            $('#nav-avatar').css('background-image', 'url(' + urlImageAvt + ')');
                        }
                        oldViewAvatar = $('#view_user_avatar').attr("src");
                        $('.user_name').html(response.data.name);
                        $('.edit_profile').modal('toggle');
                        $('#password').val('');
                        $('#current_password').val('');
                        if(response.data.refresh) {
                            location.reload();
                        }else{
                            $('.cancel_model_profile').click();
                            successModal(response.message);
                        }
                    }else{
                        $.each( response.data, function( key, value ) {
                            addErrorInput($('.profile_submit1').find('#' + key), value);
                        });
                    }

                }
            });
            return false;
        }
        function resetInputLogin() {
            $('.profile_submit1').find('.input-help-block').remove();
            $('.profile_submit1').find('.alert').remove();
            $('.profile_submit1').find('input').removeClass('input-has-error');
        }
        function addErrorInput(tag, content) {
            tag.focus();
            tag.addClass('input-has-error');
            tag.before('<span class="input-help-block"><strong>' + content + '</strong></span>');
        }
        <?php
        if(isset($_GET['tab'])) {
        ?>
        $( document ).ready(function() {
            setTimeout(function(){
                $('.<?php echo $_GET['tab'] ?>').click();
            }, 600);
        });
        <?php
        }
        ?>
        var firstUploaded = true;
        function musicUserTab(tab) {
            if(tab == 'musicUploaded' && firstUploaded) {
                firstUploaded = false;
                musicUploaded('/user/music_uploaded', 'all');
            }
        }
        function musicUploaded(url, stage) {
            var uploaded = $('#uploaded');
            $.ajax({
                url: url,
                type: "POST",
                dataType: "html",
                data: {
                    'user_id': <?php echo $user->id; ?>,
                    'stage' : stage,
                    'page_tab' : 'upload'
                },
                beforeSend: function () {
                    if(loaded) return false;
                    loaded = true;
                },
                success: function(response) {
                    if(stage == 'all') {
                        uploaded.html(response);
                    }else{
                        uploaded = $('.stage_' + stage);
                        $('.stage_' + stage).html(response);
                    }
                    swiper2.update();
                    uploaded.find('.pagination li a').on('click', function (e) {
                        e.preventDefault();
                        musicUploaded($(this).attr('href'), $(this).parents().parents().parents().data('page'));
                    });
                }
            });
        }
        function userTab(tab, url, float = false) {
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
                    },
                    success: function(response) {
                        tabContent.html(response);
                        swiper2.update();
                        tabContent.find('.pagination li a').on('click', function (e) {
                            e.preventDefault();
                            userTab(tab, $(this).attr('href'), true);
                        });
                    }
                });
            }

        }
        function slideSwiperChange(swiper){
            let tabSelected = $('.swiper2').find('.swiper-slide-active');
            let tab =  tabSelected.data('tab');
            if(tab == 'tu-nhac') {
                musicUserTab('musicUploaded');
            }
            if(tab == 'bat-hat') {
                userTab('music', '/user/music_favourite');
            }
            if(tab == 'video') {
                userTab('video', '/user/video_favourite');
            }
            if(tab == 'ca-si') {
                userTab('artist', '/user/artist_favourite');
            }
        }

    </script>
@endsection