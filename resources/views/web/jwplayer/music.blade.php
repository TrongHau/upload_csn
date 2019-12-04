@section('hidden_wapper', true)
@section('in_player', true)
{{--@include('cache.suggestion.'.ceil($music->music_id / 1000).'.'.$music->music_id)--}}
@include('cache.suggestion_cat.'.$music->cat_id.'_'.$music->cat_level)
@include('cache.def_main_cat')
{{--@if(View::exists('cache.code_ads.pc_preroll'))--}}
    @include('cache.code_ads.pc_preroll')
{{--@endif--}}
{{--@if(View::exists('cache.code_ads.pc_preroll_2'))--}}
    @include('cache.code_ads.pc_preroll_2')
{{--@endif--}}
{{--@if(View::exists('cache.code_ads.pc_preroll_3'))--}}
    @include('cache.code_ads.pc_preroll_3')
{{--@endif--}}
{{--@if(View::exists('cache.code_ads.pc_midroll'))--}}
    @include('cache.code_ads.pc_midroll')
{{--@endif--}}
{{--@if(View::exists('cache.code_ads.pc_midroll_2'))--}}
    @include('cache.code_ads.pc_midroll_2')
{{--@endif--}}

<?php
use App\Library\Helpers;
global $cat_id2info;
global $cat_url2info;
global $memberVip;
global $album_new;
global $memberVip;
global $typeDup;
//global $MusicSameArtist;
//global $VideoSameArtist;
//global $titleDup;
//global $video;
global $pc_preroll;
global $pc_preroll_2;
global $pc_preroll_3;
global $pc_midroll;
global $pc_midroll_2;
$memberVip = Helpers::checkMemberVip();

$partListenFullUrl = Helpers::listen_url($music, '');
$titleMeta = $music->music_title . ' - '. str_replace(';', ', ', $music->music_artist);
$file_url = Helpers::file_url($music);
if($musicSet['type_jw'] == 'music' && !Auth::check()) {
    if(last($file_url)['label'] == 'Lossless') {
        array_pop($file_url);
    }
}
$lyric_array = Helpers::lyric_to_web($music->music_lyric);
$artistHtml = Helpers::rawHtmlArtists($music->music_artist_id, $music->music_artist);
preg_match('/href=["\']?([^"\'>]+)["\']?/', $artistHtml, $matchArtist);
$sug = [];
$sug = Helpers::getRandLimitArr($typeDup, LIMIT_SUG_MUSIC - count($titleDup) + 3);
$thumnailMusic =$musicSet['type_jw'] != 'video' ?  Helpers::cover_url($music->cover_id) : Helpers::thumbnail_url($music->toArray(), 'preview');
$thumnailMeta = '';
$music_lyric_karaoke = '';
$titleExMeta = $music->music_title.'; '.$music->music_artist;
if($musicSet['type_listen'] == 'playlist') {
    $thumnailMeta = $musicSet['playlist']->playlist_cover;
    $titleExMeta = $musicSet['playlist']->playlist_title;
} else {
    $thumnailMeta = $thumnailMusic;
}
?>
@section('meta')
    <meta name="author" content="{{$music->music_username}}">
    <meta name="copyright" content="{{env('APP_URL')}}" />
    <meta name="revisit-after" content="7 Days">
    <meta name="keywords" content="{{$music->music_title}}, {{$music->music_artist}}, <?php echo $musicSet['type_jw'] == 'video' ? 'HD 1080p, HD 720p, MV 480p, MV 360p, video, mv, hd, mp4' : 'Lossless, 500kbps, 320kbps, music, mp3, m4a, flac, lossless' ?>, csn, nghe nhac, tai nhac, loi bai hat, lyrics">
    <meta name="description" content="<?php echo $musicSet['type_jw'] == 'video' ? 'Nghe online video '.$music->music_title.' do ca sĩ '.$music->music_artist.' thể hiện. Tải nhạc dạng hd, mp4 và xem lời bài hát '.$music->music_title.' hoàn toàn miễn phí.' : 'Nghe online bài hát '.$music->music_title.' do ca sĩ '.$music->music_artist.' thể hiện. Tải nhạc dạng mp3, m4a, lossless và xem lời bài hát '.$music->music_title.' hoàn toàn miễn phí.' ?>">
    <link rel="canonical" href="<?php echo Helpers::listen_url($music, true) ?>" />
    <link rel="image_src" href="{{$thumnailMeta}}" />
    <meta name="title" content="<?php echo $titleExMeta?>" />
    <meta property="fb:app_id" content="419934814770318" />
    <meta property="og:image" content="{{$thumnailMeta}}" />
    <meta property="og:url" content="{{url()->current()}}" />
    <meta property="og:title" content="<?php echo $titleExMeta?>" />
    <meta property="og:description" content="Sáng tác: {{$music->music_composer}} ({{$music->music_year}}); <?php echo $musicSet['type_jw'] == 'video' ? 'Chất lượng: HD 1080p, HD 720p, MV 480p, MV 360p' : 'Chất lượng: Lossless, 500kbps, 320kbps' ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:updated_time" content="{{time()}}" />
@endsection
@section('contentCSS')
    <script src="https://sp.zalo.me/plugins/sdk.js"></script>
    <link href="{{env('APP_URL')}}/node_modules/rabbit-lyrics/dist/rabbit-lyrics.css" rel="stylesheet" type="text/css"/>
    <script src="{{env('APP_URL')}}/node_modules/rabbit-lyrics/dist/rabbit-lyrics.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}/css/csn-jwplayer.css">
