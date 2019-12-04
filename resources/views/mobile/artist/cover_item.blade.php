<?php
use App\Library\Helpers;
?>
@if($cover['data'])
    <?php
    array_map(function ($item) {
    $url = $item['album_link'][0];
    ?>
    <div class="col-6">
        <div class="item element">
            <a href="{{$url}}"><div style="background: url({{$item['album_cover'][0]}}) no-repeat center;background-size: cover;" class="image rounded"></div></a>
            <div class="content mt-3">
                <a href="{{$url}}"><h6 class="name_song mb-1 card-title">{{$item['music_album'][0]}}</h6></a>
            </div>
        </div>
    </div>
    <?php
    }, $cover['data']);
    ?>
    <center><?php Helpers::pagingCustom($cover['page'], $cover['rows'], $cover['row_total'],  '<a href="/tab_artist?page=%d">%d</a>', $cover['page']) ?></center>
@else
    <div class="center-text-mes"><span>Chưa có album nào</span></div>
@endif