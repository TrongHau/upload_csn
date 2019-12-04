<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8/21/2018
 * Time: 3:33 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Library\Helpers;
use Illuminate\Support\Facades\Redirect;
use App\Repositories\Comment\CommentEloquentRepository;
use App\Repositories\CommentReply\CommentReplyEloquentRepository;
use App\Repositories\Music\MusicEloquentRepository;
use App\Repositories\User\UserEloquentRepository;

class CommentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $commentRepository;
    protected $commentReplayRepository;
    protected $musicRepository;
    protected $userRepository;


    public function __construct(CommentEloquentRepository $commentRepository, CommentReplyEloquentRepository $commentReplayRepository, MusicEloquentRepository $musicRepository,
                                UserEloquentRepository $userRepository)
    {
        $this->commentRepository = $commentRepository;
        $this->commentReplayRepository = $commentReplayRepository;
        $this->musicRepository = $musicRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    function postComment(Request $request) {
        if(!$request->input('comment')) {
            return redirect()->route('music.listen')->with('error', 'Nhập nội dung bình luận');
        }
        if(!Auth::user()->id) {
            return Redirect::to('/login');
        }
        if(strlen($request->input('comment')) >= 1000)
            abort(403, 'Lỗi bình luận bạn quá dài.');

        // check banned user
        if(backpack_user()->can('banned_user_comment')){
            abort(403, 'Lỗi truy cập, tài khoản bạn bị khóa chức năng đăng bình luận.');
        }
        $request->input('comment_page');
        $pageComment = '';
        $commentReply = array();
        $pagingHtml = '';
        $result = array();
        if($request->input('reply_cmt_id')) {
            // add comment children
            $result = $this->commentReplayRepository->create([
                'music_id' => $request->input('music_id'),
                'comment_id' => $request->input('reply_cmt_id'),
                'user_id' => Auth::user()->id,
                'username' => Auth::user()->username ?? '',
                'comment_jw_postion' => $request->comment_jw_postion,
                'comment_text' => $request->input('comment'),
                'comment_delete' => SET_DEACTIVE,
            ]);
            $this->musicRepository->incrementCol($request->input('music_id'), 'music_comment');
            $reply = $result->toArray();
            $reply['user'] = Auth::user()->toArray();
            return view('comment.comment_children', compact('reply'));
        } else {
            // add comment parent
            $result = $this->commentRepository->create([
                'music_id' => $request->input('music_id'),
                'user_id' => Auth::user()->id,
                'username' => Auth::user()->username ?? '',
                'comment_jw_postion' => $request->comment_jw_postion,
                'comment_text' => $request->input('comment'),
                'comment_delete' => SET_DEACTIVE,

            ]);
            $this->musicRepository->incrementCol($request->input('music_id'), 'music_comment');
            $this->userRepository->incrementCol(Auth::user()->id, 'user_comments');
            $result = $result->toArray();
            $result['user'] = Auth::user()->toArray();
            $comment['data'][] = $result;
            return view('comment.comment', compact('comment', 'commentReply', 'pagingHtml'));
        }

    }
    function getAjaxCommentByMusicId(Request $request){
        if($request->input('music_id')) {
            $comment = $this->commentRepository->findByMusicId($request->input('music_id'), 'comment_time', 'desc', LIMIT_COMMENT);
            $pagingHtml = $comment->links();
            $comment = $comment->toArray();
            $arrId = array();
            foreach($comment['data'] as $item) {
                $arrId[] = $item['comment_id'];
            }
            $commentReply = $this->commentReplayRepository->getCommentByCommentId($arrId, 'comment_time', 'desc')->toArray();
            return view('comment.comment', compact('comment', 'commentReply', 'pagingHtml'));
        }
    }
    function blockComment(Request $request) {
         if(!backpack_user()->can('comment_(can_block)')){
             abort(403, 'Lỗi truy cập, tài khoản bạn không có quyền block comment.');
         }
        if($request->type == 'comment') {
            $comment = $this->commentRepository->getModel()::where('comment_id', $request->id)->first();
        }else{
            $comment = $this->commentReplayRepository->getModel()::where('comment_reply_id', $request->id)->first();
        }
        if(!$comment) {
            Helpers::ajaxResult(false, 'Bình luận không tìm thấy', null);
        }
        $comment->comment_delete = !$comment->comment_delete;
        $comment->comment_delete_by = Auth::user()->id;
        $comment->save();
        Helpers::ajaxResult(true, '', ['comment_text' => $comment->comment_delete ? '<i>Bình luận này đã bị xóa.</i>' : $comment->comment_text, 'delete' => $comment->comment_delete ? 'Phục hồi': 'Xóa']);

    }
}