@endsection
@extends('web.layouts.app')
@section('content')
    <div class="box_space"></div>
    <div class="container">
        <div class="row row_wrapper">
            <div class="col-md-9">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <?php
                            $catMusic = $cat_id2info[$music->cat_id];
                            $prefixCatUrl = $music->cat_id == CAT_VIDEO ? VIEW_VIDEO_URL : VIEW_MUSIC_URL;
                        ?>
                        <li class="breadcrumb-item"><a href="{{env('APP_URL').'/'.$prefixCatUrl.'/'.$catMusic[0]['cat_url']}}.html">{{$catMusic[0]['cat_title']}}</a></li>
                        <li class="breadcrumb-item"><a href="{{env('APP_URL').'/'.$prefixCatUrl.'/'.$catMusic[0]['cat_url'].'/'.$catMusic[$music->cat_level]['cat_url']}}.html">{{$catMusic[$music->cat_level]['cat_title']}}</a></li>
                    </ol>
                </nav>
                <div class="d-flex justify-content-between mb-3 box1 music-listen-title" style="line-height: 33px;">
                    <h1 class="title">{{$music->music_title}} - <?php echo str_replace(";", "; ", $music->music_artist); ?></h1>
                    <span title="Đăng tải: {{date('d/m/Y h:i', $music->music_time)}}" class="d-flex listen"><i class="material-icons" style="padding-top: 3px;">headset</i> {{number_format($music->music_listen)}}&nbsp;&nbsp;<i class="material-icons" style="font-size: 28px;">cloud_download</i> {{number_format($music->music_downloads)}}</span>
                </div>
                <div class="card mb-4 detail_lyric_1">
                    <div id="csnplayerads" style="position:relative; z-index: 99999; width:100%;"> </div>
                    <div id="csnplayer" class="<?php echo $musicSet['type_jw'] == 'video' ? 'csn_video' : 'csn_music' ?>" style="position:relative; z-index: 99999; width:100%;"> </div>
                    <div id="hidden_lyrics" class="hidden">
                        <div id="lyrics" class="rabbit-lyrics">
                            @if($musicSet['type_jw'] != 'video')
                            <?php
                                $music_lyric_karaoke = $music->musicKara;
                                $music_lyric_karaoke = $music_lyric_karaoke ? Helpers::rawLyrics($music->musicKara->music_lyric_karaoke) : '';
                                echo $music_lyric_karaoke;
                            ?>
                            @endif
                        </div>
                    </div>
                    <div class="music_recommendation" style="border-bottom: 1px solid rgba(0,0,0,.125);">
                        <div class="d-table">
                            <?php
                            if(($musicSet['type_listen'] == 'playlist' || $musicSet['type_listen'] == 'album') && !empty($musicSet['playlist_music'])){
                                array_map(function ($i, $item) use($music, $musicSet) {
                                $url = Helpers::listen_url($item);
//                                $urlAlbum = url()->current() .(isset($musicSet['page']) ? '?trang='.$musicSet['page'] . '&playlist=' . ++$i : '?playlist=' . ++$i);
                                $urlAlbum = url()->current() . '?playlist=' . ++$i;
                                ?>
                                    <div id="music-listen-{{$item['music_id']}}" class="card-footer{{($music->music_id == $item['music_id'] ? ' listen' : '')}}" style="display: table-row;">
                                        <div class="name d-table-cell">
                                            <a href="{{$urlAlbum}}" title="{{$item['music_shortlyric'] ?? $item['music_title']}}">{{$i . '. ' . $item['music_title']}}</a>
                                        </div>
                                        <div class="author d-table-cell">
                                            <div class="author-ellepsis">
                                                <?php echo Helpers::rawHtmlArtists($item['music_artist_id'], $item['music_artist']) ?>
                                            </div>
                                        </div>
                                        <div class="tool d-table-cell text-right">
                                            <ul class="list-inline d-flex align-items-center justify-content-end">
                                                <li class="list-inline-item"><a href="{{$url}}" title="nghe riêng nhạc {{$item['music_title']}}"><i class="material-icons">headset</i></a></li>
                                                <li class="list-inline-item"><a onclick="addPlaylistTable('{{str_replace("'", "\'", $item['music_title'])}}', '{{$item['music_id']}}', '{{isset($item['music_artist']) ? $item['music_artist'] : "false"}}', '{{isset($item['music_artist_id']) ? $item['music_artist_id'] : "false"}}')" href="javascript:void(0)" title="thêm vào playlist"><i class="material-icons">playlist_add</i></a></li>
                                                <li class="list-inline-item"><a class="fb-share-link" href="{{$url}}" title="chia sẻ {{$item['music_title']}}"><i class="material-icons">share</i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php
                                    },array_keys($musicSet['playlist_music']), $musicSet['playlist_music']);
                                ?>
                                <div class="box_show_add_playlist card show_add_playlist" style="display: none" id="answer-12878316">
                                    <div class="card-body d-flex flex-column">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i class="material-icons">close</i>
                                        </button>
                                        <h5 class="card-title box_add_playlist"></h5>
                                        <div class="box_show_playlist box_show_playlist_popup mb-2 box-playlist all-playlist">
                                            <div class="list-group">

                                            </div>
                                        </div>
                                        <div class="input-group create_playlist">
                                            <input type="text" class="form-control box_text_create_playlist" placeholder="Nhập tên playlist mới cần tạo" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" onclick="btnCreatePlaylist('box_text_create_playlist')" type="button">Tạo Playlist mới</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-details">
                            <div id="companion_cover"><img src="{{$thumnailMusic}}" alt="" class="card-img-top"></div>
                            <div class="card-body">
                                <h2 class="card-title">{{$music->music_title}}</h2>
                                <ul class="list-unstyled">
                                    <?php
                                    echo $music->music_artist ? '<li><span>Ca sĩ: </span>'.$artistHtml.'</li>' : '' ?>
                                    <?php echo $music->music_composer ? '<li><span>Sáng tác: </span><a href="/tim-kiem?q='.$music->music_composer.'&mode=sang-tac" style=" color: #212552; ">'.$music->music_composer.'</a></li>' : '' ?>
                                    <?php echo $music->music_album ? '<li><span>Album: </span><a href="'.Helpers::album_url(['music_album' => $music->music_album, 'cover_id' => $music->cover_id ]).'">'.$music->music_album.'</a></li>' : '' ?>
                                    <?php echo $music->music_year ? '<li><span>Năm phát hành: </span>'.$music->music_year.'</li>' : '' ?>
                                    @if($memberVip && $musicSet['type_jw'] == 'music' && ($musicSet['type_listen'] == 'playlist' || $musicSet['type_listen'] == 'album'))
                                    <li><a class="link_more download_album" href="javascript:void(0)" onclick="downloadAlbum('{{$_SERVER['REQUEST_URI']}}')" title="Download tât cả bài hát trong album {{$music->music_album}}">Download {{$musicSet['type_listen'] == 'playlist' ? 'Playlist' : 'Album'}}</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="d-flex justify-content-between mb-3">
                            <div class="title2">
                                Đóng góp: <span class="author"><a target="_blank" href="/user/{{$music->music_user_id}}">{{$music->music_username}}</a></span>
                            </div>
                            <div>
                                <div class="fb-like" data-href="{{url()->current()}}" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                            </div>
                        </div>
                        <ul class="nav nav-pills nav-justified mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-liric-tab" data-toggle="pill" href="#pills-liric" role="tab" aria-controls="pills-liric" aria-selected="true"><i class="material-icons">queue_music</i> Lyric</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-download-tab" data-toggle="pill" href="#pills-download" role="tab" aria-controls="pills-download" aria-selected="false"><i class="material-icons">file_download</i> Download</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-share-tab" data-toggle="pill" href="#pills-share" role="tab" aria-controls="pills-share" aria-selected="false"><i class="material-icons">share</i> Chia sẻ</a>
                            </li>
                            @if($musicSet['type_jw'] !== 'video')
                            <li class="nav-item">
                                <a class="nav-link add_playlist" <?php echo $musicSet['type_jw'] !== 'video' ? 'onclick="loadPlayList('.$music->music_id.')"' : '' ?> id="pills-plus-tab" data-toggle="pill" href="#pills-plus" role="tab" aria-controls="pills-plus" aria-selected="false"><i class="material-icons">control_point</i> Thêm</a>
                            </li>
                            @endif
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane show active" id="pills-liric" role="tabpanel"
                                 aria-labelledby="pills-liric-tab">
                                <ul class="nav nav-tabs sub_Tab" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <div class="nav-link form-group form-check mb-0 autoplay"
                                             style="padding: 10px 20px;">
                                            <input type="checkbox" checked class="form-check-input display-sub"
                                                   id="display-sub" onclick="display_sub()">


                                            <div class="form-check-label d-flex align-items-center">
                                                @if((isset($lyric_array['sub']) && $lyric_array['sub'] != false))
                                                    <label class="form-check-label d-flex align-items-center" for="display-sub" style="margin-right: 10px;">
                                                        <span style="font-size: 13px; color: #4b4b4b; font-family: 'SFProDisplay-Medium';"
                                                              class="txt">Hiển Thị Sub</span>
                                                                <span class="switch">
                                                            <span class="switch-inner"></span>
                                                        </span>
                                                    </label>
                                                @endif
                                                @if(Auth::check())
                                                    @if(backpack_user()->can('duyet_sua_nhac'))
                                                        <a href="/dang-tai/{{$musicSet['type_jw'] !== 'video' ? 'nhac' : 'video'}}/{{$music->music_id}}">Sửa nhạc</a>
                                                        <a href="javascript:sugLyric();" style="margin-left: 10px;">Gợi ý/c.sửa lyric</a>
                                                        <a href="javascript:sugKaraoke();" style="margin-left: 10px;">Gợi ý/c.sửa karaoke</a>
                                                        <a href="javascript:mergeMusic();" style="margin-left: 10px;">Nhập nhạc</a>
                                                    @else
                                                        <a href="javascript:sugLyric();">Gợi ý lyric</a>
                                                        <a href="javascript:sugKaraoke();" style="margin-left: 10px;">Gợi ý karaoke</a>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <br/>
                                <div class="tab-content tab-lyric" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel"
                                         aria-labelledby="home-tab">
                                        @if(!$memberVip)
{{--                                            @if(View::exists('cache.code_ads.pc_inread_player'))--}}
                                                @include('cache.code_ads.pc_inread_player')
                                            {{--@endif--}}
                                        @endif
                                            
                                        <article>
                                            <div id="fulllyric">
                                                @if(isset($lyric_array['lyric']))
                                                    <?php echo $lyric_array['lyric'] ?>
                                                @endif
                                            </div>
                                            <div id="morelyric" style="cursor:pointer" onclick="show_fulllyric();" align="right"></div>
                                        </article>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="pills-download" role="tabpanel" aria-labelledby="pills-download-tab">
                                <div class="card card2">
                                    <div class="card-header">
                                        <h4 class="card-title">Vui lòng click chọn một trong các liên kết ở bên dưới để tải bài bài hát <span class="text-pink m-1">{{$music->music_title}}</span> về máy:</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 tab_download_music">
                                                <ul class="list-unstyled download_status">
                                                    <?php
                                                    if ( isset($file_url[1]['url']) ){
                                                        echo '<li><a class="download_item" href="'. $file_url[1]['url'] .'" title="Click vào đây để tải bài hát '. $music->music_title .'"><i class="material-icons">file_download</i> Link tải nhạc <span class="c1">'. strtoupper($file_url[1]['type']) .' '. $file_url[1]['label'] .'</span> '. $file_url[1]['size'] .'</a></li>' . "\n";
                                                    }
                                                    if ( isset($file_url[2]['url']) ){
                                                        echo '<li><a class="download_item" href="'. $file_url[2]['url'] .'" title="Click vào đây để tải bài hát '. $music->music_title .'"><i class="material-icons">file_download</i> Link tải nhạc <span class="c2">'. strtoupper($file_url[2]['type']) .' '. $file_url[2]['label'] .'</span> '. $file_url[2]['size'] .'</a></li>' . "\n";
                                                    }
                                                    if ( isset($file_url[3]['url']) ){
                                                        echo '<li><a class="download_item" href="'. $file_url[3]['url'] .'" title="Click vào đây để tải bài hát '. $music->music_title .'"><i class="material-icons">file_download</i> Link tải nhạc <span class="c3">'. strtoupper($file_url[3]['type']) .' '. $file_url[3]['label'] .'</span> '. $file_url[3]['size'] .'</a></li>' . "\n";
                                                    }
                                                    if ( isset($file_url[4]['url']) ){
//                                                        echo '<li><a class="download_item" href="javascript:downLossLessMusic();" title="Click vào đây để tải bài hát '. $music->music_title .'"><i class="material-icons">file_download</i> Link tải nhạc <span class="c4">'. strtoupper($file_url[4]['type']) .' '. $file_url[4]['label'] .'</span> '. $file_url[4]['size'] .'</a></li>' . "\n";
                                                        echo '<li><a class="download_item" href="'. $file_url[4]['url'] .'" title="Click vào đây để tải bài hát '. $music->music_title .'"><i class="material-icons">file_download</i> Link tải nhạc <span class="c4">'. strtoupper($file_url[4]['type']) .' '. $file_url[4]['label'] .'</span> '. $file_url[4]['size'] .'</a></li>' . "\n";
                                                    }
                                                    if ( isset($file_url[0]['url']) ){
                                                        echo '<li><a class="download_item" href="'. $file_url[0]['url'] .'" title="Click vào đây để tải bài hát '. $music->music_title .'"><i class="material-icons">file_download</i> Link tải nhạc chất lượng thấp: '. strtoupper($file_url[0]['type']) .' '. $file_url[0]['label'] .' '. $file_url[0]['size'] .'</a></li>' . "\n";
                                                    }
                                                    ?>
                                                </ul>

                                            </div>
                                            <div class="col">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion" id="accordion">
                                        @if($music->cat_id != CAT_VIDEO)
                                        <div class="card flex-column-reverse">
                                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                                <div class="card-body p-0">
                                                    <img class="card-img-top" src="{{Helpers::getImgQuality($music->music_id)}}" alt="">
                                                </div>
                                            </div>
                                            <div class="card-header border-0" id="headingOne">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        Xem quang phổ (Spectrum) tại đây:
                                                        <i class="material-icons">keyboard_arrow_down</i>
                                                    </button>
                                                </h5>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="card flex-column-reverse">
                                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                                <div class="card-body p-0">
                                                    <div class="list-group">
                                                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                                            <div class="d-flex w-100 justify-content-between">
                                                                <h5 class="mb-1">Đối với nhu cầu bình thường:</h5>
                                                            </div>
                                                            <p class="mb-1">bạn nên chọn Link Download 1, là định dạng âm thanh MP3 với chất lượng 128kbps được nhiều thiết bị nghe nhạc hỗ trợ.</p>
                                                        </a>
                                                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                                            <div class="d-flex w-100 justify-content-between">
                                                                <h5 class="mb-1">Đối với nhu cầu thưởng thức nhạc cao hơn:</h5>
                                                            </div>
                                                            <p class="mb-1">bạn nên chọn Link Download 2, là định dạng âm thanh MP3 với chất lượng 320kbps có dung lượng lớn hơn nhưng nghe hay và chi tiết hơn định dạng MP3 128kbps.</p>
                                                        </a>
                                                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                                            <div class="d-flex w-100 justify-content-between">
                                                                <h5 class="mb-1">Đối với nhu cầu thưởng thức nhạc cao cấp:</h5>
                                                            </div>
                                                            <p class="mb-1">bạn nên chọn Link Download 3, là định dạng âm thanh M4A với chất lượng gần 500kbps có dung lượng lớn hơn nhưng nghe hay và chi tiết hơn định dạng MP3 320kbps.</p>
                                                        </a>
                                                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                                            <div class="d-flex w-100 justify-content-between">
                                                                <h5 class="mb-1">Đối với nhu cầu thưởng thức nhạc chuyên nghiệp:</h5>
                                                            </div>
                                                            <p class="mb-1">bạn nên chọn Link Download 4, là định dạng âm thanh Lossless với chất lượng gốc giống như chất lượng âm thanh bạn nghe từ đĩa CD. Tuy nhiên, để nghe được định dạng này có thể thiết bị nghe nhạc của bạn cần phải cài đặt thêm plugin/codec hỗ trợ decode tập tin âm thanh FLAC.</p>
                                                        </a>
                                                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                                            <div class="d-flex w-100 justify-content-between">
                                                                <h5 class="mb-1">Đối với nhu cầu lưu trữ trên các thiết bị có dung lượng khiêm tốn:</h5>
                                                            </div>
                                                            <p class="mb-1">(ví dụ điện thoại di động...), bạn nên chọn Link Mobile Download, là định dạng âm thanh M4A với chất lượng 32kbps có dung lượng cực nhỏ nhưng vẫn nghe hay và rõ gần bằng MP3 128kbps.</p>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-header border-0" id="headingTwo">
                                                <h5 class="mb-0">
                                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                        Hướng dẫn download nhạc:
                                                        <i class="material-icons">keyboard_arrow_down</i>
                                                    </button>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="pills-share" role="tabpanel" aria-labelledby="pills-share-tab">
                                <div class="form-group">
                                    <ul class="list-inline mb-1">
                                        <li class="list-inline-item"><a class="fb-share-link" href="{{url()->current()}}" title="{{$music->music_title}}"></a></li>
                                        <li class="list-inline-item"><a class="messenger-share-link" href="{{url()->current()}}" title="{{$music->music_title}}"></a></li>
                                        <li class="list-inline-item"><div class="zalo-share-button" data-href="" data-oaid="579745863508352884" data-layout="1" data-color="white" data-customize=true><a class="zalo-share-button" href="javascript:void(0)" title="Chia sẻ {{$music->music_title}}"></a></div></li>
                                    </ul>
                                    <input type="email" class="form-control" id="share_link" aria-describedby="emailHelp" placeholder="" value="{{env('APP_URL').url()->getRequest()->getRequestUri()}}">
                                </div>
                                <div class="form-group" id="embed">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <label for="exampleInputEmail1" class="m-0">Mã nhúng</label>
                                        <div class="d-flex align-items-center">
                                            <div class="form-check m-0">
                                                <input class="form-check-input" type="checkbox" value="1" id="old_embed">
                                                <label class="form-check-label" for="old_embed">
                                                    Mã kiểu cũ
                                                </label>
                                            </div>
                                            <div class="form-check m-0 ml-3">
                                                <input class="form-check-input" type="checkbox" value="1" id="auto_play" checked>
                                                <label class="form-check-label" for="auto_play">
                                                    Tự động play
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <textarea class="form-control" id="embed_textarea" rows="3" value=""><iframe src="{{env('APP_URL').'/embed/'.$partListenFullUrl}}?auto=true"  scrolling="no" width="640" height="180" frameborder="0" allowfullscreen="true" allow="encrypted-media" allowfullscreen></iframe></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="size_embed">Kích thước</label>
                                    <select class="form-controls" id="size_embed">
                                        <option selected value='width="640" height="180"'>640x180</option>
                                        <option value='width="100%"'>full screen</option>
                                    </select>
                                </div>
                            </div>
                            <div class="tab-pane" id="pills-plus" role="tabpanel" aria-labelledby="pills-plus-tab">
                                @if($musicSet['type_jw'] !== 'video')
                                <div class="card mb-0 card3">
                                    <div class="card-header mb-0">
                                        <h4 class="card-title">Thêm bài hát <span class="text-pink m-1">{{$music->music_title}}</span> vào danh sách Playlist</h4>
                                    </div>
                                </div>
                                <div class="card mb-2 playlist_1 border-0">
                                    <div class="card-body playlist-csn tab-playlist all-playlist">
                                        <ul class="list-unstyled mb-0">
                                        </ul>
                                    </div>
                                </div>
                                <div class="input-group mb-3 create_playlist">
                                    <input type="text" class="form-control text-create-playlist" placeholder="Nhập tên playlist mới cần tạo" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary " onclick="btnCreatePlaylist('text-create-playlist')" type="button">Tạo Playlist mới</button>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row row10px">
                    <div data-bs-native="728x90"></div>
                    <script type="text/javascript" src="https://cdn.innity.net/admanager.js"></script>
                    <script type="text/javascript">
                        new innity_adZone("79c662560b0a5f1ae00b623ad8c775e3", "87808", {"origin": "VN","width": "728", "height": "90"});
                    </script>
                </div>

                @if($MusicSameArtist)
                    <div class="box_header d-flex justify-content-between align-items-end">
                        <h5 class="title m-0">Bài hát cùng ca sĩ</h5>
                        <a class="link_more" href="{{$matchArtist[1]}}" title="Xem tất cả">Xem tất cả</a>
                    </div>
                    <div class="row row10px float-col-width">
                        <?php
                        $MusicSameArtist = Helpers::getRandLimitArr($MusicSameArtist, LYRIC_DETAIL_NEW_MUSIC);
                        array_map(function ($item) {
                        $url = Helpers::listen_url($item);
                        ?>
                        <div class="col">
                            <div class="card card1">
                                <div class="card-header" style="background-image: url({{Helpers::cover_url($item['cover_id'])}});">
                                    <a href="{{$url}}" title="{{$item['music_title']}}">
                                        <span class="icon-play"></span>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title"><a href="{{$url}}" title="{{$item['music_title']}}">{{$item['music_title']}}</a></h3>
                                    <p class="card-text"><?php echo Helpers::rawHtmlArtists($item['music_artist_id'], $item['music_artist']) ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                        }, $MusicSameArtist)
                        ?>
                    </div>
                @endif
                @if($VideoSameArtist)
                <div class="box_header d-flex justify-content-between align-items-end">
                    <h5 class="title m-0">Video cùng ca sĩ</h5>
                    <a class="link_more" href="{{$matchArtist[1]}}?tab=video" title="Xem tất cả">Xem tất cả</a>
                </div>
                <div class="row row10px float-col-width">
                    <?php
                    $VideoSameArtist = Helpers::getRandLimitArr($VideoSameArtist, LYRIC_DETAIL_NEW_ALBUM);
                    array_map(function ($item) {
                    $url = Helpers::listen_url($item);
                    ?>
                    <div class="col">
                        <div class="card card1 video">
                            <div class="card-header" style="background-image: url({{Helpers::thumbnail_url($item)}});">
                                <a href="{{$url}}" title="{{$item['music_title']}}">
                                    <span class="icon-play"></span>
                                </a>
                            </div>
                            <div class="card-body">
                                <h3 class="card-title"><a href="{{$url}}" title="{{$item['music_title']}}">{{$item['music_title']}}</a></h3>
                                <p class="card-text"><?php echo Helpers::rawHtmlArtists($item['music_artist_id'] ?? '', $item['music_artist'] ?? '') ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                    }, $VideoSameArtist);
                    ?>
                </div>
                @endif
                <div class="box_header d-flex justify-content-between align-items-end" id="post_comment">
                    <h5 class="title m-0">Bình luận của bạn</h5>
                </div>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <strong>Thành công!</strong> {{ $message }}
                    </div>
                @endif
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger">
                        <strong>Lỗi!</strong> {{ $message }}
                    </div>
                @endif
                <form class="box_form_comment form-comment-0">
                    <div class="form-group emoji-picker-container">
                        <textarea class="form-control comment" name="comment" rows="3" placeholder="Viết bình luận của bạn tại đây." data-emojiable="true"></textarea>
                        <input type="hidden" class="music_id" name="music_id" value="{{ $music->music_id }}">
                        <button onclick="postComment(0)"  class="btn my-2 my-sm-0 waves-effect waves-light btn-upload btn_cloud_up" style="float: right; min-width: 75px;">Đăng Bình Luận</button>
                    </div>
                </form>
                <div class="list_comment">
                    <div class="list_header d-flex align-items-center music_comment">
                        <i class="material-icons">chat_bubble</i> <span>{{number_format($music->music_comment)}}</span> &nbsp;comment
                    </div>
                    <div class="list_body">

                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div id="right1_banner" style=" max-width: 100%;">
                    @if ($music->cat_id == 6)
                        <a href="https://www.facebook.com/groups/csn.kpop.fan/" target="_blank"><img src="/images/banner/kpop-fbgroup-300x170.jpg" width="300" height="170"></a>
                    @else
                        @if(!$memberVip)
{{--                            @if(View::exists('cache.code_ads.pc_right_player'))--}}
                                @include('cache.code_ads.pc_right_player')
                            {{--@endif--}}
                        @endif
                    @endif
                </div>

                <br>

                @if(!empty($video))
                    <?php
                        $urlVideo = Helpers::listen_url($video);
                    ?>
                    <div class="box_header d-flex justify-content-between align-items-end">
                        <h5 class="title m-0">MV của bài hát</h5>
                    </div>
                    <ul class="list-unstyled mv_sing">
                        <li class="media">
                            <div class="media-left align-self-center mr-2">
                                <a href="{{$urlVideo}}" title="{{$video['music_title']}}">
                                    <img src="{{Helpers::thumbnail_url($video)}}" alt="{{$video['music_title']}}">
                                    <i class="material-icons">play_circle_outline</i>
                                </a>
                            </div>
                            <div class="media-body align-self-center">
                                <h5 class="mt-0 media-title"><a href="{{$urlVideo}}" title="">{{$video['music_title']}}</a></h5>
                                <div class="author"><?php echo Helpers::rawHtmlArtists($video['music_artist_id'], $video['music_artist']) ?></div>
                            </div>
                        </li>
                    </ul>
                @endif
                @if($sug)
                <div class="box_header d-flex justify-content-between align-items-end">
                    <h5 class="title m-0">Gợi ý</h5>
                        <div class="form-group form-check mb-0 autoplay">
                            <input type="checkbox" class="form-check-input check_auto_play" id="exampleCheck1" checked>
                            <label class="form-check-label d-flex align-items-center" for="exampleCheck1">
                                <span class="txt">Tự động chuyển tiếp</span>
                                <span class="switch">
							<span class="switch-inner"></span>
						</span>
                            </label>
                        </div>
                </div>
                <ul class="list-unstyled list_music sug_music">
                    <?php
                    $music_history = unserialize($musicSet['music_history']['cookie']);
                    if($titleDup) {
                        foreach ($titleDup as $item) {
                            $music_history[] = $item['music_id'];
                        }
                    }
                    foreach($sug as $key => $item) {
                        if(in_array($item['music_id'], $music_history)) {
                            unset($sug[$key]);
                        }
                    }
                    if(isset($titleDup[0])) {
                        $sug1 = array_merge(array_slice($sug, 0, 3), [$titleDup[0]]);
                        shuffle($sug1);
                        if(isset($titleDup[1])) {
                            $sug2 = array_merge(array_slice($sug, 4, 5), [$titleDup[1]]);
                            shuffle($sug2);
                        }else{
                            $sug2 = array_slice($typeDup, 4, 6);
                        }
                        $sug = array_merge($sug1, $sug2);
                    }else{
                        $sug = array_slice($sug, 0, LIMIT_SUG_MUSIC);
                    }
                    $typeJw = $musicSet['type_jw'];
                    array_map(function ($item) use ($music_history, $typeJw) {
                        $url = Helpers::listen_url($item);
                        ?>
                        <li class="media align-items-stretch">
                            <div class="media-left align-items-stretch mr-2">
                                <a href="{{$url}}" title="{{$item['music_title']}}">
                                    <img class="{{$typeJw == 'video' ? 'video_thumbnail' : ''}}" src="{{$typeJw == 'video' ? Helpers::thumbnail_url($item) : Helpers::cover_url($item['cover_id'])}}" alt="">
                                    <i class="material-icons">play_circle_outline</i>
                                    <span class="cover"></span>
                                </a>
                            </div>
                            <div class="media-body align-items-stretch d-flex flex-column justify-content-between p-0">
                                <div>
                                    <h5 class="media-title mt-0 mb-0"><a href="{{$url}}" title="{{$item['music_shortlyric'] ?? $item['music_title']}}">{{$item['music_title']}}</a></h5>
                                    <div class="author"><?php echo $item['music_artist_html'] ?></div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <small class="type_music c1"><?php echo $item['music_bitrate_html']; ?></small>
                                    <div class="media-right">
                                        <small class="time_stt"><i class="material-icons listen-material-icons"> play_arrow </i>{{number_format($item['music_listen'])}}</small>
                                        <ul class="list-inline">
                                            <li class="list-inline-item"><a href="{{$url}}" title="nghe riêng {{$item['music_title']}}"><i class="material-icons">headset</i></a></li>
                                            <li class="list-inline-item"><a target="_blank" class="fb-share-link" href="{{Helpers::fbShareLink($url)}}" title="share {{$item['music_title']}}"><i class="material-icons">share</i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php
                    }, $sug)
                    ?>

                </ul>
                @endif
                {{--<div class="card mb-3 cardads">--}}
                    {{--<a class="card-img-top" href="#" title=""><img class="" src="https://magiamgia.com/wp-content/uploads/2015/08/lazada-banner-con-mua-deals_336x280.jpg" alt=""></a>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>


@endsection
@section('contentJS')
    <script src="https://ssl.p.jwpcdn.com/player/v/8.1.3/jwplayer.js"></script>
    {{--<script src="{{URL::to('/')}}/assets/jwplayer-7.12.0/jwplayer.js"></script>--}}
    {{--<script src="/js/m17.js"></script>--}}
    <script>
        var musicId = '<?php echo $music->music_id ?>';
        var artists = "<?php echo $music->music_artist  ?>";
        var artistIds = '<?php echo $music->music_artist_id  ?>';
        var musicAddId = '';
        //////////////////////////
        ////JW Player//////////
        ////////////////////////

        <?php
        if(count($musicSet['playlist_music']) > 5){
            ?>
            var vtop = document.getElementById("music-listen-<?php echo $music->music_id ?>").offsetTop;
            $('.music_recommendation').animate({scrollTop: vtop - 50}, 'slow');
            <?php
        }
        ?>
        jwplayer.key="W7zSm81+mmIsg7F+fyHRKhF3ggLkTqtGMhvI92kbqf/ysE99";
        var player = jwplayer('csnplayer');
        var firstPlayer = true;
        <?php
        if($musicSet['type_jw'] != 'video' && !$memberVip) {
            ?>
        jwplayer("csnplayerads").setup({
            advertising: {
                client: "vast",
                skipoffset: 5,
                "adschedule": {
                    "myPreroll": {
                        "offset": "pre",
                        "tag": <?php echo json_encode($pc_preroll); ?>
                    },
                    "myPreroll2": {
                        "offset": 1,
                        "tag": <?php echo json_encode($pc_preroll_2); ?>
                    },
                    "myPreroll3": {
                        "offset": 2,
                        "tag": <?php echo json_encode($pc_preroll_3); ?>
                    },
                    "myMidroll": {
                        "offset": 3,
                        "tag": <?php echo json_encode($pc_midroll); ?>
                    },
                    "myMidroll2": {
                        "offset": 4,
                        "tag": <?php echo json_encode($pc_midroll_2); ?>
                    }
                }
            },
            mute: true,
            width: "100%",
            aspectratio: "16:9",
            autostart: "viewable",
            file: "https://chiasenhac.vn/video/csn-5s.mp4",
            autoPause: {
                "viewability": true
            },
            events: { "beforeComplete": function() { $('#csnplayerads').remove(); } }
        });
            <?php
        }
        ?>


        player.setup({
            <?php if ( $music->music_id == 299247 ) {
                echo '
                advertising: {
                    client: "vast",
                    skipoffset: 5,
                    "adschedule": {
                        "myPreroll": {
                            "offset": "pre",
                            "tag": ["https://bid.g.doubleclick.net/xbbe/bid/xpub?deal_id=7928304_695456&max_duration=15&ord=[timestamp]&dc_sdk_apis=[APIFRAMEWORKS]&dc_omid_p=[OMIDPARTNER]&dc_rdid="]
                        }
                    }
                },
                ';
            }
            else if ($musicSet['type_jw'] == 'video') {
                echo '
                advertising: {
                    client: "vast",
                    skipoffset: 5,
                    "adschedule": {
                        "myPreroll": {
                            "offset": "pre",
                            "tag": ';
                echo json_encode($pc_preroll);
                echo '
                        }
                    }
                },
                ';
            }
            else if ( $music->music_id == 234567 ) {
                echo '
                    advertising: {
                        client: "vast",
                        skipoffset: 5,
                        "companiondiv": {
                                "id": "right1_banner",
                                "width": 300,
                                "height": 250
                        },
                        "adschedule": {
                            "myPreroll": {
                                "offset": "pre",
                                "tag": ["https://delivery.lavanetwork.net/www/delivery/fc.php?script=bannerTypeHtml:vastInlineBannerTypeHtml:vastInlineHtmlExtend&format=vast&nz=1&zones=pre-roll%3D3193&version=2"]
                        }
                    }
                },
                ';
                    }
            ?>
            width: '100%',
            height: '88',
            repeat: false,
            aspectratio: "<?php echo $musicSet['type_jw'] == 'video' ? '16:9' : 'false' ?>",
            stretching: 'fill',
            sources: [
                    <?php
                    $typeJwSource = $musicSet['type_jw'] == 'video' ? 'mp4' : 'mp3';
                    for ($i=0; $i<sizeof($file_url); $i++){
                        echo '{"file": "'. $file_url[$i]['url'] .'", "label": "'. $file_url[$i]['label'] .'", "type": "'.$typeJwSource.'", "default": '. (($i==1) ? 'true' : 'false') .'},';
                    }
                    ?>
            ],
            title: "<?php echo $music->music_title ?>",
            skin: {
                name: 'nhac'
            },
            timeSliderAbove: true,
            autostart: true,
            controlbar: "bottom",
            plugins: {
                '<?php echo $musicSet['type_listen'] == 'single' ? '/js/nhac-csn.js' : '/js/nhac-playlist.js' ?>': {
                    duration: 20,
                    msisdn: '',
                    package_id: 0,
                    album_id : '0',
                    content_type: 'song',
                    utm_source: '',
                    utm_medium: '',
                    utm_term: '',
                    utm_content: '',
                    utm_campaign: '',
                    device_id: '',
                    channel: 'WEB',
                    url_referer: '',
                    action_type: 'play_song',
                    player_type: 'NotDRM',
                    service_id: 0,
                    source_rec: 'rand',
                    listen_state: 'online',
                    other_info: '',
                    expired_time: 0,
                    version: '1.0'
                }
            },
        });

        jwplayer('csnplayerads').play(false);
        jwplayer('csnplayer').play(true);
        jwplayer().play(true);

        var video_preroll_played = false;
        window.addEventListener('load', function () {
            $('.jw-settings-submenu-button').find('.jw-text').html('Chất lượng');
            document.body.addEventListener('touchstart', function (ae) {
                if (video_preroll_played == false) {
                    video_preroll_played = true;
                    jwplayer('csnplayerads').play(false);
                    jwplayer('csnplayer').play(true);
                    jwplayer().play(true);
                }
            }, false)
        }, false);
        var error_count = 0;
        console.log(jwplayer().getCurrentQuality());
        player.on('error', function(message) {
            let sourceList = player.getPlaylist()[0]['sources'];
            let offsetPlay = jwplayer().getCurrentQuality();
            if (error_count < jwplayer().getQualityLevels().length - 1) {
                if((++offsetPlay) > jwplayer().getQualityLevels().length - 1){
                    offsetPlay = 0;
                }
                player.setCurrentQuality(offsetPlay);
                alertModal('Xin lỗi bài hát này đã bị lỗi! Sẽ chuyển qua chất lượng khác');
                if(offsetPlay < 2) { // 32k, 128k
                    location.reload();
                }
            } else {
                alertModal('Xin lỗi bài hát này đã bị lỗi! Vui lòng trải nghiệm video khác');
                // location.href = "/";
                $.ajax({
                    url: window.location.origin + '/sys/error_slow_bug',
                    type: "POST",
                    dataType: "json",
                    data: {
                        'url': window.location.href,
                        'display_by': 'web'
                    },
                    beforeSend: function () {
                        if(loaded) return false;
                        loaded = true;
                    },
                    success: function(response) {

                    }
                });
            }
            error_count++;
        });



        var device_type = 'desktop';
        var listPlayed =Array();
        var logPlayAudioFlag = false;
        var firstPause = false;

        var embed = 'false';
        var userStatus = 1;
        var firstLoadLyric = false;
        var firstLoadBeforePlay = true;
        var firstLoadUpdateQuality = true;
        var listLyrics = [];
        jwplayer().on('beforePlay', function() {
            //logPlayAudioFlag = true;
            //console.log('set flag again|'+logPlayAudioFlag);
            if(firstLoadBeforePlay) {
                firstLoadBeforePlay = false;
                $('#csnplayer').find('.jw-captions').html($('#hidden_lyrics').html());
                $('#hidden_lyrics').remove();
                <?php
                if($music_lyric_karaoke) {
                    ?>
                    new RabbitLyrics({
                        element: document.getElementById("lyrics"),
                        jw_player: player,
                        viewMode: 'mini',
                        onUpdateTimeJw: false
                    });
                    <?php
                }
                if($musicSet['type_jw'] != 'video') {
                ?>
                $('.jw-display-icon-display').css('display', 'none')
                <?php
                }
                ?>
            }
        });
        <?php
        if($music_lyric_karaoke) {
            ?>
            jwplayer().on('time', function () {
                new RabbitLyrics({
                    element: document.getElementById("lyrics"),
                    jw_player: player,
                    viewMode: 'mini',
                    onUpdateTimeJw: true
                });
            })
            <?php
        }
        ?>

        var setQualityCookie = true;
        jwplayer().on('levels',function(callback){
            $('.jw-settings-submenu-button').find('svg').remove();
            $('.jw-settings-submenu-button').find('lable').remove();
            $('.jw-settings-submenu-button').prepend('<lable class="jw_setting_lable">' + jwplayer().getQualityLevels()[jwplayer().getCurrentQuality()]['label'] + '</lable>');
            if(Cookies.get('label_quality') == 'Lossless') {
                setQualityCookie = false;
                jwplayer().setCurrentQuality(callback.levels.length - 1);
            }
            updateQuality(callback);
            if(Cookies.get('auto_next') == 'true') {
                $('.check_auto_play').prop('checked', false).change();
            }
            // jwplayer().setCurrentQuality(callback.levels.length - 1);
        });
        // jwplayer().onQualityChange(function(callback){
        //     if(setQualityCookie)
        //         Cookies.set('label_quality', callback.levels[callback.currentQuality].label);
        //     setQualityCookie = true;
        //     updateQuality(callback);
        // });
        jwplayer().on('userInactive', function () {
            <?php
            if($musicSet['type_jw'] != 'video') {
                ?>
                $('#csnplayer').removeClass('jw-flag-user-inactive');
                <?php
            }
            ?>
        });

        function onPlayerAutoNextOn()
        {
            Cookies.set('auto_next', false);
            $('.check_auto_play').prop('checked', true).change();
        }
        function onPlayerAutoNextOff()
        {
            Cookies.set('auto_next', true);
            $('.check_auto_play').prop('checked', false).change();
        }
        $('.check_auto_play').on('change', function(){
            if($(this).is(':checked')){
                logPlayAudioFlag = false;
                Cookies.set('auto_next', false);
                setAutoNext(true);
            }else{
                logPlayAudioFlag = true;
                Cookies.set('auto_next', true);
                setAutoNext(false);
                jwplayer().setConfig({
                    repeat: true
                });
            }
        })
        function onPlayerAutoNext()
        {
            AutoPlay(true);
        }
        function onPlayerAutoBack()
        {
            window.location.href = '<?php echo url()->previous() ?>';
        }
        function generateRandom(min, max, except = array()) {
            var valRad = Math.floor(Math.random() * (max - min + 1)) + min;
            return (except.indexOf(valRad) !== -1 ? generateRandom(min, max, except) : valRad);
        }
        function AutoPlay(float = false){
            <?php
                if($musicSet['type_listen'] == 'single') {
                    ?>
                    let sug_first = $('.sug_music').find('.media');
                    window.location.href = sug_first.first().find('.media-left a').attr('href');
                    <?php
                }else{
                    ?>
                    let recommendation = $('.music_recommendation');
                    let nextListen = 1;
                    let maxPlaylist = <?php echo count($musicSet['playlist_music']); ?>;
                    let activeBool = 0;
                    recommendation.find('.card-footer').each(function(index, value) {
                        if(activeBool) {
                            nextListen = index + 1;
                            return false;
                        }
                        if($(value).hasClass('listen')) {
                            activeBool = index + 1;
                        }
                    })
                    if(Cookies.get("auto_random") == 'true') {
                        let keyPlaylist = (((window.location.pathname).split('.')[0]).split('/'))[2];
                        let playlistStore = Cookies.get(keyPlaylist);
                        if(playlistStore) {
                            playlistStore = JSON.parse(playlistStore);
                            if(playlistStore.length == maxPlaylist) {
                                if(Cookies.get("auto_repeat") == 'none') {
                                    Cookies.remove(keyPlaylist);
                                    if(!float)
                                        return false;
                                }
                                playlistStore = new Array();
                            }
                        }else{
                            playlistStore = new Array();
                            playlistStore.push(activeBool);

                        }
                        nextListen = generateRandom(1, maxPlaylist, playlistStore);
                        playlistStore.push(nextListen);
                        Cookies.set(keyPlaylist, JSON.stringify(playlistStore))
                    }else{
                        if(Cookies.get("auto_repeat") == 'none') {
                            if(nextListen == 1 && float == false)
                                return false;
                        }
                    }
                    window.location.href = window.location.pathname + '?playlist=' + nextListen;
                    <?php
                }
            ?>
            console.log('next');
        }
        function autoRepeat(T){
            if(T == 'one') {
                jwplayer().setConfig({
                    repeat: true
                });
                logPlayAudioFlag = true;
                Cookies.set("auto_repeat", 'one');
            }
            if(T == 'all' || T == 'none') {
                jwplayer().setConfig({
                    repeat: false
                });
                logPlayAudioFlag = false;
                Cookies.set("auto_repeat", T);
            }
        }
        function autoRandom(F){
            if(F) {
                Cookies.set("auto_random", true);
            }else{
                Cookies.set("auto_random", false);
            }
        }
        jwplayer().on('beforeComplete', function() {
            if(logPlayAudioFlag == false && typeof AutoPlay=='function'){
                AutoPlay();
            }
        });
        function updateQuality(callback) {
            <?php
            if($musicFavourite) {
                ?>
                $('.toggle_wishlist').toggleClass('selector');
                <?php
            }
            ?>
            var curQual = jwplayer('csnplayer').getCurrentQuality();
            if(callback['levels'].length == 2) {
                if(!$('.jw-icon-hd').hasClass('stringQ')) {
                    $('.jw-icon-hd').html(callback['levels'][curQual]['label']);
                }
                $('.jw-icon-hd').addClass('stringQ');
                $('.jw-icon-hd').removeClass('jw-icon-hd');
                $('.stringQ').html(callback['levels'][curQual]['label']);
            }else{
                if(!$('.jw-icon-hd').hasClass('stringQ')) {
                    $('.jw-icon-hd').append('<span>' + callback['levels'][curQual]['label'] + '</span>');
                }
                $('.jw-icon-hd').addClass('stringQ');
                $('.jw-icon-hd').removeClass('jw-icon-hd');
                $('.stringQ').find('span').html(callback['levels'][curQual]['label']);
            }
        }

        //////////////////////////
        ////Add Button//////////
        ////////////////////////
        $('#old_embed').click(function(){
            embedString()
        });
        $('#auto_play').click(function(){
            embedString()
        });
        $('#size_embed').change(function(){
            embedString()
        });

        <?php
            if(isset($file_url[4]['url'])) {
                ?>
                function downLossLessMusic() {
                    data = Cookies.get('share_down_lossless');
                    if(data) {
                        data = JSON.parse(data);
                        now = new Date();
                        expiration = new Date(data.timestamp);
                        expiration.setMinutes(expiration.getMinutes() + 4320); // 72h
                        if (now.getTime() > expiration.getTime()) {
                            document.cookie = 'share_down_lossless=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
                            openShare();
                        }else{
                            window.location = '<?php echo $file_url[4]['url'] ?>';
                        }
                    }else{
                        openShare();
                    }
                }
                function openShare() {
                    $('#myConfirmModal').find('.btn-ok').html('Bắt đầu chia sẻ');
                    confirmModal('Bạn cần phải chia sẻ bài này lên FB thì mới được download! Mỗi lần chia sẻ, sẽ được tải lossless không giới hạn trong 3 ngày', '','modal-mg');
                    $("#myConfirmModal .btn-ok").one('click', function () {
                        FB.ui({
                                method: 'share',
                                name: 'Chia Sẻ Nhạc',
                                href: window.location.href,
                                picture: $('link[rel=image_src]').attr("href"),
                                caption: $('meta[name=title]').attr("content"),
                                description: $('meta[name=description]').attr("content"),
                            },
                            function(response) {
                                if (response && !response.error_message) {
                                    Cookies.set("share_down_lossless", JSON.stringify({
                                        timestamp: new Date(),
                                        content: 'share_down_lossless'
                                    }));
                                    window.location = '<?php echo $file_url[4]['url'] ?>';
                                } else {
                                    alertModal('Bạn phải chia sẻ bài hát này để được download nhạc Lossless.');
                                }
                            }
                        );
                        $('.modal').find('.close_confirm').click();
                    });
                }
                <?php
            }
        ?>

        function embedString() {
            var width_height = 'width="640" height="180"';
            var auto = '?auto=true';
            if(!$('#auto_play').is(':checked')){
                auto = '';
            }
            if($('#size_embed').val()){
                width_height = $('#size_embed').val();
            }
            if($('#old_embed').is(':checked')){
                $('#embed_textarea').text('<object ' + width_height + '><param name="movie" value="<?php echo env('APP_URL') . '/embed/' . $partListenFullUrl; ?>' + auto + '" /><param name="quality" value="high" /><param name="wmode" value="transparent" /><param name="allowfullscreen" value="true"/><param name="allowscriptaccess" value="always"/><embed allowscriptaccess="always" allowfullscreen="true" width="640" height="180" src="https://mp3.zing.vn/embed/song/ZW9DZAO6?start=true" quality="high" wmode="transparent"></embed></object><br />');
            } else {
                $('#embed_textarea').text('<iframe src="<?php echo env('APP_URL').'/embed/'.$partListenFullUrl; ?>' + auto + '"  scrolling="no" ' + width_height + ' frameborder="0" allowfullscreen="true" allow="encrypted-media" allowfullscreen></iframe>');
            }
        }
        $('.messenger-share-link').click(function(e) {
            e.preventDefault();
            FB.ui({
                method: 'send',
                link: $(this).attr('href'),
                caption: 'Chia Sẻ Nhạc',
            });
            return false;
        });


        //// display Sub
        var displaySub = $('.sub_line');
        if(Cookies.get("display_sub") == 'true') {
            displaySub.css('display', 'block');
            $('#display-sub').attr("checked", "checked");
        }else {
            if(Cookies.get("display_sub") == null) {
                Cookies.set("display_sub", true);
                displaySub.css('display', 'block');
            }else{
                $('#display-sub').removeAttr("checked");
            }
        }
        function display_sub() {
            if(Cookies.set("display_sub") == 'true') {
                Cookies.set("display_sub", false);
                displaySub.css('display', 'none');
            }else{
                Cookies.set("display_sub", true);
                displaySub.css('display', 'block');
            }
        }

        //////////////////////////
        //////Comment///////////////
        ////////////////////////////
        var loadComment = true;
        var pageComment = true;
        $('.box_form_comment').submit(false);
        function postComment(formId) {
            var textArea = $('.form-comment-' + formId).find('textarea');
            <?php
                if(!Auth::check()) {
                ?>
                    switchAuth('myModal_login');
                    return false;
                <?php
                }
            ?>
            if(!textArea.val()) {
                alertModal('Chưa nhập nội dung bình luận.');
                return false;
            }
            $.ajax({
                url: window.location.origin + "/comment/post",
                type: "POST",
                dataType: "html",
                data: {'comment': $('.form-comment-' + formId).find('textarea').val(),
                    'music_id' : musicId,
                    'comment_jw_postion' : jwplayer().getPosition(),
                    'reply_cmt_id': $('.form-comment-' + formId).find('.reply_cmt_id').val()},
                beforeSend: function () {
                    if(loaded) return false;
                    loaded = true;
                },
                statusCode: {
                    401: function(){
                        window.location.replace('/login');
                        return false;
                    }
                },
                success: function(response) {
                    $('.form-comment-' + formId).find('textarea').val('');
                    if(formId == 0) {
                        if(pageComment == 1) {
                            $('.ul_comments').prepend(response);
                            clickCommentSeek();
                            $('.ul_comments .reply_comment').first().on('click', function () {
                                var reply = $('.post_comment_reply_' + $(this).data('comment_id'));
                                if (!reply.hasClass('reply_show')) {
                                    $('.post_comment_reply').removeClass('reply_show');
                                    reply.addClass('reply_show');
                                } else {
                                    reply.removeClass('reply_show');
                                }
                                reply.find('textarea').trigger('focus');
                            });
                            $('.box_form_comment').submit(false);
                        }else{
                            loadPageComment(window.location.origin + '/binh-luan/get_ajax?page=1');
                        }
                    }else{
                        $('.comment-reply-' + formId).prepend(response);
                    }
                    $('.music_comment span').html(parseInt($('.music_comment span').html()) + 1);
                    $('.box_form_comment').submit(false);
                }
            });
            return false;
        }

        function loadPageComment(url) {
            $.ajax({
                url: url,
                type: "GET",
                dataType: "html",
                data: {'music_id': musicId},
                beforeSend: function () {
                    if(loaded) return false;
                    loaded = true;
                    // $('.list_comment .list_body').html('<div class="modal-body" style="text-align: center;"><img src="/imgs/comet-spinner.gif" width="100px" /></div>');
                },
                success: function(response) {
                    $('.list_comment .list_body').html(response);
                    $('.box_form_comment').submit(false);
                    $('.reply_comment').on('click', function () {
                        var reply = $('.post_comment_reply_' + $(this).data('comment_id'));
                        if (!reply.hasClass('reply_show')) {
                            $('.post_comment_reply').removeClass('reply_show');
                            reply.addClass('reply_show');
                        } else {
                            reply.removeClass('reply_show');
                        }
                        reply.find('textarea').trigger('focus');
                    });
                    $('.pagination li a').on('click', function (e) {
                        e.preventDefault();
                        loadPageComment($(this).attr('href'));
                        pageComment = $(this).html();
                    });
                    clickCommentSeek();
                }
            });
        }
        function clickCommentSeek() {
            $('.list_comment').find('.seek-jw').click(function() {
                $('html, body').animate({
                    scrollTop: $("#csnplayer").offset().top - 100
                }, 500);
                jwplayer().seek($(this).data('postion'));
            })
        }
        $(window).scroll(function(event){
            var st = $(this).scrollTop();
            if(loadComment) {
                if (st > $('#post_comment').offset().top - 600){
                    loadPageComment(window.location.origin + '/binh-luan/get_ajax?page=<?php echo $_GET['comment_page'] ?? 1 ?>');
                    pageComment = <?php echo $_GET['comment_page'] ?? 1 ?>;
                    loadComment = false;
                }
            }
        });

        //////////////////////////
        ////Add Playlist////////
        ////////////////////////

        function loadPlayList(musicIdSelect, type = 'tab') {
            <?php
                if(!Auth::check()) {
                    ?>
                    switchAuth('myModal_login');
                    return false;
                    <?php
                }
            ?>
            $.ajax({
                url: window.location.origin + "/user/playlist/danh-sach-playlist",
                type: "GET",
                dataType: "json",
                data: { music_id : musicIdSelect},
                beforeSend: function () {
                    $('.box_show_playlist .list-group').html('');
                    if(loaded) return false;
                    loaded = true;
                },
                success: function(data) {
                    if(data.success) {
                        var stringHtml = '';
                        var stringBoxHtml = '';
                        if(data.data) {
                            $.each(data.data, function (index, val) {
                                if(type == 'box') {
                                    stringBoxHtml += stringItemBoxPlaylist(val.playlist_title, val.playlist_music_total, val.playlist_id, val.music_exists, val.playlist_time);
                                }else{
                                    stringHtml += stringItemPlaylist(val.playlist_title, val.playlist_music_total, val.playlist_id, val.music_exists, val.playlist_time);
                                }
                            });
                        }
                        if(type == 'box') {
                            $('.box_show_playlist .list-group').html(stringBoxHtml);
                        }else{
                            $('.playlist-csn ul').html(stringHtml);
                        }
                    }else{
                        alertModal(data.message);
                    }

                }
            });
        }
        function stringItemPlaylist(playlist_title, playlist_music_total, playlist_id, music_exist, playlist_time){
            return '<li onclick="addMusicPlaylist(' + playlist_id + ', false, false, false)" class="d-flex justify-content-between playlist_id_' + playlist_id + ' ' + (music_exist ? 'music-exists' : '') + '"><a class="title_playlist" href="javascript:void(0)" title="' + playlist_title + '">' + playlist_title + ' (<span>' + playlist_music_total + '</span>)</a>' + (music_exist ? '<i class="material-icons"> check </i>' : '') + '<time>' + convertDateTime(playlist_time) + '</time></li>';
        }
        function stringItemBoxPlaylist(playlist_title, playlist_music_total, playlist_id, music_exist, playlist_time){
            return '<div onclick="addBoxMusicPlaylist(' + playlist_id + ')" class="playlist_id_' + playlist_id + ' ' + (music_exist ? 'music-exists' : '') + '"><a href="javascript:void(0)" class="list-group-item list-group-item-action d-flex title_playlist">' + playlist_title + ' (<span>' + playlist_music_total + '</span>)' + (music_exist ? '<i class="material-icons icon-box-playlist"> check </i>' : '') + '</a></div>';
        }
        function btnCreatePlaylist(box_text_create_playlist) {
            var titlePlaylist = $('.' + box_text_create_playlist);
            <?php
                if(!Auth::check()) {
                ?>
                    switchAuth('myModal_login');
                    return false;
                <?php
                }
            ?>
            if(!titlePlaylist.val()) {
                alertModal('Bạn chưa nhập tên playlist mới.');
                return false;
            }
            $.ajax({
                url: window.location.origin + "/user/playlist/create-playlist",
                type: "POST",
                dataType: "json",
                data: {'music_id': musicId, 'playlist_title': titlePlaylist.val()},
                beforeSend: function () {
                    if(loaded) return false;
                    loaded = true;
                },
                success: function(data) {
                    if(data.success) {
                        $('.playlist-csn .list-unstyled').prepend(stringItemPlaylist(data.data.playlist_title, data.data.playlist_music_total, data.data.playlist_id, false, data.data.playlist_time));
                        $('.box_show_playlist_popup .list-group').prepend(stringItemBoxPlaylist(data.data.playlist_title, data.data.playlist_music_total, data.data.playlist_id, false, data.data.playlist_time));
                        titlePlaylist.val("");
                        $('.playlist-csn').animate({scrollTop: 0}, 'slow');
                        $('.box_show_playlist').animate({scrollTop: 0}, 'slow');
                    }else{
                        alertModal(data.message);
                    }
                }
            });
        }
        function addMusicPlaylist(playlistId, musicAddId, artistAdd, artistIdAdd, type = 'tab') {
            const playlistIdSelect = $('.playlist_id_' + playlistId);
            var countPlaylist = playlistIdSelect.find('.title_playlist span');
            var selectPlaylist = $('.' + type + '-playlist').find('.playlist_id_' + playlistId);
            let music_id = (musicAddId == false ? musicId : musicAddId);
            $.ajax({
                url: window.location.origin + "/user/playlist/add-music-playlist",
                type: "POST",
                dataType: "json",
                data: {'playlist_id': playlistId, 'music_id': music_id, 'artist': (artistAdd == false ? artists : artistAdd), 'artist_id': (artistIdAdd == false ? artistIds : artistIdAdd)},
                beforeSend: function () {
                    if(loaded) return false;
                    loaded = true;
                    if(playlistIdSelect.hasClass('music-exists')) {
                        countPlaylist.html(parseInt(countPlaylist.html()) - 1);
                        selectPlaylist.removeClass('music-exists');
                        selectPlaylist.find('.material-icons').remove();
                    }else{
                        countPlaylist.html(parseInt(countPlaylist.html()) + 1);
                        selectPlaylist.addClass('music-exists');
                        selectPlaylist.find('time').before('<i class="material-icons"> check </i>');
                        $('.box-playlist').find('.playlist_id_' + playlistId).find('a').prepend('<i class="material-icons icon-box-playlist"> check </i>');
                    }
                },
                success: function(data) {
                    if(data.success) {
                        playlistIdSelect.find('time').html(convertDateTime(Date.now() / 1000));
                        if(type == 'box' && music_id == musicId){
                            if($('.add_playlist').hasClass('active')) {
                                type = 'all';
                            }
                        }
                        if(data.data) {
                        }else {
                        }
                    }else{
                        alertModal(data.message);
                    }
                }
            });
        }
        var boxMusicId = '';
        var boxArtists = '';
        var boxArtistIds = '';
        function addPlaylistTable(musicName, setId, setArtist, setArtistId) {
            <?php
            if(!Auth::check()) {
                ?>
                    switchAuth('myModal_login');
                    return false;
                <?php
            }
            ?>
            boxMusicId = setId;
            boxArtists = setArtist;
            boxArtistIds = setArtistId;
            $('.box_add_playlist').html('Thêm bài hát <span class="text-pink">' + musicName + '</span> vào danh sách Playlist');
            $('.show_add_playlist').css({'display': 'inherit', 'top': ($('.music_recommendation').offset().top - 200) + 'px'});
            $('body').append('<div id="boxOutPlaylist" style="display: block; z-index: 99999;" role="dialog" class="modal"> </div>')
            window.onclick = function(event) {
                if(event.target == document.getElementById('boxOutPlaylist')) {
                    $('.show_add_playlist').css('display', 'none');
                    $('#boxOutPlaylist').remove();
                }
            }
            loadPlayList(setId, 'box');
        }
        function addBoxMusicPlaylist(playlist_id) {
            addMusicPlaylist(playlist_id, boxMusicId, boxArtists, boxArtistIds, 'box');
        }
        $('.show_add_playlist').find('.close').on('click', function () {
            $('.show_add_playlist').css('display', 'none');
        })
        $(".show_add_playlist").draggable();

        var lyric_expand = '<p>Xem thêm lời bài hát <img src="/imgs/xt3.gif"></p>';
        var lyric_collapse = '<p>Thu gọn <img src="/imgs/xt4.gif"></p>';
        function show_fulllyric()
        {
            if ( $('#morelyric').html() == lyric_expand )
            {
                $('#fulllyric').attr('style', "font-size: 14px; overflow: auto;");
                $('#morelyric').html(lyric_collapse);
            }
            else if ($('#fulllyric').outerHeight() > 300)
            {
                $('#fulllyric').attr('style', "font-size: 14px; max-height: 270px; overflow: hidden;");
                $('#morelyric').html(lyric_expand);
            }
        }
        show_fulllyric();
        //////////////////////////////
        //// count download ////////
        //////////////////////////////////
        $('.download_item').click(function () {
            if(!$('.download_status').hasClass('music_downloaded')) {
                $.ajax({
                    url: window.location.origin + '/count/download',
                    type: "POST",
                    dataType: "json",
                    data: {
                        'music_id' : '<?php echo $music->music_id; ?>',
                        'cat_id' : '<?php echo $music->cat_id; ?>',
                    },
                    beforeSend: function () {
                        if(loaded) return false;
                        loaded = true;
                    },
                    success: function(response) {

                    }
                });
            }
            $('.download_status').addClass('music_downloaded');
        });

        //////////////////////////////
        //// favourite music ////////
        //////////////////////////////////
        function reloadFavourite() {
            <?php
            if(!Auth::check()) {
            ?>
            switchAuth('myModal_login');
            return false;
                <?php
                }
                ?>
            let falgFav = $('.toggle_wishlist').hasClass('selector');
            $.ajax({
                url: window.location.origin + '/music/favourite',
                type: "POST",
                dataType: "json",
                data: {
                    'type': falgFav,
                    'type_of': '<?php echo $musicSet['type_jw'] ?>',
                    'name': '<?php echo str_replace("'", "\'", $music->music_title); ?>',
                    'music_id' : '<?php echo $music->music_id; ?>',
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
            $('.toggle_wishlist').toggleClass('selector');
        }
        //////////////////////////////
        //// block comment, edit lyric, karaoke ////////
        //////////////////////////////////
        <?php
        if(Auth::check()) {
            if(backpack_user()->can('comment_(can_block)')) {
                ?>
                function deleteComment(type, id) {
                    $.ajax({
                        url: window.location.origin + '/comment/block',
                        type: "POST",
                        dataType: "json",
                        data: {
                            'type': type,
                            'id': id,
                        },
                        beforeSend: function () {
                            if(loaded) return false;
                            loaded = true;
                        },
                        success: function(response) {
                            if(response.success) {
                                $('#comment-' + id).find('.media-text').first().html(response.data.comment_text);
                                $('#comment-' + id).find('.comment_delete').first().html(response.data.delete);
                            }else {
                                alertModal(response.message);
                            }
                        }
                    });
                }
                <?php
            }
        }
        ?>
        /////////////////////////////
        /// Suggestion Lyric //////
        /////////////////////////
        function sugLyric() {
            $.ajax({
                url: window.location.origin + '/music/suggestion_lyric',
                type: "GET",
                dataType: "json",
                data: {
                    'cat_id': '<?php echo $music->cat_id ?>',
                    'submit': 'get',
                    'id': '<?php echo $music->music_id ?>',
                },
                beforeSend: function () {
                    if(loaded) return false;
                    loaded = true;
                },
                success: function(response) {
                    if(response.success) {
                        confirmModal('<textarea style="width: 100%" rows="14" placeholder="1. I can feel us falling upon the Mercury\n' +
                            '[t1]Anh cảm thấy chúng ta đang rơi xuống sao Thuỷ\n' +
                            '\n' +
                            'But the temperature rising, a fire is flickering\n' +
                            '\n' +
                            '[t1]Nhưng nhiệt độ lại tăng cao, một ngọn lửa lại bùng lên\n' +
                            '\n' +
                            'Getting hotter and hotter, beyond the wildest dreams\n' +
                            '\n' +
                            '[t1]Chúng ta đang nóng dần lên, vượt xa những giấc mơ điên rồ nhất\n' +
                            '\n' +
                            'I\'m connected to Heaven cause this is everything.\n' +
                            '\n' +
                            '[t1]Anh đã gắn mình với Thiên Đàng vì nó là tất cả.\n' +
                            '\n' +
                            'Can you feel the waking sun?\n' +
                            '\n' +
                            '[t1]Em có cảm nhận được sự chuyển động của mặt trời?\n' +
                            '\n' +
                            'Rising up, the two of us\n' +
                            '\n' +
                            '[t1]Vươn lên cao, chỉ hai ta\n' +
                            '\n' +
                            'We can touch the sun\n' +
                            '\n' +
                            '[t1]Chúng ta có thể chạm tới mặt trời\n' +
                            '\n' +
                            'We\'re closer now with every touch\n' +
                            '\n' +
                            '[t1]Ta gần nhau hơn bằng những cái chạm nhẹ\n' +
                            '\n' +
                            'We burn it up, you light me up" class="modal_lyric">' + response.data.lyric + '</textarea>', 'Gợi ý lyric');
                        $('#myConfirmModal').find('.btn-ok').html('Gửi gợi ý').addClass('btn-lyric');
                        <?php
                        if(Auth::check() && backpack_user()->can('duyet_sua_nhac')) {
                        ?>
                        $('#myConfirmModal').find('.modal-footer').prepend('<button class="btn btn-edit">Sửa Lyric</button>');
                        <?php
                        }
                        ?>
                        $('#myConfirmModal').on('hidden.bs.modal', function () {
                            $('#myConfirmModal').find('.btn-ok').html('Đồng ý').removeClass('btn-lyric');
                            $('#myConfirmModal').find('.btn-edit').remove();
                        })
                        $("#myConfirmModal .btn-lyric").one('click', function () {
                            $.ajax({
                                url: window.location.origin + '/music/suggestion_lyric',
                                type: "POST",
                                dataType: "json",
                                data: {
                                    'cat_id': '<?php echo $music->cat_id ?>',
                                    'submit': 'suggestion',
                                    'id': '<?php echo $music->music_id ?>',
                                    'lyric': $('#myConfirmModal .modal_lyric').val(),
                                },
                                beforeSend: function () {
                                    if(loaded) return false;
                                    loaded = true;
                                },
                                success: function(response) {
                                    if(response.success) {
                                        $('.modal').find('.close_confirm').click();
                                        alertModal(response.message);
                                    }else{
                                        alertModal(response.message);
                                    }
                                }
                            });
                        });
                        <?php
                        if(Auth::check() && backpack_user()->can('duyet_sua_nhac')) {
                        ?>
                        $("#myConfirmModal .btn-edit").one('click', function () {
                            $.ajax({
                                url: window.location.origin + '/music/suggestion_lyric',
                                type: "POST",
                                dataType: "json",
                                data: {
                                    'cat_id': '<?php echo $music->cat_id ?>',
                                    'submit': 'store',
                                    'id': '<?php echo $music->music_id ?>',
                                    'lyric': $('#myConfirmModal .modal_lyric').val(),
                                },
                                beforeSend: function () {
                                    if(loaded) return false;
                                    loaded = true;
                                },
                                success: function(response) {
                                    if(response.success) {
                                        location.reload();
                                    }else {
                                        alertModal(response.message);
                                    }
                                }
                            });
                            $('.modal').find('.close_confirm').click();
                        });
                        <?php
                        }
                        ?>
                    }else {
                        alertModal(response.message);
                    }
                }
            });
        }
        <?php
        if(Auth::check() && backpack_user()->can('duyet_sua_nhac')) {
            ?>
            function mergeMusic() {
                $.ajax({
                    url: window.location.origin + '/music/merge',
                    type: "POST",
                    dataType: "json",
                    data: {
                        'id': '<?php echo $music->music_id ?>',
                    },
                    beforeSend: function () {
                        if(loaded) return false;
                        loaded = true;
                        confirmModal('<img src="/imgs/loader.gif" />', 'Bắt đầu nhập nhạc');
                    },
                    success: function(response) {
                        if(response.success) {
                            $('#myConfirmModal').find('.btn-ok').html('Nhập nhạc').addClass('btn-lyric');
                            var html_radio = '';
                            $.each(response.data, function (index, value) {
                                html_radio = '<label for="merge_music_' + value.music_id + '"><input type="radio" id="merge_music_' + value.music_id + '" name="merge_music" value="' + value.music_id + '"> ' + value.music_title +' - ' + value.music_artist +'<a target="_blank" href="' + value.listen_url +'"> Xem trước</a></label>';
                            });
                            $('.modal_content_csn').html('<div class="merge_content_music">' + html_radio + '</div>');
                            $("#myConfirmModal .btn-ok").click(function () {
                                let val_radio_merge = $("input[name='merge_music']:checked").val();
                                if(val_radio_merge) {
                                    $.ajax({
                                        url: window.location.origin + '/music/approve_merge',
                                        type: "POST",
                                        dataType: "json",
                                        data: {
                                            'id': '<?php echo $music->music_id ?>',
                                            'id_merge': val_radio_merge,
                                        },
                                        beforeSend: function () {
                                            if(loaded) return false;
                                            loaded = true;
                                        },
                                        success: function(response) {
                                            if(response.success) {
                                                alert('Nhập nhạc thành công, tự động chuyển hướng bài hát vừa nhập vào.')
                                                window.location.href = response.data.url;
                                            }else {
                                                $('.modal_content_csn').html(response.message);
                                            }
                                        }
                                    });
                                }
                            });
                        }else {
                            $('.modal_content_csn').html(response.message);
                        }
                    }
                });
            }
            <?php
        }
        ?>
        /////////////////////////////
        /// Suggestion Karaoke //////
        /////////////////////////
        var karaMusic = '';
        function sugKaraoke() {
            if(!karaMusic) {
                $.ajax({
                    url: window.location.origin + '/music/suggestion_karaoke',
                    type: "GET",
                    dataType: "json",
                    data: {
                        'cat_id': '<?php echo $music->cat_id ?>',
                        'submit': 'get',
                        'id': '<?php echo $music->music_id ?>',
                    },
                    beforeSend: function () {
                        if(loaded) return false;
                        loaded = true;
                    },
                    success: function(response) {
                        if(response.success) {
                            karaMusic = response.data.lyric;
                            refreshSugKara(karaMusic);
                        }else {
                            alertModal(response.message);
                        }
                    }
                });
            }else{
                refreshSugKara(karaMusic);
            }
        }
        function refreshSugKara(content) {
            if(jwplayer().getState() == 'playing')
                jwplayer().pause();
            confirmModal('<textarea style="width: 100%" placeholder="[00:00.00]Bài hát: Phía Sau Một Cô Gái    \n' +
                '[00:02.00]Ca sĩ: Soobin Hoàng Sơn\n' +
                '[00:04.00]\n' +
                '[00:24.45]Nhiều khi anh mong được một lần \n' +
                '[00:26.78]Nói ra hết tất cả thay vì\n' +
                '[00:31.46]\n' +
                '[00:34.41]Ngồi lặng im nghe em kể về \n' +
                '[00:36.88]Anh ta bằng đôi mắt lấp lánh\n' +
                '[00:41.94]\n' +
                '[00:45.04]Đôi lúc em tránh ánh mắt của anh\n' +
                '[00:48.82]Vì dường như lúc nào \n' +
                '[00:50.80]Em cũng hiểu thấu lòng anh\n' +
                '[00:54.28]\n' +
                '[00:55.16]Không thể ngắt lời\n' +
                '[00:57.11]\n' +
                '[00:57.42]Càng không thể \n' +
                '[00:58.40]Để giọt lệ nào được rơi" rows="14" class="modal_kara">' + content + '</textarea><div id="kara_sug_csnplayer"></div>', 'Gợi ý karaoke <i style="font-size: 16px;">(bạn có thể chỉnh sửa nội dung bên dưới và ấn xem trước)</i>');
            $('#myConfirmModal').find('.btn-ok').html('Gửi gợi ý').addClass('btn-karaoke');
            $('#myConfirmModal').find('.modal-footer').prepend('<button class="btn btn-test">Xem trước</button>');
            <?php
                if(Auth::check() && backpack_user()->can('duyet_sua_nhac')) {
                    ?>
                        $('#myConfirmModal').find('.modal-footer').prepend('<button class="btn btn-edit">Sửa Karaoke</button>');
                    <?php
                }
            ?>
            $('#myConfirmModal').on('hidden.bs.modal', function () {
                $('.btn-test').remove();
                $('.btn-edit').remove();
                $('#kara_sug_csnplayer').remove();
                $('#myConfirmModal').find('.btn-ok').html('Đồng ý').removeClass('btn-karaoke');
            })
            $('.btn-test').click(function () {
                karaMusic = $('.modal_kara').val();
                $('#kara_sug_lyrics').html($('.modal_kara').val());
                firstLoadLyric = false;
                // waitingDialog.show();
                // waitingDialog.hide();

                var kara_sug_player = jwplayer('kara_sug_csnplayer');
                kara_sug_player.setup({
                    width: '100%',
                    height: '88',
                    repeat: false,
                    aspectratio: "<?php echo $musicSet['type_jw'] == 'video' ? '16:9' : 'false' ?>",
                    stretching: 'fill',
                    sources: [
                        <?php
                        $typeJwSource = $musicSet['type_jw'] == 'video' ? 'mp4' : 'mp3';
                        for ($i=0; $i<sizeof($file_url); $i++){
                            echo '{"file": "'. $file_url[$i]['url'] .'", "label": "'. $file_url[$i]['label'] .'", "type": "'.$typeJwSource.'", "default": '. (($i==1) ? 'true' : 'false') .'},';
                        }
                        ?>
                    ],
                    title: "<?php echo $music->music_title ?>",
                    skin: {
                        name: 'nhac'
                    },
                    timeSliderAbove: true,
                    autostart: true,
                    controlbar: "bottom",
                    plugins: {
                        '<?php echo $musicSet['type_listen'] == 'single' ? '/js/nhac-csn.js' : '/js/nhac-playlist.js' ?>': {
                            duration: 20,
                            msisdn: '',
                            package_id: 0,
                            album_id : '0',
                            content_type: 'song',
                            utm_source: '',
                            utm_medium: '',
                            utm_term: '',
                            utm_content: '',
                            utm_campaign: '',
                            device_id: '',
                            channel: 'WEB',
                            url_referer: '',
                            action_type: 'play_song',
                            player_type: 'NotDRM',
                            service_id: 0,
                            source_rec: 'rand',
                            listen_state: 'online',
                            other_info: '',
                            expired_time: 0,
                            version: '1.0'
                        }
                    },
                });
                kara_sug_player.on('beforePlay', function () {
                    $('#kara_sug_csnplayer').find('.jw-captions').html('<div id="kara_sug_lyrics" class="rabbit-lyrics">' + $('.modal_kara').val() + '</div>');
                    new RabbitLyrics({
                        element: document.getElementById("kara_sug_lyrics"),
                        jw_player: kara_sug_player,
                        viewMode: 'mini',
                        onUpdateTimeJw: false
                    });
                    <?php
                    if($musicSet['type_jw'] != 'video') {
                    ?>
                    $('.jw-display-icon-display').css('display', 'none')
                    <?php
                    }
                    ?>
                });
                kara_sug_player.on('time', function () {
                    new RabbitLyrics({
                        element: document.getElementById("kara_sug_lyrics"),
                        jw_player: kara_sug_player,
                        viewMode: 'mini',
                        onUpdateTimeJw: true
                    });
                })


            });
            $("#myConfirmModal .btn-karaoke").one('click', function () {
                $.ajax({
                    url: window.location.origin + '/music/suggestion_karaoke',
                    type: "POST",
                    dataType: "json",
                    data: {
                        'karaoke': $('.modal_kara').val(),
                        'id': '<?php echo $music->music_id ?>',
                        'submit': 'suggestion',
                        'cat_id': '<?php echo $music->cat_id ?>',
                    },
                    beforeSend: function () {
                        if(loaded) return false;
                        loaded = true;
                    },
                    success: function(response) {
                        karaMusic = '';
                        if(response.success) {
                            $('.modal').find('.close_confirm').click();
                            alertModal(response.message);
                        }else{
                            alertModal(response.message);
                        }
                    }
                });
            });
            <?php
            if(Auth::check() && backpack_user()->can('duyet_sua_nhac')) {
                ?>
                $('.btn-edit').click(function () {
                    $.ajax({
                        url: window.location.origin + '/music/suggestion_karaoke',
                        type: "POST",
                        dataType: "json",
                        data: {
                            'cat_id': '<?php echo $music->cat_id ?>',
                            'submit': 'store',
                            'id': '<?php echo $music->music_id ?>',
                            'karaoke': $('#myConfirmModal .modal_kara').val(),
                        },
                        beforeSend: function () {
                            if(loaded) return false;
                            loaded = true;
                        },
                        success: function(response) {
                            if(response.success) {
                                location.reload();
                            }else {
                                alertModal(response.message);
                            }
                        }
                    });
                });

                <?php
            }
            ?>
        }
        <?php
        if($memberVip) {
            ?>
            var download_all = true;
            function downloadAlbum(url) {
                if(download_all) {
                    download_all = false;
                    $('.download_album').addClass('disabled');
                    $.post("/download-album", {
                        'album_url': url,
                        'type': '<?php echo $musicSet['type_listen'] ?>',
                    });
                    setTimeout(function(){
                        download_all = true
                        $('.download_album').removeClass('disabled');
                    }, 2000);
                }
            }
            <?php
        }
        ?>
        $('#pills-download-tab').click(function() {
            if(!$('#pills-download-tab').hasClass('open_tab')) {
                $('#pills-download-tab').addClass('open_tab');
                $.ajax({
                    url: window.location.origin + '/music/check_music_bitrate',
                    type: "POST",
                    dataType: "json",
                    data: {
                        'music_id': '<?php echo $music->music_id ?>',
                    },
                    beforeSend: function () {
                        if(loaded) return false;
                        loaded = true;
                    },
                    success: function(response) {
                        if(response.success) {
                            $('.tab_download_music').append('<div class="check_music_bitrate">' +
                                '                                  <img class="bitrate_img" src="/images/music_bitrate_fixed/00.jpg">' +
                                '                               <div class="bitrate_div">' +
                                '                                  <span>Được kiểm tra bởi:</span><br/>' +
                                '                                  <span class="span_bitrate">'+response.data.user_bitrate_fixed+'</span>' +
                                '                               </div>' +
                                '                            </div>');
                        }
                    }
                });
            }
        });
    </script>
    @if($musicSet['type_jw'] != 'video')
        <style>
            .jw-icon-rewind{
                display: none!important;
            }
            .jw-icon-fullscreen, .jw-title-primary{
                display: none!important;
            }
            .jw-icon-settings::after {
                width: 100%!important;
            }
        </style>
    @endif
    @if(($musicSet['type_listen'] == 'playlist' || $musicSet['type_listen'] == 'album') && !empty($musicSet['playlist_music']))
        @if(!(isset($_GET['playlist'])) || $_GET['playlist'] == 1)
            <style>
                .jw-icon-backsong{
                    display: none!important;
                }
            </style>
        @endif
    @endif
    <style>
        .jw-flag-time-slider-above:not(.jw-flag-ads-googleima).jwplayer .jw-group>.jw-icon, .jw-flag-time-slider-above:not(.jw-flag-ads-googleima).jwplayer .jw-group>.jw-text {
            height: 40px;
        }
        .jw-controlbar {
            padding-top: 0px!important;
        }
    </style>

    <iframe frameborder="0" allowtransparency="true" height="0" width="0" marginheight="0" marginwidth="0" vspace="0" hspace="0" src="https://hb.gammaplatform.com/adx/usersync"></iframe>
@endsection

