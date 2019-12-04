<?php
use App\Library\Helpers;
$playlistData = $playlist->toArray();
?>
@if($playlistData['data'])
    <div class="row row10px float-col-width">
        <?php
        array_map(function ($item) {
        $url = Helpers::playlist_url($item);
        ?>
        <div class="col">
            <div class="card card1">
                <div class="card-header" style="background-image: url({{$item['playlist_cover'] ? Helpers::file_path($item['playlist_id'], env('DATA_URL').MUSIC_PLAYLIST_PUBLISHER_PATH, true).$item['playlist_id'] . '.png?v=' . time() : '/imgs/avatar_default.png'}});">
                    <a href="{{$url}}" title="{{$item['playlist_title']}}">
                        <span class="icon-play"></span>
                    </a>
                </div>
                <div class="card-body">
                    <h3 class="card-title"><a href="{{$url}}" title="{{$item['playlist_title']}}">{{$item['playlist_title']}}</a></h3>
                </div>
            </div>
        </div>
        <?php
        }, $playlistData['data']);
        ?>
    </div>
    <center><?php echo $playlist->links() ?></center>
@else
    <div class="center-text-mes"><span>Chưa có playlist nào</span></div>
@endif