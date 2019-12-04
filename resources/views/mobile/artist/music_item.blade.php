<?php
use App\Library\Helpers;
?>
@if($music['data'])
    <?php
    array_map(function($item) {
    $url = $item['music_link'][0];
    ?>
    <div class="element mb-2">
        <a href="{{$url}}"><div class="image100 mr-2 d-inline-block align-middle" style="background : url('{{$item['music_cover'][0]}}') no-repeat center;background-size: cover;"></div>
        </a>
        <div class="content d-inline-block align-middle">
            <a href="{{$url}}"><h6 class="name_song text-black mb-1 card-title">{{$item['music_title'][0]}}</h6></a>
            <p class="name_singer text-gray mb-1 author"><?php echo $item['music_artist_html'][0] ?></p>
            <p class="loss text-pink mb-0"><?php echo $item['music_bitrate_html'][0] ?></p>
        </div>
    </div>
    <?php
    }, $music['data']);
    ?>
    <center><?php Helpers::pagingCustom($music['page'], $music['rows'], $music['row_total'],  '<a href="/tab_artist?page=%d">%d</a>', $music['page']) ?></center>
@else
    <div class="center-text-mes"><span>Chưa có bài nhạc nào</span></div>
@endif
