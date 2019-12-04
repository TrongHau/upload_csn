<?php
use App\Library\Helpers;
?>
@if($cover->toArray()['data'])
<div class="row row10px float-col-width">
    <?php
    array_map(function ($item) {
    $url = Helpers::album_url($item);
    $album_artist_id = $item['album_artist_id_1'];
    $album_artist = $item['album_artist_1'];
    if($item['album_artist_id_2']) {
        $album_artist_id = $album_artist_id. ';'.$item['album_artist_id_2'];
        $album_artist = $album_artist. ';'.$item['album_artist_2'];
    }
    ?>
    <div class="col">
        <div class="card card1">
            <div class="card-header" style="background-image: url({{Helpers::cover_url($item['cover_id'])}});">
                <a href="{{$url}}" title="{{$item['music_album']}}">
                    <span class="icon-play"></span>
                </a>
            </div>
            <div class="card-body">
                <h3 class="card-title"><a href="{{$url}}" title="{{$item['music_album']}}">{{$item['music_album']}}</a></h3>
                <p class="card-text">
                    <?php echo Helpers::rawHtmlArtists($album_artist_id, $album_artist) ?>
                </p>
            </div>
        </div>
    </div>
    <?php
    }, $cover->toArray()['data']);
    ?>
</div>
<center><?php echo str_replace(url()->current(), '/tab_category',$cover->links()) ?></center>
@endif