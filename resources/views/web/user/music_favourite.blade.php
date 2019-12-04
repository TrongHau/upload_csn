<?php
use App\Library\Helpers;
$perPage = $musicFavourite->toArray()['per_page'];
$curentPage = $musicFavourite->toArray()['current_page'];
$data = $musicFavourite->toArray()['data'];
$idAuth = Auth::check() ? Auth::user()->id : 0;
$mySelf = (Auth::check() && Auth::user()->id == $user_id);
?>
@if($data)
    @if($mySelf)
    <div class="d-flex align-items-center justify-content-between" id="header_playlist">
        <span class="title"></span>
        <span><a class="btn btn-danger" href="/nghe-bat-hat-yeu-thich/music" title="Tạo playlist"><i class="fa fa-play-circle" aria-hidden="true"></i> Nghe tất cả</a></span>
    </div>
    @endif
    <div class="row row10px">
        <div class="col">
            <ul class="list-unstyled list_music">
                <?php
                array_map(function($i, $item_f) use($perPage, $curentPage, $idAuth) {
                if($i < 5) {
                $userFav = $item_f['user_id'];
                $item = $item_f['music'];
                $url = Helpers::listen_url($item);
                ?>
                <li class="media align-items-stretch items-stretch-{{$item_f['music_id']}}">
                    <div class="media_tmp align-self-center d-flex align-items-center mr-3 pl-3">
                        <span class="counter">{{sprintf("%02d", (($curentPage - 1) * $perPage) + ++$i)}}</span>
                    </div>
                    <div class="media-left align-items-stretch mr-2">
                        <a href="{{$url}}" title="{{$item['music_title']}}">
                            <img src="{{Helpers::cover_url($item['cover_id'])}}" alt="{{$item['music_title']}}">
                            <i class="material-icons">play_circle_outline</i>
                        </a>
                    </div>
                    <div class="media-body align-items-stretch d-flex flex-column justify-content-between p-0">
                        <div>
                            <h5 class="media-title mt-0 mb-0 title_home_tablet"><a href="{{$url}}" title="{{$item['music_shortlyric'] ?? $item['music_title']}}">{{$item['music_title']}}</a></h5>
                            <div class="author title_home_tablet"><?php echo Helpers::rawHtmlArtists($item['music_artist_id'], $item['music_artist']) ?></div>
                        </div>
                        <small class="type_music"><?php echo Helpers::bitrate2str($item['music_bitrate']); ?></small>
                    </div>
                    <div class="media-right align-self-center">
                        <ul class="list-inline" style="margin-right:0px">
                            <li class="list-inline-item">
                                <a href="javascript:void(0)" onclick="return favourite('{{str_replace("'", "\'", $item['music_title'])}}', 'music', '{{$item_f['music_id']}}')" class="wishlist wishlist-{{$item_f['music_id']}} toggle_wishlist {{$userFav == $idAuth ? 'selector' : ''}} px-3"><i aria-hidden="true" class="fa fa-heart-o"></i></a>
                            </li>
                        </ul>
                    </div>
                </li>
                <?php
                }
                }, array_keys($data), $data);
                ?>
            </ul>
        </div>
        <div class="col">
            <ul class="list-unstyled list_music">
                <?php
                array_map(function($i, $item_f) use($perPage, $curentPage, $idAuth) {
                if($i >= 5) {
                $userFav = $item_f['user_id'];
                $item = $item_f['music'];
                $url = Helpers::listen_url($item);
                ?>
                <li class="media align-items-stretch items-stretch-{{$item_f['music_id']}}">
                    <div class="media_tmp align-self-center d-flex align-items-center mr-3 pl-3">
                        <span class="counter">{{sprintf("%02d", (($curentPage - 1) * $perPage) + ++$i)}}</span>
                    </div>
                    <div class="media-left align-items-stretch mr-2">
                        <a href="{{$url}}" title="{{$item['music_title']}}">
                            <img src="{{Helpers::cover_url($item['cover_id'])}}" alt="{{$item['music_title']}}">
                            <i class="material-icons">play_circle_outline</i>
                        </a>
                    </div>
                    <div class="media-body align-items-stretch d-flex flex-column justify-content-between p-0">
                        <div>
                            <h5 class="media-title mt-0 mb-0 title_home_tablet"><a href="{{$url}}" title="{{$item['music_shortlyric'] ?? $item['music_title']}}">{{$item['music_title']}}</a></h5>
                            <div class="author title_home_tablet"><?php echo Helpers::rawHtmlArtists($item['music_artist_id'], $item['music_artist']) ?></div>
                        </div>
                        <small class="type_music"><?php echo Helpers::bitrate2str($item['music_bitrate']); ?></small>
                    </div>
                    <div class="media-right align-self-center">
                        <ul class="list-inline" style="margin-right:0px">
                            <li class="list-inline-item">
                                <a href="javascript:void(0)" onclick="return favourite('{{str_replace("'", "\'", $item['music_title'])}}', 'music', '{{$item_f['music_id']}}')" class="wishlist wishlist-{{$item_f['music_id']}} toggle_wishlist {{$userFav == $idAuth ? 'selector' : ''}} px-3"><i aria-hidden="true" class="fa fa-heart-o"></i></a>
                            </li>
                        </ul>
                    </div>
                </li>
                <?php
                }
                }, array_keys($data), $data);
                ?>
            </ul>
        </div>
    </div>
    <center>{{$musicFavourite->links()}}</center>
@else
    <div class="center-text-mes"><span>Chưa có bài nhạc nào</span></div>
@endif