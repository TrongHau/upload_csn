<?php
use App\Library\Helpers;
?>
@if(isset($music['stage_uncensor']))
    <?php echo $stage == 'all' ? '<div class="block block_baihat stage_uncensor">' : '' ?>
    <div class="block_header d-flex flex-row justify-content-between mb-2">
        <h3 class="main_title text-pink mb-0">Chờ Xủ Lý</h3>
    </div>
    <?php $stageUncensor = $music['stage_uncensor']->toArray()['data']; ?>
    @if($stageUncensor)
        <div class="block_bxhbaihat block_more">
            <?php
            $perPage = $music['stage_uncensor']->toArray()['per_page'];
            $curentPage = $music['stage_uncensor']->toArray()['current_page'];
            array_map(function($i, $item) use($perPage, $curentPage) {
            $url = '/dang-tai/'.($item['cat_id'] == CAT_VIDEO ? 'video' : 'nhac').'/'.$item['music_id'];
            ?>
            <div class="element py-3 border-bottom">
                <div class="number_wrap text-center text-orange_ d-inline-block align-middle mx-3">
                    <p class="number m-0">{{sprintf("%02d", (($curentPage - 1) * $perPage) + ++$i)}}</p>
                </div>
                <a href="{{$url}}"><div style="background : url({{Helpers::cover_url($item['cover_id'])}}) no-repeat center;background-size: cover;" class="image100 mr-2 d-inline-block align-middle"></div></a>
                <div class="content d-inline-block align-middle">
                    <a href="{{$url}}"><h6 class="name_song text-black mb-1 card-title">{{$item['music_title']}}</h6></a>
                    <p class="name_singer text-gray mb-1 author"><?php echo Helpers::rawHtmlArtists($item['music_artist_id'], $item['music_artist']) ?></p>
                    <p class="loss text-pink mb-0"><?php echo Helpers::bitrate2str($item['music_bitrate']); ?></p>
                    <time class="time_request"><?php echo Helpers::timeElapsedString($item['music_last_update_time']); ?></time>
                </div>
            </div>
            <?php
            }, array_keys($stageUncensor), $stageUncensor);
            ?>

        </div>
        <center data-page="uncensor">{{$music['stage_uncensor']->links()}}</center>
    @endif
    <?php echo $stage == 'all' ? '</div>' : ''?>
@endif
@if(isset($music['stage_fullcensor']))
    <?php echo $stage == 'all' ? '<div class="block block_baihat stage_fullcensor">' : '' ?>
    <div class="block_header d-flex flex-row justify-content-between mb-2">
        <h3 class="main_title text-pink mb-0">Đã duyệt</h3>
    </div>
    <?php $stageFullcensor = $music['stage_fullcensor']->toArray()['data']; ?>
    @if($stageFullcensor)
        <div class="block_bxhbaihat block_more">
            <?php
            $perPage = $music['stage_fullcensor']->toArray()['per_page'];
            $curentPage = $music['stage_fullcensor']->toArray()['current_page'];
            array_map(function($i, $item) use($perPage, $curentPage) {
            $url = '/user/redirect/'.$item['music_id'];
            ?>
                <div class="element py-3 border-bottom">
                    <div class="number_wrap text-center text-orange_ d-inline-block align-middle mx-3">
                        <p class="number m-0">{{sprintf("%02d", (($curentPage - 1) * $perPage) + ++$i)}}</p>
                    </div>
                    <a href="{{$url}}"><div style="background : url({{Helpers::cover_url($item['cover_id'])}}) no-repeat center;background-size: cover;" class="image100 mr-2 d-inline-block align-middle"></div></a>
                    <div class="content d-inline-block align-middle">
                        <a href="{{$url}}"><h6 class="name_song text-black mb-1 card-title">{{$item['music_title']}}</h6></a>
                        <p class="name_singer text-gray mb-1 author"><?php echo Helpers::rawHtmlArtists($item['music_artist_id'], $item['music_artist']) ?></p>
                        <p class="loss text-pink mb-0"><?php echo Helpers::bitrate2str($item['music_bitrate']); ?></p>
                        <time class="time_request"><?php echo Helpers::timeElapsedString($item['music_last_update_time']); ?></time>
                    </div>
                </div>
            <?php
            }, array_keys($stageFullcensor), $stageFullcensor);
            ?>
        </div>
        <center data-page="fullcensor">{{$music['stage_fullcensor']->links()}}</center>
    @endif
    <?php echo $stage == 'all' ? '</div>' : '' ?>
