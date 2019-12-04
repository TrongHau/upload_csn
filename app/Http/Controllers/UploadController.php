<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8/9/2018
 * Time: 11:35 AM
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request as Request;
use Illuminate\Support\Facades\Auth;
use App\Library\Helpers;
use App\Repositories\ArtistUpload\ArtistUploadEloquentRepository;
use App\Repositories\Music\MusicEloquentRepository;
use App\Repositories\Video\VideoEloquentRepository;
use App\Repositories\Upload\UploadEloquentRepository;
use App\Repositories\UploadException\UploadExceptionEloquentRepository;
use App\Repositories\Album\AlbumEloquentRepository;
use App\Repositories\Cover\CoverEloquentRepository;
use App\Repositories\Artist\ArtistRepository;
use App\Repositories\PlaylistMusic\PlaylistMusicEloquentRepository;
use App\Repositories\MusicFavourite\MusicFavouriteRepository;
use Illuminate\Support\Facades\Storage;
use App\Repositories\DeleteMusic\DeleteMusicEloquentRepository;
use App\Repositories\DeleteVideo\DeleteVideoEloquentRepository;
use App\Repositories\ArtistException\ArtistExceptionRepository;
use App\Repositories\User\UserEloquentRepository;
use App\Solr\Solarium;
use Illuminate\Support\Str;
use App\Http\Controllers\Sync\SolrSyncController;
use File;
use Artisan;
use Validator;
use Exception;
use App\Exceptions;

class UploadController extends Controller
{
    protected $artistUploadRepository;
    protected $artistRepository;
    protected $musicRepository;
    protected $videoRepository;
    protected $uploadRepository;
    protected $uploadExRepository;
    protected $albumRepository;
    protected $coverRepository;
    protected $deleteMusicRepository;
    protected $deleteVideoRepository;
    protected $artistExpRepository;
    protected $userExpRepository;
    protected $playlistMusicRepository;
    protected $musicFavouriteRepository;
    protected $Solr;

