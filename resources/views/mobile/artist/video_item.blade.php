<?php
use App\Library\Helpers;
?>
@if($video['data'])
    <?php
    array_map(function($item) {
    $url = $item['video_link'][0];
    ?>
    <div class="element py-3 border-bottom">
        <a href="{{$url}}">
            <div class="image mr-2 d-inline-block align-middle" style="background : url({{$item['video_cover'][0]}}) no-repeat center;background-size: cover;">
                <p class="time"><img src="/mobile/assets/images/icon/ic_menu_clock.png" width="14"> {{$item['video_length_html'][0]}}</p>
            </div>
        </a>
        <div class="content d-inline-block align-middle">
            <a href="{{$url}}"><h6 class="name_song text-black mb-1 card-title">{{$item['video_title'][0]}}</h6></a>
            <p class="name_singer text-gray mb-1 author"><?php echo $item['video_bitrate_html'][0] ?></p>
        </div>
    </div>
    <?php
    }, $video['data']);
    ?>
    <center><?php Helpers::pagingCustom($video['page'], $video['rows'], $video['row_total'],  '<a href="/tab_artist?page=%d">%d</a>', $video['page']) ?></center>
@else
    <div class="center-text-mes"><span>Chưa có video nào</span></div>
@endif
