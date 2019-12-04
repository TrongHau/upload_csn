<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8/21/2018
 * Time: 3:33 PM
 */

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Library\Helpers;
use App\Repositories\User\UserEloquentRepository;
use App\Repositories\Music\MusicEloquentRepository;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Playlist\PlaylistEloquentRepository;
use App\Repositories\Album\AlbumEloquentRepository;
use App\Models\MailTokenModel;
use App\Repositories\Upload\UploadEloquentRepository;
use App\Repositories\ArtistFavourite\ArtistFavouriteRepository;
use App\Repositories\MusicFavourite\MusicFavouriteRepository;
use App\Repositories\VideoFavourite\VideoFavouriteRepository;
use App\Repositories\Cover\CoverEloquentRepository;

class UserMusicController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $userRepository;
    protected $musicRepository;
    protected $playlistRepository;
    protected $uploadRepository;
    protected $albumRepository;
    protected $artistFavouriteRepository;
    protected $musicFavouriteRepository;
    protected $videoFavouriteRepository;
    protected $coverRepository;

    public function __construct(UserEloquentRepository $userRepository, PlaylistEloquentRepository $playlistRepository, MusicEloquentRepository $musicRepository,
                                UploadEloquentRepository $uploadRepository, AlbumEloquentRepository $albumRepository, ArtistFavouriteRepository $artistFavouriteRepository, MusicFavouriteRepository $musicFavouriteRepository,
                                VideoFavouriteRepository $videoFavouriteRepository, CoverEloquentRepository $coverRepository)
    {
        $this->userRepository = $userRepository;
        $this->playlistRepository = $playlistRepository;
        $this->musicRepository = $musicRepository;
        $this->uploadRepository = $uploadRepository;
        $this->albumRepository = $albumRepository;
        $this->artistFavouriteRepository = $artistFavouriteRepository;
        $this->musicFavouriteRepository = $musicFavouriteRepository;
        $this->videoFavouriteRepository = $videoFavouriteRepository;
        $this->coverRepository = $coverRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function musicUploaded(Request $request)
    {
        if(!Auth::check()) {
            return 'Lỗi User';
        }else{
            $id = $request->user_id;
            if(Auth::user()->hasPermission('duyet_sua_nhac')) {
                $id = $request->user_id;
            }
        }
        if(Auth::user()->id != $id && !Auth::user()->hasPermission('duyet_sua_nhac')) {
            return 'Lỗi User';
        }
        if($request->page_tab == 'upload') {
            $stage = $request->input('stage');
            if($stage == 'all' || $stage == 'uncensor') {
                // chờ xử lý
                $music['stage_uncensor'] = $this->uploadRepository->musicByUser($id, [UPLOAD_STAGE_UNCENSOR], 'music_last_update_time', 'desc', LIMIT_PAGE_MUSIC_UPLOADED);
            }
            if($stage == 'all' || $stage == 'fullcensor') {
                // đã duyệt
                $music['stage_fullcensor'] = $this->uploadRepository->musicByUser($id, [UPLOAD_STAGE_FULLCENSOR, UPLOAD_STAGE_FULLCONVERT], 'music_last_update_time', 'desc', LIMIT_PAGE_MUSIC_UPLOADED);
            }
            if($stage == 'all' || $stage == 'delete') {
                // đã xóa
                $music['stage_delete'] = $this->uploadRepository->musicByUser($id, [UPLOAD_STAGE_DELETED], 'music_last_update_time', 'desc', LIMIT_PAGE_MUSIC_UPLOADED);
            }
            if($stage == 'all' || $stage == 'album') {
                // album
                $music['album'] = $this->coverRepository->findCoverByUser($id, 'cover_id', 'desc', LIMIT_PAGE_MUSIC_UPLOADED);
            }
            return view('user.music_uploaded', compact('music', 'stage'));
        }elseif($request->page_tab == 'approval'){
            $stage = $request->input('stage');
            if($stage == 'all' || $stage == 'fullconvert') {
                // chờ duyệt
                $music['stage_fullconvert'] = $this->uploadRepository->musicByStage([UPLOAD_STAGE_FULLCONVERT], 'music_last_update_time', 'desc', LIMIT_PAGE_MUSIC_UPLOADED);
            }
            if($stage == 'all' || $stage == 'uncensor') {
                // chờ xử lý
                $music['stage_uncensor'] = $this->uploadRepository->musicByStage([UPLOAD_STAGE_UNCENSOR], 'music_last_update_time', 'desc', LIMIT_PAGE_MUSIC_UPLOADED);
            }
            if($stage == 'all' || $stage == 'fullcensor') {
                // đã duyệt
                $music['stage_fullcensor'] = $this->uploadRepository->musicByStage([UPLOAD_STAGE_FULLCENSOR], 'music_last_update_time', 'desc', LIMIT_PAGE_MUSIC_UPLOADED);
            }
            if($stage == 'all' || $stage == 'fullcensor_by') {
                // đã duyệt theo user lần cuối cùng
                $music['stage_fullcensor_by'] = $this->uploadRepository->musicByStage([UPLOAD_STAGE_FULLCENSOR], 'music_last_update_time', 'desc', LIMIT_PAGE_MUSIC_UPLOADED, Auth::user()->id);
            }
            if($stage == 'all' || $stage == 'delete') {
                // đã xóa
                $music['stage_delete'] = $this->uploadRepository->musicByStage([UPLOAD_STAGE_DELETED], 'music_last_update_time', 'desc', LIMIT_PAGE_MUSIC_UPLOADED);
            }
            return view('user.music_approval', compact('music', 'stage'));
        }
    }
    public function musicUploadedRedirect(Request $request, $music_id) {
//        , 'music_user_id' => $user_id
        $music = $this->musicRepository->getModel()::where(['music_id' => $music_id])->first();
        if($music) {
            $url = Helpers::listen_url($music->toArray());
            return redirect($url);
        }
        return view('errors.404')->with('message', 'Nhạc đang cập nhật.');
    }
    public function musicRecent(Request $request) {
        $musics = [];
        $musicRecent = $_COOKIE['music_history'] ?? '';
        if(Auth::check()) {
            $musicRecent = Auth::user()->user_music_recent;
        }
        if($musicRecent) {
            $musicHistory = array_reverse(unserialize($musicRecent));
            $tempStr = implode(',', $musicHistory);
            $musics = $this->musicRepository->getHistoryRecents($tempStr);
        }
        return view('user.music_recents', compact('musics'));
    }
    public function artistFavourite(Request $request) {
        $user_id = $request->user_id;
        $artistFavourite = $this->artistFavouriteRepository->getModel()::where('user_id', $user_id)->with('artist')->orderBy('id', 'desc')->paginate(LIMIT_PAGE_ARTIST_FAVOURITE);
        return view('user.artist_favourite', compact('artistFavourite', 'user_id'));
    }
    public function videoFavourite(Request $request) {
        $user_id = $request->user_id;
        $videoFavourite = $this->videoFavouriteRepository->getModel()::where('user_id', $user_id)->with('video')->orderBy('id', 'desc')->paginate(LIMIT_PAGE_MUSIC_FAVOURITE);
        return view('user.video_favourite', compact('videoFavourite', 'user_id'));
    }
    public function musicFavourite(Request $request) {
        $user_id = $request->user_id;
        $musicFavourite = $this->musicFavouriteRepository->getModel()::where('user_id', $user_id)->with('music')->orderBy('id', 'desc')->paginate(LIMIT_PAGE_MUSIC_FAVOURITE);
        return view('user.music_favourite', compact('musicFavourite', 'user_id'));
    }

}
