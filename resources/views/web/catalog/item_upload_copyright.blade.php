<ul class="list-unstyled list_music bxh1">
    <?php
    $data = $upload->toArray();
    use App\Library\Helpers;
    array_map(function ($i, $item) {
    ?>
    <li class="media align-items-stretch not">
        <div class="media_tmp align-self-center d-flex align-items-center mr-3 pl-3" style="width: 50px">
            <span class="counter">{{sprintf("%02d", ++$i)}}</span>
        </div>
        <div class="media-left align-items-stretch mr-2">
            <a target="_blank" href="/dang-tai/nhac/{{$item['music_id']}}" title="{{$item['music_title']}}">
                <img src="{{Helpers::cover_url($item['cover_id'])}}" alt="{{$item['music_title']}}">
                <i class="material-icons">play_circle_outline</i>
            </a>
        </div>
        <div class="media-body align-items-stretch d-flex flex-column justify-content-between p-0">
            <div>
                <h5 class="media-title mt-0 mb-0"><a target="_blank" href="/dang-tai/nhac/{{$item['music_id']}}" title="{{$item['music_title']}}">{{$item['music_title']}}</a></h5>
                <div class="author"><?php echo $item['music_artist'] ?></div>
            </div>
            <small class="type_music c1"><?php echo Helpers::bitrate2str($item['music_bitrate']); ?></small>
        </div>
        <div class="media-right align-self-center">
            <small class="time_stt_not_hidden">{{$item['date_expirted'] == null ? 'Không thời hạn' : date('d/m/Y', $item['date_expirted'])}}</small>
        </div>
    </li>
    <?php
    }, array_keys($data['data']), $data['data']);
    ?>
</ul>
<div>
    <?php echo $upload->links() ?>
</div>