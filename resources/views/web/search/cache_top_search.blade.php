<?php
use App\Library\Helpers;
?>
<div class="card-body"><h4 class="card-title">Bài Hát Tìm Kiếm Nhiều Nhất</h4>
    <ul class="list-unstyled list_music">
        @foreach($musicArr as $key => $item)
            <a class="search-line parent-line search-line-music" href="{{Helpers::listen_url($item)}}">
                <li class="media align-items-stretch">
                    <div class="media-body align-items-stretch d-flex flex-column justify-content-between p-0">
                        <div><h5 class="media-title mt-0 mb-0 span_h5" title="{{$item['music_title']}}">{{$item['music_title']}}</h5>
                            <div class="author"><?php echo str_replace(';', '; ', $item['music_artist']) ?></div>
                        </div>
                        <small class="type_music c1"><?php echo Helpers::bitrate2str($item['music_bitrate']); ?></small>
                    </div>
                </li>
            </a>
        @endforeach
    </ul>
</div>



