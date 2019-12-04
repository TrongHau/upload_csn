
    <?php
    use App\Library\Helpers;
    $data = $videoFavourite->toArray()['data'];
    $idAuth = Auth::check() ? Auth::user()->id : 0;
    $mySelf = (Auth::check() && Auth::user()->id == $user_id);
    ?>
    @if($data)
        @if($mySelf)
            <div class="d-flex align-items-center justify-content-between" id="header_playlist">
                <span class="title"></span>
                <span><a class="btn btn-danger" href="/nghe-bat-hat-yeu-thich/video" title="Tạo playlist"><i class="fa fa-play-circle" aria-hidden="true"></i> Nghe tất cả</a></span>
            </div>
        @endif
    <div class="row row10px float-col-width-video">
    <?php
    array_map(function ($item) use($idAuth) {
    $userFav = $item['user_id'];
    $item = $item['video'];
    $url = Helpers::listen_url($item);
    ?>
    <div class="col">
        <div class="card card1 video">
            <div class="card-header" style="background-image: url({{Helpers::thumbnail_url($item)}});">
                <a href="javascript:void(0)" onclick="return favourite('{{str_replace("'", "\'", $item['music_title'])}}', 'video', '{{$item['music_id']}}')" class="btn-video-favourite wishlist wishlist-{{$item['music_id']}} toggle_wishlist {{$userFav == $idAuth ? 'selector' : ''}} px-1"><i aria-hidden="true" class="fa fa-heart-o"></i></a>
                <a href="{{$url}}" title="{{$item['music_title']}}">
                    <span class="icon-play"></span>
                </a>
            </div>
            <div class="card-body">
                <h3 class="card-title"><a href="{{$url}}" title="{{$item['music_title']}}">{{$item['music_title']}}</a></h3>
                <p class="card-text" style="padding: 0px;"><?php echo Helpers::rawHtmlArtists($item['music_artist_id'], $item['music_artist']) ?></p>
            </div>
        </div>
    </div>
    <?php
    }, $data)
    ?>
    <center>{{$videoFavourite->links()}}</center>
    @else
    <div class="row row10px float-col-width-video">
        <div class="center-text-mes"><span>Chưa có video nào</span></div>
    @endif
</div>