@endif
@if(isset($music['stage_delete']))
    <?php echo $stage == 'all' ? '<div class="block block_baihat stage_fullcensor">' : '' ?>
    <div class="block_header d-flex flex-row justify-content-between mb-2">
        <h3 class="main_title text-pink mb-0">Đã Xoá</h3>
    </div>
    <?php $stageFullcensor = $music['stage_delete']->toArray()['data']; ?>
    @if($stageFullcensor)
        <div class="block_bxhbaihat block_more">
            <?php
            $perPage = $music['stage_delete']->toArray()['per_page'];
            $curentPage = $music['stage_delete']->toArray()['current_page'];
            array_map(function($i, $item) use($perPage, $curentPage) {
            $url = '#';
            ?>
                <div class="element py-3 border-bottom">
                    <div class="number_wrap text-center text-orange_ d-inline-block align-middle mx-3">
                        <p class="number m-0">{{sprintf("%02d", (($curentPage - 1) * $perPage) + ++$i)}}</p>
                    </div>
                    <a href="{{$url}}"><div style="background : url({{Helpers::cover_url($item['cover_id'])}}) no-repeat center;background-size: cover;" class="image100 mr-2 d-inline-block align-middle"></div></a>
                    <div class="content d-inline-block align-middle">
                        <a href="{{$url}}"><h6 class="name_song text-black mb-1 card-title">{{$item['music_title']}}</h6></a>
                        <p class="name_singer text-gray mb-1 author"><?php echo Helpers::rawHtmlArtists($item['music_artist_id'], $item['music_artist']) ?></p>
                        <p class="loss text-pink mb-0"><?php echo Helpers::bitrate2str($item['music_bitrate']); ?></p>
                        <time class="time_request"><?php echo Helpers::timeElapsedString($item['music_last_update_time']); ?></time>
                    </div>
                </div>
            <?php
            }, array_keys($stageFullcensor), $stageFullcensor);
            ?>
        </div>
        <center data-page="fullcensor">{{$music['stage_delete']->links()}}</center>
    @endif
    <?php echo $stage == 'all' ? '</div>' : '' ?>
@endif
@if(isset($music['album']))
    <?php echo $stage == 'all' ? '<div class="block block_album stage_album">' : '' ?>
    <div class="block_header d-flex flex-row justify-content-between mb-2">
        <h3 class="main_title text-pink mb-0">Album</h3>
    </div>
    @if($music['album']->toArray()['data'])
        <div class="block_more">
            <div class="container">
                <div class="row row-sm">
                    <?php
                    array_map(function ($i, $item) {
                    $url = Helpers::album_url($item);
                    ?>
                    <div class="col-6">
                        <div class="item element">
                            <a href="{{$url}}"><div style="background: url({{Helpers::cover_url($item['cover_id'])}}) no-repeat center;background-size: cover;" class="image rounded"></div></a>
                            <div class="content mt-3">
                                <a href="{{$url}}"><h6 class="name_song mb-1 card-title">{{$item['music_album']}}</h6></a>
                            </div>
                        </div>
                    </div>
                    <?php
                    }, array_keys($music['album']->toArray()['data']),$music['album']->toArray()['data'])
                    ?>
                </div>
            </div>
        </div>
        <center data-page="album">{{$music['album']->links()}}</center>
    @endif
    <?php echo $stage == 'all' ? '</div>' : '' ?>
@endif