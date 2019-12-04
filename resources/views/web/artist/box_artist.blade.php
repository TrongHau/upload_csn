<?php
use App\Library\Helpers;
?>
<div class="box_profile" style="padding: 0px!important;">
    <div class="container" style="position: relative;">
        <div style="position: relative;width: 100%">
            <img src="{{$artist->artist_cover ? Helpers::file_path($artist->artist_id, $previewArtist ? PUBLIC_CACHE_COVER_ARTIST_PATH : PUBLIC_COVER_ARTIST_PATH, true).$artist->artist_cover : '/imgs/no_cover_artist.jpg'}}" style="width: 100%; height: 300px;" />
            <div class="media user11">
            <div class="media-left mr-4 align-self-center">
            {{--<img id="view_user_avatar_2" src="{{$artist->artist_cover ? PUBLIC_AVATAR_ARTIST_SOURCE_PATH.$artist->artist_cover.'?v='.time() : ''}}">--}}
            </div>
            <div class="media-body align-self-center">
            </div>
            </div>
            <div class="thumb-mask media align-items-stretch d-flex align-content-center justify-content-center">
                <div class="box_profile_singer">
                    <div class="box_profile__body text-center">
                        {{--<div class="count_listen mb-2"><small>12,123,111 Lượt nghe hàng tháng</small></div>--}}
                        <h4 class="media-right align-self-center artist_name_box mb-4">{{$artist->artist_nickname}}</h4>
                        <ul class="list-inline navbar justify-content-center p-0 mb-4 menu_option">
                            <li class="list-inline-item"><a href="/nghe-bat-hat-ca-si/{{$artistUrl}}" class="btn btn-secondary btn-gradien btn-radius"><span>Play</span></a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)" class="wishlist toggle_wishlist {{$artistFavourite ? 'selector' : ''}} px-3"><i aria-hidden="true" class="fa fa-heart-o" ></i></a></li>
                            @if ($artist->artist_cover)
                                <li class="list-inline-item">
                                    <div class="dropdown"><a id="dropdownMenuSinger" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i aria-hidden="true" class="fa fa-ellipsis-h"></i></a>
                                        <div aria-labelledby="dropdownMenuSinger" class="dropdown-menu">
                                            <a href="/dang-tai/ca-si/{{$artistUrl}}" class="dropdown-item">Gợi ý chỉnh sửa</a>
                                            {{--<a href="#" class="dropdown-item">Bắt đầu Radio</a>--}}
                                            {{--<a href="#" class="dropdown-item">Lưu vào thư viện</a>--}}
                                            {{--<a href="#" class="dropdown-item">Sao chép Liên kết Nghệ sĩ</a></div>--}}
                                    </div>
                                </li>
                            @else
                                <li class="list-inline-item"><a href="/dang-tai/ca-si/{{$artistUrl}}" class="btn btn-secondary btn-gradien btn-radius"><span>Chỉnh sửa</span></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