    public function __construct(ArtistUploadEloquentRepository $artistUploadRepository, MusicEloquentRepository $musicRepository, ArtistRepository $artistRepository,
                                UploadEloquentRepository $uploadRepository, AlbumEloquentRepository $albumRepository, VideoEloquentRepository $videoRepository, CoverEloquentRepository $coverRepository, Solarium $Solr,
                                DeleteVideoEloquentRepository $deleteVideoRepository, DeleteMusicEloquentRepository $deleteMusicRepository, ArtistExceptionRepository $artistExpRepository, UploadExceptionEloquentRepository $uploadExRepository,
                                UserEloquentRepository $userExpRepository, PlaylistMusicEloquentRepository $playlistMusicRepository, MusicFavouriteRepository $musicFavouriteRepository) {
        $this->artistUploadRepository = $artistUploadRepository;
        $this->musicRepository = $musicRepository;
        $this->videoRepository = $videoRepository;
        $this->uploadRepository = $uploadRepository;
        $this->albumRepository = $albumRepository;
        $this->artistRepository = $artistRepository;
        $this->coverRepository = $coverRepository;
        $this->deleteVideoRepository = $deleteVideoRepository;
        $this->deleteMusicRepository = $deleteMusicRepository;
        $this->uploadExRepository = $uploadExRepository;
        $this->artistExpRepository = $artistExpRepository;
        $this->userExpRepository = $userExpRepository;
        $this->playlistMusicRepository = $playlistMusicRepository;
        $this->musicFavouriteRepository = $musicFavouriteRepository;
        $this->Solr = $Solr;
        $this->middleware(function ($request, $next)
        {
            if(backpack_user()->can('banned_user_upload')){
                abort(403, 'Lỗi truy cập, tài khoản bạn bị khóa chức năng upload.');
            }
            return $next($request);
        });
//        abort(403, 'Đang bảo trì hệ thống đăng tải, vui lòng quay lại sau ít phút.');
    }
    public function index() {
        return view('upload.index');
    }
    public function createArtist(Request $request) {
        return view('upload.upload_artist');
    }
    public function createMusic(Request $request, $musicId = null) {
        $typeUpload = 'music';
        $uploadExp = '';
        if($musicId) {
            $id = Auth::user()->id;
            $arrStage = [UPLOAD_STAGE_DELETED, UPLOAD_STAGE_UNCENSOR, UPLOAD_STAGE_FULLCONVERT];
            if(Auth::user()->hasPermission('duyet_sua_nhac')) {
                $id = 'permission_duyet_csn';
                $arrStage[] = UPLOAD_STAGE_FULLCENSOR;
            }
//            if($musicId < ID_OLD_MUSIC)
//                return view('errors.text_error')->with('message', 'Bài hát đã cũ không được phép sửa');
            $music = $this->uploadRepository->findMusicStatus($id, $musicId);
            if(!$music)
                return view('errors.404');
            if($music->music_state == UPLOAD_STAGE_FULLCENSOR && !Auth::user()->hasPermission('duyet_sua_nhac'))
                return view('errors.text_error')->with('message', 'Bài hát đã được duyệt, bạn không được phép sửa');
            if(!in_array($music->music_state, $arrStage))
                return view('errors.text_error')->with('message', 'Bài hát đang được xử lý, bạn vui lòng quay lại sau');
            if($music->cat_id == CAT_VIDEO)
                return view('errors.text_error')->with('message', 'Danh mục trang bạn chọn không chính xác');
            if($music->cover_id) {
                $album = $this->coverRepository->findCover($music->cover_id);
                if(!$album)
                    return view('errors.text_error')->with('message', 'Tình trạng album không tìm thấy hoặc đang được xử lý');
            }
            $uploadExp = $this->uploadExRepository->getModel()::where('music_title', $music->music_title)
                ->where('music_artist', $music->music_artist)
                ->where(function($q) {
                    $q->where('date_expirted', null)
                        ->orWhere('date_expirted', '>', time());
                })->first();
            $userMusic = $this->userExpRepository->getModel()::whereIn('user_id', [$music->music_user_id, $music->music_last_update_by])->orderByRaw( "FIELD(user_id, ".$music->music_user_id.", ".$music->music_last_update_by.")" )->get();
        }
        return view('upload.upload_music', compact('typeUpload', 'music', 'album', 'userMusic', 'uploadExp'));
    }
    public function createVideo(Request $request, $musicId = null) {
        $typeUpload = 'video';
        $uploadExp = '';
        if($musicId) {
            $id = Auth::user()->id;
            $arrStage = [UPLOAD_STAGE_DELETED, UPLOAD_STAGE_UNCENSOR, UPLOAD_STAGE_FULLCONVERT];
            if(Auth::user()->hasPermission('duyet_sua_nhac')) {
                $id = 'permission_duyet_csn';
                $arrStage[] = UPLOAD_STAGE_FULLCENSOR;
            }
//            if($musicId < ID_OLD_MUSIC)
//                return view('errors.text_error')->with('message', 'Bài hát đã cũ không được phép sửa');
            $music = $this->uploadRepository->findMusicStatus($id, $musicId);
            if(!$music)
                return view('errors.404');
            if(!in_array($music->music_state, $arrStage))
                return view('errors.text_error')->with('message', 'Bài hát đang được xử lý, bạn vui lòng quay lại sau');
            if($music->cat_id != CAT_VIDEO)
                return view('errors.text_error')->with('message', 'Danh mục trang bạn chọn không chính xác');
            if($music->cover_id) {
                $album = $this->coverRepository->findCover($music->cover_id);
                if(!$album)
                    return view('errors.text_error')->with('message', 'Tình trạng album không tìm thấy hoặc đang được xử lý');
            }
            $uploadExp = $this->uploadExRepository->getModel()::where('music_title', $music->music_title)
                ->where('music_artist', $music->music_artist)
                ->where(function($q) {
                    $q->where('date_expirted', null)
                        ->orWhere('date_expirted', '>', time());
                })->first();
            $userMusic = $this->userExpRepository->getModel()::whereIn('user_id', [$music->music_user_id, $music->music_last_update_by])->orderByRaw( "FIELD(user_id, ".$music->music_user_id.", ".$music->music_last_update_by.")" )->get();
        }
        return view('upload.upload_music', compact('typeUpload', 'music', 'album', 'userMusic', 'uploadExp'));
    }
    public function createAlbum(Request $request, $coverId = null) {
        if($coverId) {
            if(Auth::user()->hasPermission('duyet_sua_nhac')) {
                $album = $this->coverRepository->findCover($coverId);
            }else{
                $album = $this->coverRepository->findCover($coverId, Auth::user()->id);
            }
            if(!$album)
                return view('errors.404');
        }
        return view('upload.upload_album', compact('album'));
    }
    function storeArtist(Request $request) {
        $this->validate($request, [
            'artist_nickname' => 'required|max:255|unique:csn_artist',
            'artist_birthday' => 'required|max:15|date',
            'artist_gender' => 'required|max:1',
            'artist_avatar' => 'required',
            'choose_artist_avatar' => 'required|mimes:jpeg,bmp,png,gif|max:10000kb|file:1',
            'artist_cover' => 'required',
            'choose_artist_cover' => 'required|mimes:jpeg,bmp,png,gif|max:10000kb|file:1',
            'artist_avatar_crop_x' => 'required',
            'artist_avatar_crop_y' => 'required',
            'artist_cover_crop_x' => 'required',
            'artist_cover_crop_y' => 'required',
        ]);
        $artist = [
            'artist_nickname' => $request->input('artist_nickname'),
            'artist_birthday' => date("Y/m/d", strtotime($request->input('artist_birthday'))),
            'artist_gender' => $request->input('artist_gender'),
            'last_update_user_id' => Auth::user()->id,
            'artist_avatar_crop_x' => $request->input('artist_avatar_crop_x'),
            'artist_avatar_crop_y' => $request->input('artist_avatar_crop_y'),
            'artist_cover_crop_x' => $request->input('artist_cover_crop_x'),
            'artist_cover_crop_y' => $request->input('artist_cover_crop_y'),
            'type' => 1,

        ];
        $result = $this->artistUploadRepository->createArtist($artist);
        if(!$result)
            return redirect()->route('upload.createArtist')->with('error', 'tạo ca sĩ thất bại');
        //save image
        $typeImageAvatar = array_last(explode('.', htmlspecialchars_decode(trim(stripslashes($_FILES['choose_artist_avatar']['name'])), ENT_QUOTES)));
        $typeImageCover = array_last(explode('.',  htmlspecialchars_decode(trim(stripslashes($_FILES['choose_artist_cover']['name'])), ENT_QUOTES)));
        $fileNameAvt = Helpers::saveBase64ImageJpg($request->input('artist_avatar'), Helpers::file_path($result->artist_id, CACHE_AVATAR_ARTIST_CROP_PATH, true), $result->artist_id, $typeImageAvatar);
        Helpers::copySourceImage($request->file('choose_artist_avatar'), Helpers::file_path($result->artist_id, AVATAR_ARTIST_SOURCE_PATH, true), $result->artist_id, $typeImageAvatar);
        $fileNameCover = Helpers::saveBase64ImageJpg($request->input('artist_cover'), Helpers::file_path($result->artist_id, CACHE_COVER_ARTIST_CROP_PATH, true), $result->artist_id, $typeImageCover);
        Helpers::copySourceImage($request->file('choose_artist_cover'), Helpers::file_path($result->artist_id, COVER_ARTIST_SOURCE_PATH, true), $result->artist_id, $typeImageCover);
        $result->artist_avatar = $fileNameAvt;
        $result->artist_cover = $fileNameCover;
        $result->save();
        return redirect()->route('upload.createArtist')->with('success', 'Đã tạo ca sĩ ' . $result->artist_nickname);
    }
    function storeSuggestArtist(Request $request, $urlArtist) {
        $arrUrl = Helpers::splitArtistUrl($urlArtist);
        $artistExist = $this->artistRepository->findOnlyPublished($arrUrl['id']);
        if(!$artistExist && $arrUrl['id'])
            return view('errors.404');
        if(!$request->artist_nickname && !$request->artist_birthday && !$request->artist_avatar && !$request->artist_cover && !$request->input('artist_id')) {
            return view('errors.text_error')->with('message', 'Nhập ít nhất các thông tin cho ca sĩ '.$artistExist->artist_nickname);
        }
        $artist = [
            'artist_nickname' => $artistExist->artist_nickname,
            'artist_birthday' => date("Y/m/d", strtotime($request->input('artist_birthday'))),
            'artist_gender' => $request->input('artist_gender'),
            'last_update_user_id' => Auth::user()->id,
            'artist_avatar_crop_x' => $request->input('artist_avatar_crop_x'),
            'artist_avatar_crop_y' => $request->input('artist_avatar_crop_y'),
            'artist_cover_crop_x' => $request->input('artist_cover_crop_x'),
            'artist_cover_crop_y' => $request->input('artist_cover_crop_y'),
            'artist_id_suggest' => $request->input('artist_id'),
            'type' => 0,
        ];
        $result = $this->artistUploadRepository->createArtist($artist);
        if(!$result)
            return redirect()->route('upload.createArtist')->with('error', 'cập nhật ca sĩ thất bại');
        //save image
        if($request->input('artist_avatar') && $request->file('choose_artist_avatar')) {
            $typeImageAvatar = array_last(explode('.',  htmlspecialchars_decode(trim(stripslashes($_FILES['choose_artist_avatar']['name'])), ENT_QUOTES)));
            $fileNameAvt = Helpers::saveBase64ImageJpg($request->input('artist_avatar'), Helpers::file_path($result->artist_id, CACHE_AVATAR_ARTIST_CROP_PATH, true), $result->artist_id, $typeImageAvatar);
            Helpers::copySourceImage($request->file('choose_artist_avatar'), Helpers::file_path($result->artist_id, AVATAR_ARTIST_SOURCE_PATH, true), $result->artist_id, $typeImageAvatar);
            $result->artist_avatar = $fileNameAvt;
        }
        if($request->input('artist_cover') && $request->file('choose_artist_cover')) {
            $typeImageCover = array_last(explode('.', htmlspecialchars_decode(trim(stripslashes($_FILES['choose_artist_cover']['name'])), ENT_QUOTES)));
            $fileNameCover = Helpers::saveBase64ImageJpg($request->input('artist_cover'), Helpers::file_path($result->artist_id, CACHE_COVER_ARTIST_CROP_PATH, true), $result->artist_id, $typeImageCover);
            Helpers::copySourceImage($request->file('choose_artist_cover'), Helpers::file_path($result->artist_id, COVER_ARTIST_SOURCE_PATH, true), $result->artist_id, $typeImageCover);
            $result->artist_cover = $fileNameCover;
        }
        $result->save();
        return redirect()->route('upload.createArtist')->with('success', 'Cám ơn bạn đã đóng góp thông tin ca sĩ '.$result->artist_nickname.'.<br/>Thông tin ca sĩ đã được gửi thành công lên hệ thống và đang chờ mod kiểm duyệt.<br/>Click <a href="/">vào đây</a> để trở về trang chủ.');

    }
    function suggestArtist(Request $request, $urlArtist) {
        $arrUrl = Helpers::splitArtistUrl($urlArtist);
        $artistExist = $this->artistRepository->findOnlyPublished($arrUrl['id']);
        if(!$artistExist)
            return view('errors.404');
        return view('upload.upload_artist', compact('artistExist'));
//        $this->artistSuggestRepository
    }
    function uploadFileMusic(Request $request) {
//        $fileU = $request->file('file');
        $type = substr($_FILES['file']['type'], 0, 5);
        $pathInfo = pathinfo($_FILES['file']['name']);
        if($type != 'audio' && $type != 'video') {
            return response()->json([
                'status' => false,
                'message' => 'Định dạng file "'.$_FILES['file']['name'].'" bị sai, chỉ chấp nhận file nhạc hoặc video',
            ]);
        }
        if($_FILES['file']['size'] > MAXIMUM_FILE_SIZE_UPLOAD_VIDEO) {
            return response()->json([
                'status' => false,
                'message' => '('.$_FILES['file']['name'].') Dung lượng file bạn upload quá cao, chỉ chấp nhận tối đa 5Gb file upload',
            ]);
        }
        $getID3 = new \getID3;
        $videoInfo = $getID3->analyze($_FILES['file']['tmp_name']);
        if($type == 'video') {
            if($pathInfo['extension'] != 'm2ts') {
                if($request->type == 'music')
                    return response()->json([
                        'success' => false,
                        'message' => '('.$_FILES['file']['name'].') Sai định dạng video',
                    ]);
                if(!isset($videoInfo['video']) || !isset($videoInfo['video']['resolution_x']) || !isset($videoInfo['video']['resolution_y'])) {
                    return response()->json([
                        'status' => false,
                        'message' => '('.$_FILES['file']['name'].') Định dạng phân giải video không tìm thấy',
                    ]);
                }
                if(($videoInfo['video']['resolution_x'] < 650 || $videoInfo['video']['resolution_y'] < 300)) {
                    return response()->json([
                        'status' => false,
                        'message' => '('.$_FILES['file']['name'].') Độ phân giải video quá thấp',
                    ]);
                }
                if(isset($videoInfo['playtime_seconds']) && $videoInfo['playtime_seconds'] > 3600) {
                    return response()->json([
                        'success' => false,
                        'message' => '('.$_FILES['file']['name'].') Độ dài video không vượt quá 60 phút',
                    ]);
                }
            }
        }else{
            if($request->type == 'video')
                return response()->json([
                    'success' => false,
                    'message' => '('.$_FILES['file']['name'].') Sai định dạng nhạc',
                ]);
            if(strpos($request->headers->get('referer'), 'album') == false && isset($videoInfo['playtime_seconds']) && $videoInfo['playtime_seconds'] < 30) {
                return response()->json([
                    'success' => false,
                    'message' => '('.$_FILES['file']['name'].') Độ dài nhạc/video không được thấp hơn 30 giây',
                ]);
            }
            if(isset($videoInfo['audio']) && ($videoInfo['audio']['lossless'] == false && $videoInfo['audio']['bitrate'] < 190000))
                return response()->json([
                    'success' => false,
                    'message' => '('.$_FILES['file']['name'].') Bài nhạc không được gửi lên vì có chất lượng thấp.',
                ]);
            if(isset($videoInfo['playtime_seconds']) && $videoInfo['playtime_seconds'] > 3600) {
                return response()->json([
                    'success' => false,
                    'message' => '('.$_FILES['file']['name'].') Độ dài nhạc không vượt quá 60 phút',
                ]);
            }

        }
        $fileName = Helpers::moveFile($request->file('file'), $_SERVER['DOCUMENT_ROOT'].DEFAULT_ROOT_CACHE_MUSIC_PATH, str_replace(';', '', $_FILES['file']['name']));
        return response()->json([
            'success' => true,
            'message' => 'Upload Success',
            'file_name' => str_replace(';', '', $fileName),
            'lossless' => $type == 'audio' ? (isset($videoInfo['audio']['lossless']) ? $videoInfo['audio']['lossless'] == true ? 1000 : (int)($videoInfo['audio']['bitrate'] / 1024) : '') : '',
            'file_size' => $_FILES['file']['size']
        ]);
    }
    public function storeMusic(Request $request, $musicId = null) {
        include(app_path() . '/../resources/views/cache/def_main_cat.blade.php');
        global $cat_id2info;
        if(!isset($cat_id2info[$request->cat_id][$request->cat_level])) {
            $errorMessages = new \Illuminate\Support\MessageBag;
            if($request->cat_id < 0 || $request->cat_id > 9) {
                $errorMessages->merge(['cat_id' => ['Danh mục bạn chọn không hợp lệ.']]);
            }else{
                $errorMessages->merge(['cat_level' => ['Danh mục bạn chọn không hợp lệ.']]);
            }
            return redirect()->back()->withErrors($errorMessages);
        }
        $this->validate($request, [
            'music_title' => 'required|max:255',
            'music_composer' => 'max:255',
            'music_artist' => 'required',
            'music_artist_id' => 'required',
            'drop_files' => 'required',
            'music_year' => 'max:4',
            'music_album_id' => 'max:15',
            'music_source_url' => 'max:255',
        ]);
        // check artist
        $countArtist = count(explode(';', htmlspecialchars_decode($request->input('music_artist'), ENT_QUOTES)));
        $countArtistId = count(explode(';', $request->input('music_artist_id')));
        if($countArtist != $countArtistId) {
            $errorMessages = new \Illuminate\Support\MessageBag;
            $errorMessages->merge(['music_artist' => ['Ca Sĩ bạn chọn không hợp lệ.']]);
            return redirect()->back()->withErrors($errorMessages);
        }

        $typeUpload = $request->input('type_upload');
        $artistExp = $this->artistExpRepository->getArrNames();
        if(Helpers::checkExitsExcepArtist($request->input('music_artist'), $artistExp) && !Auth::user()->hasPermission('duyet_sua_nhac')) {
            $errorMessages = new \Illuminate\Support\MessageBag;
            $errorMessages->merge(['music_artist' => ['Ca sĩ không được phép upload.']]);
            return redirect()->back()->withErrors($errorMessages);
        }
        $musicCoppyRight = $this->uploadExRepository->checkExist($request->input('music_title'), $request->input('music_artist'));
        if($musicCoppyRight && !Auth::user()->hasPermission('duyet_sua_nhac')) {
            $errorMessages = new \Illuminate\Support\MessageBag;
            $errorMessages->merge(['music_title' => ['Bài hát không được phép upload '. ($musicCoppyRight->date_expirted == null ? 'không thời hạn' : ' cho đến ' . date('d/m/Y', $musicCoppyRight->date_expirted)) . '.']]);
            return redirect()->back()->withErrors($errorMessages)->withInput($request->all());
        }
        $mess = '';
        $messType = $typeUpload == 'music' ? 'bài hát' : 'video';
        $user = Auth::user();
        if($request->input('action_upload') == 'edit') {
            $userId = Auth::user()->id;
            $arrStage = [UPLOAD_STAGE_DELETED, UPLOAD_STAGE_UNCENSOR, UPLOAD_STAGE_FULLCONVERT];
            $per_Xet_Duyet = $user->hasPermission('duyet_sua_nhac');
            $per_Xet_Duyet_Chat_luong = $user->hasPermission('duyet_sua_chat_luong_nhac');
            if($per_Xet_Duyet) {
                $userId = 'permission_duyet_csn';
                $arrStage[] = UPLOAD_STAGE_FULLCENSOR;
            }
            $result = $this->uploadRepository->findMusicStatus($userId, $musicId);
            if(!$result)
                return view('errors.404');
            // kiểm tra và update stage music
            $oldStage = $result->music_state;
            $isDelete = $request->delete_music;
            $oldCoverId = $result->cover_id;
            $oldAlbum = $oldCoverId ? $this->coverRepository->findCover($oldCoverId) : [];
            $newAlbum = [];
            if($per_Xet_Duyet) {
                if(isset($request->music_state) && ($request->music_state != $result->music_state)) {
                    if(!in_array($result->music_state, $arrStage))
                        return view('errors.text_error')->with('message', 'Bài hát đang được xử lý, bạn vui lòng quay lại sau');
                    if(!in_array($request->music_state, $arrStage))
                        return view('errors.text_error')->with('message', 'Trạng thái gửi lên không hợp lệ');
                    $result->music_state = $request->input('music_state');
                }
            }
            // update album
            $Solr = new SolrSyncController($this->Solr);
            if(!$request->input('cover_id')) {
                $result->cover_id = 0;
            }else{
                $newAlbum = $this->coverRepository->findCover($request->input('cover_id'));
                if($per_Xet_Duyet || $newAlbum->user_id == $user->id) {
                    $result->cover_id = str_replace('cover_', '', $request->input('cover_id'));
                }else{
                    return view('errors.text_error')->with('message', 'Bạn không có quyền với album này, kiểm tra lại quyền hoặc đăng tải của chủ sở hữu album');
                }
            }
            // tách hoặc xóa khỏi album
            if(($oldCoverId != $request->input('cover_id')) && !in_array($oldStage, [UPLOAD_STAGE_DELETED, UPLOAD_STAGE_UNCENSOR])) {
                $newAlbum = $newAlbum ? $newAlbum :$this->coverRepository->findCover($request->input('cover_id'));
                if($oldCoverId != 0 && $request->input('cover_id')) {
                    // chuyển album
                    if($oldAlbum) {
                        $oldAlbum->album_music_total = $oldAlbum->album_music_total - 1;
                        $oldAlbum->album_last_updated = time();
                    }
                    if($newAlbum) {
                        $newAlbum->album_music_total = $newAlbum->album_music_total + 1;
                        $newAlbum->album_last_updated = time();
                    }
                }elseif($request->input('cover_id')) {
                    // thêm album
                    if($newAlbum) {
                        $newAlbum->album_music_total = $newAlbum->album_music_total + 1;
                        $newAlbum->album_last_updated = time();
                    }

                }elseif(!$request->input('cover_id')) {
                    // xóa album
                    if($oldAlbum) {
                        $oldAlbum->album_music_total = $oldAlbum->album_music_total - 1;
                        $oldAlbum->album_last_updated = time();
                    }
                }
                if($oldAlbum)
                    $oldAlbum->save();
                if($newAlbum)
                    $newAlbum->save();
            }
            if(($per_Xet_Duyet && $oldStage != $request->input('music_state')) || $isDelete) {
                // cập nhật tình trạng sẽ xóa
                if(((in_array($request->input('music_state'), [UPLOAD_STAGE_DELETED, UPLOAD_STAGE_UNCENSOR])) && !in_array($oldStage, [UPLOAD_STAGE_DELETED, UPLOAD_STAGE_UNCENSOR])) || $isDelete) { //check old stage to before update stage field
                    // xóa nhạc, video
                    $result->music_state = UPLOAD_STAGE_DELETED;
                    if($result->cat_id == CAT_VIDEO) {
                        $this->videoRepository->deleteSafe($result);
                        $Solr->syncDeleteVideo(null, $result);
                    }else {
                        $this->musicRepository->deleteSafe($result);
                        $Solr->syncDeleteMusic(null, $result);
                        $this->playlistMusicRepository->deletePlaylistByMusicId($result->music_id);
                        $this->musicFavouriteRepository->deleteFavouriteByMusicId($result->music_id);
                    }
//                    $this->userExpRepository->getModel()::where('user_id', $result->user_id)->decrement('user_music', 1);
//                    $user->decrement('user_music', 1);
                    // áp dụng không thay đổi cover
                    if($result->cover_id && $oldCoverId == $request->input('cover_id') && $oldAlbum) {
                        $oldAlbum = $this->coverRepository->findCover($result->cover_id);
                        $oldAlbum->album_music_total = $oldAlbum->album_music_total - 1;
                        $oldAlbum->album_last_updated = time();
                        $oldAlbum->save();
                    }
                    $mess = 'Bạn đã xóa nhạc và ';
                    //Artisan::call('album');
                }else{
                    // cập nhật tình trạng đã xóa thành xét duyệt
                    // áp dụng không thay đổi cover
                    if($result->cover_id && $oldCoverId == $request->input('cover_id') && in_array($oldStage, [UPLOAD_STAGE_DELETED, UPLOAD_STAGE_UNCENSOR])) {
                        if(!$oldAlbum) {
                            $oldAlbum = $this->coverRepository->findCover($result->cover_id);
                        }
                        $oldAlbum->album_music_total = $oldAlbum->album_music_total + 1;
                        $oldAlbum->album_last_updated = time(); // tự động cập nhật cover ở crontab
                        $oldAlbum->save();
                    }
                }
            }
            if($oldAlbum && $oldAlbum->album_music_total == 0)
                $Solr->deleteCustom('cover_' . $oldAlbum->cover_id);
            if($newAlbum && $newAlbum->album_music_total == 0)
                $Solr->deleteCustom('cover_' . $newAlbum->cover_id);
            $result->music_title = $request->input('music_title');
            $result->music_artist = str_replace(';', '; ', $request->input('music_artist'));
            $result->music_artist_id = trim($request->input('music_artist_id') ?? '');
            $result->music_composer = $request->input('music_composer') ?? '';

            $result->cat_id = $request->input('cat_id') ?? 0;
            $result->cat_level = $request->input('cat_level') ?? 0;
            $result->cat_sublevel = $request->input('cat_sublevel') ?? 0;
            $result->cat_custom = $request->input('cat_custom') ?? 0;
            $result->music_lyric = $request->input('music_lyric') ?? '';
            $result->music_source_url = $request->input('music_source_url') ?? '';
            $result->music_note = $request->input('music_note') ?? '';
            $result->music_last_update_time = time();
            $result->music_last_update_by = $user->id;
            $result->music_updated = 0;
            if($request->music_track_id)
                $result->music_track_id = $request->music_track_id;
            if($per_Xet_Duyet_Chat_luong && $request->input('music_bitrate_fixed') && $result->music_bitrate_fixed != $request->input('music_bitrate_fixed')) {
                $result->music_bitrate_fixed = $request->input('music_bitrate_fixed');
                $result->music_bitrate_fixed_by = $user->id;
                if($request->input('music_bitrate_fixed') == 128){
                    $result->music_320_filesize = 0 - abs($result->music_320_filesize);
                    $result->music_m4a_filesize = 0 - abs($result->music_m4a_filesize);
                    $result->music_lossless_filesize = 0 - abs($result->music_lossless_filesize);
                }elseif ($request->input('music_bitrate_fixed') == 320) {
                    $result->music_320_filesize = abs($result->music_320_filesize);
                    $result->music_m4a_filesize = 0 - abs($result->music_m4a_filesize);
                    $result->music_lossless_filesize = 0 - abs($result->music_lossless_filesize);
                }elseif ($request->input('music_bitrate_fixed') == 500) {
                    $result->music_m4a_filesize = abs($result->music_m4a_filesize);
                    $result->music_320_filesize = 0 - abs($result->music_320_filesize);
                    $result->music_lossless_filesize = 0 - abs($result->music_lossless_filesize);
                }elseif ($request->input('music_bitrate_fixed') == 1000) {
                    $result->music_320_filesize = abs($result->music_320_filesize);
                    $result->music_m4a_filesize = abs($result->music_m4a_filesize);
                    $result->music_lossless_filesize = abs($result->music_lossless_filesize);
                }
                $result->music_bitrate = $request->input('music_bitrate_fixed');
            }
            if($result->cover_id == 0){
                $result->music_production = $request->input('music_production') ?? '';
                $result->music_album_id = $request->input('music_album_id') ?? '';
                $result->music_year = $request->input('music_year') ?? 0;
            }
            $result->save();
            // update cover artist
//            if($result->music_state == UPLOAD_STAGE_FULLCENSOR && $result->cover_id) {
//                $album = [];
//                foreach(explode(';', $request->input('music_artist')) as $key => $item) {
//                    $album['album_artist_' . ++ $key] = $item;
//                    if($key == 1)
//                        break;
//                }
//                foreach(explode(';', $request->input('music_artist_id')) as $key => $item) {
//                    $album['album_artist_id_' . ++ $key] = $item;
//                    if($key == 1)
//                        break;
//                }
//            }
            $musicRedirectNext = $this->uploadRepository->getModel()::where('music_user_id', $result->music_user_id)
                ->where('music_id', '>', $result->music_id)
                ->orderBy('music_id', 'asc')
                ->limit(1)
                ->first();
            $musicRedirectBack = $this->uploadRepository->getModel()::where('music_user_id', $result->music_user_id)
                ->where('music_id', '<', $result->music_id)
                ->orderBy('music_id', 'desc')
                ->limit(1)
                ->first();

//            // update solr
//            $Solr = new SolrSyncController($this->Solr);
//            $Solr->syncMusic(null, $result);
//            return redirect()->route('upload.storeMusic', ['musicId' => $musicId])->with('success', 'Đã chỉnh sửa '.$messType.' ' . $result->music_title);
            $mess = $mess . 'Đã chỉnh sửa '.$messType.' ' . $result->music_title;
            $mes2 = ($musicRedirectNext || $musicRedirectBack) ? '<br/><a href="/dang-tai/nhac/'.($musicRedirectNext ? $musicRedirectNext->music_id : $musicRedirectBack->music_id).'">Click vào đây để sửa bài '.($musicRedirectNext ? '<u>trước</u>' : '').'</a>'.($musicRedirectBack ? '<a href="/dang-tai/nhac/'.$musicRedirectBack->music_id.'"> | <u>sau</u></a>' : '') : '';
            return redirect()->route(($result->cat_id == CAT_VIDEO ? 'upload.storeVideo' : 'upload.storeMusic'), ['musicId' => $musicId])->with('success', $mess.'<br/><a href="/user/'.$result->music_user_id.'">Click vào đây để trở lại Tủ nhạc</a>'.$mes2);
        }else{
            $csnMusic = [
                'music_title' => $request->input('music_title'),
                'music_artist' => $request->input('music_artist'),
                'music_artist_id' => $request->input('music_artist_id'),
                'music_user_id' => $user->id,
                'music_username' => $user->name,
                'music_production' => $request->input('music_production') ?? '',
                'music_composer' => $request->input('music_composer') ?? '',
                'music_album_id' => $request->input('music_album_id') ?? '',
                'music_year' => $request->input('music_year') ?? 0,
                'cat_id' => $request->input('cat_id'),
                'cat_level' => $request->input('cat_level') ?? 0,
                'cat_sublevel' => $request->input('cat_sublevel') ?? 0,
                'cat_custom' => $request->input('cat_custom') ?? 0,
                'music_lyric' => $request->input('music_lyric') ?? '',
                'music_note' => $request->input('music_note') ?? '',
                'music_filesize' => $request->input('music_filesize') ?? 0,
                'music_source_url' => $request->input('music_source_url') ?? '',
                'music_filename_upload' => $request->input('drop_files'),
                'music_state' => UPLOAD_STAGE_UNCENSOR,
                'music_last_update_time' => time()
            ];
            $result = $this->uploadRepository->create($csnMusic);
        }
        if(!$result)
            return redirect()->route('upload.createMusic')->with('error', 'tạo '.$messType.' thất bại');
        $drop_files =  htmlspecialchars_decode($request->input('drop_files'), ENT_QUOTES);
        $fileName = $result->music_id.'.'.last(explode('.', $drop_files));
        Storage::disk('public')->move(DEFAULT_STORAGE_CACHE_MUSIC_PATH.$drop_files, Helpers::file_path($result->music_id, SOURCE_STORAGE_PATH, true).$fileName);
        $result->music_filename = $fileName;
        $result->save();
        $user->increment('user_music', 1);
        return redirect()->route($typeUpload == 'music' ? 'upload.createMusic' : 'upload.createVideo')->with('success', 'Đã tạo '.$messType.' ' . $csnMusic['music_title'] . '<a href="/dang-tai/'.($typeUpload == 'music' ? 'nhac' : 'video').'/'.$result->music_id.'"> quay lại chỉnh sửa</a>');
    }

