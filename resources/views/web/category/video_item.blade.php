<?php
use App\Library\Helpers;
?>
@if($video->toArray()['data'])
<div class="row row10px float-col-width-video">
    <?php
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
                <p class="card-text"><?php echo Helpers::rawHtmlArtists($item['music_artist_id'], $item['music_artist']) ?></p>
            </div>
        </div>
    </div>
    <?php
    }, $video->toArray()['data'])
    ?>
</div>
<center><?php echo str_replace(url()->current(), '/tab_category',$video->links()) ?></center>
@endif