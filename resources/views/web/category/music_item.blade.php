<?php
use App\Library\Helpers;
?>
@if($music->toArray()['data'])
<ul class="list-unstyled list_music">
    <?php
    $musicData = $music->toArray();
    $perPage = $musicData['per_page'];
    $curentPage = $musicData['current_page'];
    array_map(function ($i, $item) use($perPage, $curentPage) {
    $url = Helpers::listen_url($item);
    ?>
    <li class="media align-items-stretch not">
        <div class="media_tmp align-self-center d-flex align-items-center mr-3 pl-3">
            <span class="counter">{{(($curentPage - 1) * $perPage) + ++$i}}</span>
        </div>
        <div class="media-left align-items-stretch mr-2">
            <a href="{{$url}}" title="{{$item['music_title']}}">
                <img src="{{Helpers::cover_url($item['cover_id'])}}" alt="{{$item['music_title']}}">
                <i class="material-icons">play_circle_outline</i>
            </a>
        </div>
        <div class="media-body align-items-stretch d-flex flex-column justify-content-between p-0">
            <div>
                <h5 class="media-title mt-0 mb-0"><a href="{{$url}}" title="{{$item['music_title']}}">{{$item['music_title']}}</a></h5>
                <div class="author"><?php echo Helpers::rawHtmlArtists($item['music_artist_id'], $item['music_artist']) ?></div>
            </div>
            <small class="type_music c1"><?php echo Helpers::bitrate2str($item['music_bitrate']); ?></small>
        </div>
        <div class="media-right align-self-center">
            <small class="time_stt"><i class="material-icons listen-material-icons"> play_arrow </i>{{number_format($item['music_listen'])}}</small>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="{{Helpers::listen_url($item)}}" title="nghe riêng nhạc {{$item['music_title']}}"><i class="material-icons">headset</i></a></li>
                <li class="list-inline-item"><a href="{{Helpers::fbShareLink($url, true)}}" onclick="shareFbLink(event, {{env('APP_URL').$url}})" class="fb-share-link" target="_blank" title="chia sẻ {{$item['music_title']}}"><i class="material-icons">share</i></a></li>
            </ul>
        </div>
    </li>
    <?php
    }, array_keys($musicData['data']), $musicData['data']);
    ?>
</ul>
<center>{{$music->links()}}</center>
@endif