    public function storeAlbum(Request $request, $coverId = null) {
        $user = Auth::user();
        if($request->input('action_upload') == 'edit') {
            $this->validate($request, [
                'music_album' => 'required|max:255',
//                'music_product`ion' => 'required',
//                'music_album_id' => 'required',
                'music_year' => 'required|max:5',
                'music_album_id' => 'max:15',
            ]);
            $userId = $user->id;
            $Solr = new SolrSyncController($this->Solr);
            if($user->hasPermission('duyet_sua_nhac'))
                $userId = null;
            $album = $this->coverRepository->findCover($coverId, $userId);
            if(!$album)
                return view('errors.404');
            // update upload
            $upload = $album->upload;
            $musics = $album->music;
            if($album->cover_id < 0) {
                // create new cover if cover id < 0 (not image)
                $albumNew = $album->toArray();
                // update solr
                $Solr->syncCover(null, $album);
                unset($albumNew['cover_id']);
                $this->coverRepository->delete($album->cover_id);
                $album = $this->coverRepository->create($albumNew);
                $coverId = $album->cover_id;
            }
            $album->music_album = $request->input('music_album') ?? '';
            $album->music_production = $request->input('music_production') ?? '';
            $album->music_album_id = $request->input('music_album_id') ?? '';
            $album->music_year = $request->input('music_year') ?? '';
            $album->album_last_updated = time();
            $album->last_user_id = $user->id;
            $imgAlbum = '';
            if($request->input('album_cover')) {
                $typeImageCover = array_last(explode('.', htmlspecialchars_decode($_FILES['choose_album_cover']['name'], ENT_QUOTES)));
                $fileNameCovert = Helpers::saveBase64ImageJpg($request->input('album_cover'), Helpers::file_path($album->cover_id, AVATAR_ALBUM_CROP_PATH, true), $album->cover_id);
                if($album->cover_filename)
                    Storage::disk('public')->delete(Helpers::file_path($album->cover_id, COVER_ALBUM_SOURCE_PATH, true).$album->cover_filename);
                $fileNameCovertSource = Helpers::copySourceImage($request->file('choose_album_cover'), Helpers::file_path($album->cover_id, COVER_ALBUM_SOURCE_PATH, true), $album->cover_id . '-' . Str::random(8), $typeImageCover);
                $album->cover_filename = $fileNameCovertSource;
                $imgAlbum = Helpers::file_path($album->cover_id, PUBLIC_COVER_ALBUM_CROP_PATH, true). $album->cover_id . '.jpg';
            }
            if($request->track_order_music) {
                $tracks = explode(',', $request->track_order_music);
                foreach ($tracks as $key => $item) {
                    if($item) {
                        $this->uploadRepository->getModel()::where('music_id', $item)->update(['music_track_id' => $key]);
                    }
                }
            }
            $moveCover = [];
            if($request->album_delete_music) {
                $moveCover = explode(',', $request->album_delete_music);

            }
            foreach($upload as $item) {
                $item->music_album = $album->music_album ?? '';
                $item->cover_id = $album->cover_id;
                $item->music_year = $album->music_year ?? '';
                $item->music_album_id = $album->music_album_id ?? '';
                $item->music_production = $album->music_production ?? '';
                $item->music_last_update_time = time();
                if(in_array($item->music_id, $moveCover)){
                    $item->cover_id = 0;
                    if(!in_array($item->music_state, [UPLOAD_STAGE_DELETED, UPLOAD_STAGE_UNCENSOR]))
                        $album->album_music_total = $album->album_music_total - 1;
                }
                $item->save();
            }

            foreach($musics as $item) {
                $item->music_album = $album->music_album ?? '';
                $item->music_year = $album->music_year ?? '';
                $item->music_album_id = $album->music_album_id ?? '';
                $item->music_production = $album->music_production ?? '';
                $item->music_last_update_time = time();
                if(in_array($item->music_id, $moveCover)){
                    $item->cover_id = 0;
                }
                $item->save();
            }
            if($album->album_music_total == 0)
                $Solr->deleteCustom('cover_' . $album->cover_id);
            $album->save();
//            // update solr
            if($album->album_music_total > 0) {
                $Solr = new SolrSyncController($this->Solr);
                $Solr->syncCover(null, $album);
            }
            return redirect()->route('upload.storeAlbum', ['musicId' => $coverId])->with(['success' => 'Đã chỉnh sửa album ' . $album->album_name, 'img_album' => $imgAlbum]);
        }
        $this->validate($request, [
            'music_album' => 'required|max:255',
            'music_composer' => 'max:255',
            'music_artist' => 'required',
            'music_artist_id' => 'required',
            'drop_files' => 'required',
            'album_cover' => 'required',
            'music_year' => 'max:4',
            'music_album_id' => 'max:15',
        ]);
        include(app_path() . '/../resources/views/cache/def_main_cat.blade.php');
        global $cat_id2info;
        if(!isset($cat_id2info[$request->cat_id][$request->cat_level])) {
            $errorMessages = new \Illuminate\Support\MessageBag;
            if($request->cat_id < 0 || $request->cat_id > 9) {
                $errorMessages->merge(['cat_id' => ['Danh mục bạn chọn không hợp lệ.']]);
            }else{
                $errorMessages->merge(['cat_level' => ['Danh mục bạn chọn không hợp lệ.']]);
            }
            return redirect()->back()->withErrors($errorMessages);
        }
        // check artist
        $countArtist = count(explode(';', htmlspecialchars_decode($request->input('music_artist'), ENT_QUOTES)));
        $countArtistId = count(explode(';', $request->input('music_artist_id')));
        if($countArtist != $countArtistId) {
            $errorMessages = new \Illuminate\Support\MessageBag;
            $errorMessages->merge(['music_artist' => ['Ca Sĩ bạn chọn không hợp lệ.']]);
            return redirect()->back()->withErrors($errorMessages);
        }
        $fileUploads = explode(';', htmlspecialchars_decode($request->input('drop_files'), ENT_QUOTES));
        $fileSize = explode(';', htmlspecialchars_decode($request->input('music_filesize'), ENT_QUOTES));
        $album = $this->coverRepository->create([
            'music_album' => $request->input('music_album') ?? '',
            'music_production' => $request->input('music_production') ?? '',
            'music_year' => $request->input('music_year') ?? 0,
            'album_cat_id_1' => $request->input('cat_id') ?? 0,
            'album_cat_level_1' => $request->input('cat_level') ?? 0,
            'cover_filename' => '',
            'album_last_updated' => time(),
            'album_listen' => 0,
            'album_avg' => 0,
            'music_bitrate' => $request->input('lossless') ? 1000 : 0,
            'album_music_total' => 0,  // update in sync -> musicController (crontab)
//            'album_music_total' => count($fileUploads),
            'user_id' => $user->id,
            'last_user_id' => $user->id,
        ]);
        foreach(explode(';', htmlspecialchars_decode($request->input('music_artist'), ENT_QUOTES)) as $key => $item) {
            $album['album_artist_' . ++ $key] = $item;
            if($key == 1)
                break;
        }
        foreach(explode(';', htmlspecialchars_decode($request->input('music_artist_id'), ENT_QUOTES)) as $key => $item) {
            $album['album_artist_id_' . ++ $key] = $item;
            if($key == 1)
                break;
        }
        if(!$album)
            return redirect()->route('upload.upload_album')->with('error', 'tạo album thất bại');
        $typeImageCover = array_last(explode('.', htmlspecialchars_decode($_FILES['choose_album_cover']['name'], ENT_QUOTES)));
        $fileNameCovert = Helpers::saveBase64ImageJpg($request->input('album_cover'), Helpers::file_path($album->cover_id, AVATAR_ALBUM_CROP_PATH, true), $album->cover_id);
        if($album->cover_filename)
            Storage::disk('public')->delete(Helpers::file_path($album->cover_id, COVER_ALBUM_SOURCE_PATH, true).$album->cover_filename);
        $fileNameCovertSource = Helpers::copySourceImage($request->file('choose_album_cover'), Helpers::file_path($album->cover_id, COVER_ALBUM_SOURCE_PATH, true), $album->cover_id . '-' . Str::random(8), $typeImageCover);
        $album->cover_filename = $fileNameCovertSource;
        $album->save();
//        // update solr
//        $Solr = new SolrSyncController($this->Solr);
//        $Solr->syncCover(null, $album);
        $csnMusic = [
            'music_title' => '',
            'cover_id' => $album->cover_id,
            'music_album' => $album->music_album,
            'music_artist' => str_replace(';', '; ', $request->input('music_artist')) ?? '',
            'music_artist_id' => $request->input('music_artist_id'),
            'music_user_id' => $user->id,
            'music_username' => $user->name,
            'music_production' => $request->input('music_production') ?? '',
            'music_composer' => $request->input('music_composer') ?? '',
            'music_album_id' => $request->input('music_album_id') ?? '',
            'music_year' => $request->input('music_year') ?? 0,
            'cat_id' => $request->input('cat_id') ?? 0,
            'cat_level' => $request->input('cat_level') ?? 0,
            'cat_sublevel' => $request->input('cat_sublevel') ?? 0,
            'cat_custom' => $request->input('cat_custom') ?? 0,
            'music_lyric' => '',
            'music_last_update_time' => time(),
            'music_note' => $request->input('music_note') ?? '',
            'music_source_url' => $request->input('music_source_url') ?? '',
        ];
        $musicUpload = 0;
        foreach ($fileUploads as $key => $item) {
            $csnMusic['music_filename_upload'] = $item;
            $csnMusic['music_filesize'] = $fileSize[$key];
            $csnMusic['music_track_id'] = ++$key;
            $musicUpload ++;
            $result = $this->uploadRepository->create($csnMusic);
            $fileName = $result->music_id.'.'.last(explode('.', $item));
            Storage::disk('public')->move(DEFAULT_STORAGE_CACHE_MUSIC_PATH.$item, Helpers::file_path($result->music_id, SOURCE_STORAGE_PATH, true).$fileName);
            $result->save();
        }
        $user->increment('user_music', $musicUpload);
        return redirect()->route('upload.createMusic')->with('success', 'Đã tạo album mới ' . $request->input('music_album'). '<a href="/dang-tai/album/'.$result->cover_id.'"> vào chỉnh sửa album</a>');
    }
    function suggest(Request $request) {

        $arrUrl = Helpers::splitMusicUrl(last(explode('/', $request->url)));
        if(!$arrUrl['id'])
            Helpers::ajaxResult(false, 'Không tìm thấy id', null);
        if($arrUrl['type'] == 'music') {
            $result = $this->musicRepository->getModel()::where('music_id', $arrUrl['id'])->select('cat_id', 'cat_level', 'cat_sublevel', 'cat_custom', 'music_title', 'music_composer', 'music_lyric')->first();
        }else {
            $result = $this->videoRepository->getModel()::where('music_id', $arrUrl['id'])->select('cat_id', 'cat_level', 'cat_sublevel', 'cat_custom', 'music_title', 'music_composer', 'music_lyric')->first();
        }
        if(!$result)
            Helpers::ajaxResult(false, 'Không tìm thấy nội dung', null);
        Helpers::ajaxResult(true, '', $result->toArray());
    }


}