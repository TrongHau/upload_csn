<?php
use App\Library\Helpers;
?>
@if($playlist->toArray()['data'])
    <?php
    array_map(function ($item) {
    $url = Helpers::playlist_url($item);
    ?>
    <div class="col-6">
        <div class="item element">
            <a href="{{$url}}"><div style="background: url({{Helpers::cover_url($item['cover_id'])}}) no-repeat center;background-size: cover;" class="image rounded"></div></a>
            <div class="content mt-3">
                <a href="{{$url}}"><h6 class="name_song mb-1 card-title">{{$item['music_album']}}</h6></a>
            </div>
        </div>
    </div>
    <?php
    }, $playlist->toArray()['data']);
    ?>
    <center><?php echo $playlist->links() ?></center>
@else
    <div class="center-text-mes"><span>Chưa có playlist nào</span></div>
@endif