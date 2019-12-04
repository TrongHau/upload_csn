<?php
use App\Library\Helpers;
?>
@if($cover['data'])
<div class="row row10px float-col-width">
    <?php
    array_map(function ($item) {
    $url = $item['album_link'][0];
    ?>
    <div class="col">
        <div class="card card1">
            <div class="card-header" style="background-image: url({{$item['album_cover'][0]}});">
                <a href="{{$url}}" title="{{$item['music_album'][0]}}">
                    <span class="icon-play"></span>
                </a>
            </div>
            <div class="card-body">
                <h3 class="card-title"><a href="{{$url}}" title="{{$item['music_album'][0]}}">{{$item['music_album'][0]}}</a></h3>
            </div>
        </div>
    </div>
    <?php
    }, $cover['data']);
    ?>
</div>
<center><?php Helpers::pagingCustom($cover['page'], $cover['rows'], $cover['row_total'],  '<a href="/tab_artist?page=%d">%d</a>', $cover['page']) ?></center>
@else
    <div class="center-text-mes"><span>Chưa có album nào</span></div>
@endif