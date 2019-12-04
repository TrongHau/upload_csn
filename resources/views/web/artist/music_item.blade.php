<?php
use App\Library\Helpers;
?>
@if($music['data'])
<ul class="list-unstyled list_music">
    <?php
    $perPage = $music['rows'];
    $curentPage = $music['page'];
    array_map(function ($i, $item) use($perPage, $curentPage) {
    $url = $item['music_link'][0];
    ?>
    <li class="media align-items-stretch not">
        <div class="media_tmp align-self-center d-flex align-items-center mr-3 pl-3">
            <span class="counter">{{(($curentPage - 1) * $perPage) + ++$i}}</span>
        </div>
        <div class="media-left align-items-stretch mr-2">
            <a href="{{$url}}" title="{{$item['music_title'][0]}}">
                <img src="{{$item['music_cover'][0]}}" alt="{{$item['music_title'][0]}}">
                <i class="material-icons">play_circle_outline</i>
            </a>
        </div>
        <div class="media-body align-items-stretch d-flex flex-column justify-content-between p-0">
            <div>
                <h5 class="media-title mt-0 mb-0"><a href="{{$url}}" title="{{$item['music_title'][0]}}">{{$item['music_title'][0]}}</a></h5>
                <div class="author"><?php echo $item['music_artist_html'][0] ?></div>
            </div>
            <small class="type_music c1"><?php echo $item['music_bitrate_html'][0] ?></small>
        </div>
        <div class="media-right align-self-center">
            <small class="time_stt"><i class="material-icons listen-material-icons"> play_arrow </i>{{number_format($item['music_listen'][0])}}</small>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="{{$url}}" title="nghe riêng nhạc {{$item['music_title'][0]}}"><i class="material-icons">headset</i></a></li>
                <li class="list-inline-item"><a class="fb-share-link" href="{{Helpers::fbShareLink($url, true)}}" target="_blank" title="chia sẻ {{$item['music_title'][0]}}"><i class="material-icons">share</i></a></li>
            </ul>
        </div>
    </li>
    <?php
    }, array_keys($music['data']), $music['data']);
    ?>
</ul>
<center><?php Helpers::pagingCustom($music['page'], $music['rows'], $music['row_total'],  '<a href="/tab_artist?page=%d">%d</a>', $music['page']) ?></center>
@else
    <div class="center-text-mes"><span>Chưa có bài hát nào</span></div>
@endif