<?php
use App\Library\Helpers;
?>
@if($cover['data'])
<div class="row row10px float-col-width">
    <?php
    array_map(function ($item) {
    ?>
    <div class="col">
        <div class="card card1">
            <div class="card-header" style="background-image: url({{$item['album_cover'][0]}});">
                <a href="{{$item['album_link'][0]}}" title="{{$item['music_album'][0]}}">
                    <span class="icon-play"></span>
                </a>
            </div>
            <div class="card-body">
                <h3 class="card-title"><a href="{{$item['album_link'][0]}}" title="{{$item['music_album'][0]}}">{{$item['music_album'][0]}}</a></h3>
                <p class="card-text">
                    <?php echo $item['album_music_artist_html'][0] ?>
                </p>
            </div>
        </div>
    </div>
    <?php
    }, $cover['data']);
    ?>
</div>
<center><?php Helpers::pagingCustom($cover['page'], $cover['rows'], $cover['row_total'] ?? 0, '<a href="/tab_category?page=%d">%d</a>') ?></center>
@endif