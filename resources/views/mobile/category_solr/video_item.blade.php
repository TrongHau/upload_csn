<?php
use App\Library\Helpers;
?>
<?php
array_map(function($item) {
?>
<div class="element py-3 border-bottom">
    <a href="{{$item['video_link'][0]}}">
        <div class="image mr-2 d-inline-block align-middle" style="background : url({{$item['video_cover'][0]}}) no-repeat center;background-size: cover;">
            <p class="time"><img src="/mobile/assets/images/icon/ic_menu_clock.png" width="14"> {{$item['video_length_html'][0]}}</p>
        </div>
    </a>
    <div class="content d-inline-block align-middle">
        <a href="{{$item['video_link'][0]}}"><h6 class="name_song text-black mb-1 card-title">{{$item['video_title'][0]}}</h6></a>
        <p class="name_singer text-gray mb-1 author"><?php echo $item['video_bitrate_html'][0]; ?></p>
    </div>
</div>
<?php
}, $video['data']);
?>
<center><?php Helpers::pagingCustom($video['page'], $video['rows'], $video['row_total'] ?? 0, '<a href="/tab_category?page=%d">%d</a>') ?></center>