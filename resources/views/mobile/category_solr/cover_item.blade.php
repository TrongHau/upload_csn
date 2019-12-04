<?php
use App\Library\Helpers;
?>
@if($cover['data'])
    <?php
    array_map(function ($item) {
    ?>
    <div class="col-6">
        <div class="item element">
            <a href="{{$item['album_link'][0]}}"><div style="background: url({{$item['album_cover'][0]}}) no-repeat center;background-size: cover;" class="image rounded"></div></a>
            <div class="content mt-3">
                <a href="{{$item['album_link'][0]}}"><h6 class="name_song mb-1 card-title">{{$item['music_album'][0]}}</h6></a>
                <p class="name_singer text-gray mb-1 author"><?php echo $item['album_music_artist_html'][0] ?></p>
            </div>
        </div>
    </div>
    <?php
    }, $cover['data']);
    ?>
<center><?php Helpers::pagingCustom($cover['page'], $cover['rows'], $cover['row_total'] ?? 0, '<a href="/tab_category?page=%d">%d</a>') ?></center>
@endif