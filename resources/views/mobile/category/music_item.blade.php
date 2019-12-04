<?php
use App\Library\Helpers;
?>
<?php
$musicData = $music->toArray();
array_map(function($item) {
$url = Helpers::listen_url($item);
?>
<div class="element mb-2">
    <a href="{{$url}}"><div class="image100 mr-2 d-inline-block align-middle" style="background : url('{{Helpers::cover_url($item['cover_id'])}}') no-repeat center;background-size: cover;"></div></a>
    <div class="content d-inline-block align-middle">
        <a href="{{$url}}"><h6 class="name_song text-black mb-1 card-title">{{$item['music_title']}}</h6></a>
        <p class="name_singer text-gray mb-1 author"><?php echo Helpers::rawHtmlArtists($item['music_artist_id'], $item['music_artist']) ?></p>
        <p class="loss text-pink mb-0"><?php echo Helpers::bitrate2str($item['music_bitrate']); ?></p>
    </div>
</div>
<?php
}, $musicData['data']);
?>
<center>{{$music->links()}}</center>
