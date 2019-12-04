<?php
use App\Library\Helpers;
?>
    <?php
    array_map(function ($item) use ($commentReply) {
    ?>
    <div class="area_comment d-flex" id="comment-{{$item['comment_id']}}">
        <div align="top" class="avatar user_comment py-2">
            <a href="/user/{{$item['user']['id']}}"><img src="<?php echo Helpers::pathAvatar($item['user']['user_avatar'], $item['user']['id']) ?>" alt="{{$item['user']['name']}}" alt=""></a>
        </div>
        <div class="content_comment text-left pl-2 py-2">
            <div class="item position_relative">
                <div class="body_comment">
                    <a href="/user/{{$item['user']['id']}}"><div class="infor"><strong class="author card-title">{{$item['user']['name']}}</strong>
                        @if($item['comment_jw_postion'])
                        <span class="text-gray">at</span>
                        <time>{{ $item['comment_jw_postion'] >= 3600 ? gmdate("H:i:s", $item['comment_jw_postion']) : gmdate("i:s", $item['comment_jw_postion'])}}</time>
                        @endif
                    </div></a>
                    <div class="detail">
                        <p>{{$item['comment_text']}}</p>
                    </div>
                    <div class="data_time text-gray text-right"><span><?php echo Helpers::timeElapsedString($item['comment_time']); ?></span></div>
                </div>
                <div class="block_form_comment"><a href="" class="reply_comment" data-comment_id="{{$item['comment_id']}}" >Trả lời</a>
                    <div class="post_comment_reply post_comment_reply_{{$item['comment_id']}}">
                        <form class="box_form_comment form_reply_comment form-comment-{{$item['comment_id']}}">
                            <div class="form-group mb-2">
                                <textarea rows="1" placeholder="Viết bình luận tại đây..." class="form-control p-2"></textarea>
                                <input type="hidden" class="reply_cmt_id" name="reply_cmt_id" value="{{$item['comment_id']}}">
                            </div>
                            <div class="form-group text-left m-0">
                                <button type="submit" onclick="postComment({{$item['comment_id']}})" class="btn btn-secondary btn-gradien btn-radius send-comment"><span>Gửi</span></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="post_comment_reply comment-reply-{{$item['comment_id']}}">
                    <?php
                    if($commentReply) {
                        foreach ($commentReply as $reply) {
                            if($reply['comment_id'] == $item['comment_id']){
                            ?>
                            <div class="area_comment_reply d-flex">
                                <div align="top" class="avatar user_comment py-2">
                                    <a href="/user/{{$reply['user']['id']}}"><img src="<?php echo Helpers::pathAvatar($reply['user']['user_avatar'], $reply['user']['id']) ?>" alt=""></a>
                                </div>
                                <div class="content_comment text-left pl-2 py-2">
                                    <div class="item position_relative">
                                        <div class="body_comment">
                                            <a href="/user/{{$reply['user']['id']}}"><div class="infor"><strong class="author card-title">{{$reply['user']['name']}}</strong>
                                                @if($item['comment_jw_postion'])
                                                <span class="text-gray">at</span>
                                                <time>{{ $item['comment_jw_postion'] >= 3600 ? gmdate("H:i:s", $item['comment_jw_postion']) : gmdate("i:s", $item['comment_jw_postion'])}}</time>
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
                            <?php
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    }, $comment['data']);
    ?>
{{($pagingHtml ?? '')}}