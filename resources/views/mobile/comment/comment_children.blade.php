<?php
use App\Library\Helpers;
?>
<div class="area_comment_reply d-flex">
    <div align="top" class="avatar user_comment py-2">
        <a href="/user/{{$reply['user']['id']}}"><img src="<?php echo Helpers::pathAvatar($reply['user']['user_avatar'], $reply['user']['id']) ?>" alt=""></a>
    </div>
    <div class="content_comment text-left pl-2 py-2">
        <div class="item position_relative">
            <div class="body_comment">
                <a href="/user/{{$reply['user']['id']}}"><div class="infor"><strong class="author card-title">{{$reply['user']['name']}}</strong>
                        @if($reply['comment_jw_postion'])
                        <span class="text-gray">at</span>
                        <time>{{ $reply['comment_jw_postion'] >= 3600 ? gmdate("H:i:s", $reply['comment_jw_postion']) : gmdate("i:s", $reply['comment_jw_postion'])}}</time>
                        @endif
                    </div></a>
                <div class="detail">
                    <p>{{$reply['comment_text']}}</p>
                </div>
                <div class="data_time text-gray text-right"><span><?php echo Helpers::timeElapsedString($reply['comment_time']); ?></span></div>
            </div>
        </div>
    </div>
</div>