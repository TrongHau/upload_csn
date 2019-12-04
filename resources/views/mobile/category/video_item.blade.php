<?php
use App\Library\Helpers;
?>
<?php
$videoData = $video->toArray();
array_map(function($item) {
$url = Helpers::listen_url($item);
?>
<div class="element py-3 border-bottom">
    <a href="{{$url}}">
        <div class="image mr-2 d-inline-block align-middle" style="background : url({{Helpers::thumbnail_url($item)}}) no-repeat center;background-size: cover;">
            <p class="time"><img src="/mobile/assets/images/icon/ic_menu_clock.png" width="14"> {{$item['music_length'] >= 3600 ? gmdate("H:i:s", $item['music_length']) : gmdate("i:s", $item['music_length'])}}</p>
        </div>
    </a>
    <div class="content d-inline-block align-middle">
        <a href="{{$url}}"><h6 class="name_song text-black mb-1 card-title">{{$item['music_title']}}</h6></a>
        <p class="name_singer text-gray mb-1 author"><?php echo Helpers::bitrate2str($item['music_bitrate']); ?></p>
    </div>
</div>
<?php
}, $videoData['data']);
?>
<center>{{$video->links()}}</center>
