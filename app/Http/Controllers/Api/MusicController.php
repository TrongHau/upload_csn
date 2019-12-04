<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8/17/2018
 * Time: 3:38 PM
 */
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request as Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Music\MusicEloquentRepository;
use App\Library\Helpers;
use App\Solr\Solarium;
use Socialite;
use Session;
use App\Repositories\Category\CategoryEloquentRepository;
use \Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\Session as SessionModel;
use App\Http\Controllers\SearchController as SearchSolr;
use App\Repositories\Playlist\PlaylistEloquentRepository;
use App\Repositories\PlaylistPublisher\PlaylistPublisherEloquentRepository;
use App\Repositories\MusicListen\MusicListenEloquentRepository;
use App\Repositories\VideoListen\VideoListenEloquentRepository;
use App\Repositories\MusicDownload\MusicDownloadEloquentRepository;
use App\Repositories\VideoDownload\VideoDownloadEloquentRepository;
use App\Repositories\Video\VideoEloquentRepository;
use App\Repositories\Cover\CoverEloquentRepository;
use App\Repositories\Artist\ArtistRepository;
use App\Repositories\SearchResult\SearchResultEloquentRepository;
use App\Repositories\MusicFavourite\MusicFavouriteRepository;
use App\Repositories\VideoFavourite\VideoFavouriteRepository;
use App\Repositories\Karaoke\KaraokeEloquentRepository;
use App\Repositories\Session\SessionEloquentRepository;
use App\Http\Controllers\Sync\SolrSyncController;

class MusicController extends Controller
{
    protected $musicRepository;
    protected $videoRepository;
    protected $playlistRepository;
    protected $playlistPublisherRepository;
    protected $musicListenRepository;
    protected $musicDownloadRepository;
    protected $videoListenRepository;
    protected $videoDownloadRepository;
    protected $categoryListenRepository;
    protected $coverRepository;
    protected $artistRepository;
    protected $musicFavouriteRepository;
    protected $videoFavouriteRepository;
    protected $karaokeRepository;
    protected $searchResultRepository;
    protected $sessionRepository;
    protected $Solr;

    public function __construct(MusicEloquentRepository $musicRepository, PlaylistEloquentRepository $playlistRepository, MusicListenEloquentRepository $musicListenRepository,
                                CategoryEloquentRepository $categoryListenRepository, CoverEloquentRepository $coverRepository, VideoEloquentRepository $videoRepository, ArtistRepository $artistRepository,
                                MusicFavouriteRepository $musicFavouriteRepository, VideoFavouriteRepository $videoFavouriteRepository, MusicDownloadEloquentRepository $musicDownloadRepository, KaraokeEloquentRepository $karaokeRepository,
                                VideoListenEloquentRepository $videoListenRepository, VideoDownloadEloquentRepository $videoDownloadRepository, PlaylistPublisherEloquentRepository $playlistPublisherRepository, SearchResultEloquentRepository $searchResultRepository,
                                Solarium $Solr, SessionEloquentRepository $sessionRepository)
    {
        $this->musicRepository = $musicRepository;
        $this->videoRepository = $videoRepository;
        $this->playlistRepository = $playlistRepository;
        $this->playlistPublisherRepository = $playlistPublisherRepository;
        $this->musicListenRepository = $musicListenRepository;
        $this->musicDownloadRepository = $musicDownloadRepository;
        $this->videoListenRepository = $videoListenRepository;
        $this->videoDownloadRepository = $videoDownloadRepository;
        $this->categoryListenRepository = $categoryListenRepository;
        $this->coverRepository = $coverRepository;
        $this->artistRepository = $artistRepository;
        $this->musicFavouriteRepository = $musicFavouriteRepository;
        $this->videoFavouriteRepository = $videoFavouriteRepository;
        $this->karaokeRepository = $karaokeRepository;
        $this->searchResultRepository = $searchResultRepository;
        $this->sessionRepository = $sessionRepository;
        $this->Solr = $Solr;
    }

    public function getAlbumInfo(Request $request, $musicUrl) {
        $arrUrl = Helpers::splitPlaylistUrl($musicUrl);
        $album = $this->coverRepository->getCoverMusicById($arrUrl['id']);

        if(!$album)
            return new JsonResponse(['message' => 'Fail', 'code' => 400, 'data' => [], 'error' => 'không tìm thấy album'], 400);
        $playlistMusic = [];
        if(($album->music)) {
            $playlistMusic = $album->music->toArray();
        }
        if($playlistMusic) {
            $offsetPl = $playlistMusic[$request->playlist ? ($request->playlist > count($playlistMusic) ? count($playlistMusic) : $request->playlist) - 1 : 0];
            if($offsetPl['cat_id'] == CAT_VIDEO) {
                $music = $this->videoRepository->findOnlyMusicId($offsetPl['music_id']);
            }else{
                $music = $this->musicRepository->findOnlyMusicId($offsetPl['music_id']);
            }
        }else{
            return new JsonResponse(['message' => 'Fail', 'code' => 400, 'data' => [], 'error' => 'Nội dung playlist không có'], 400);
        }
        if(!$music)
            return new JsonResponse(['message' => 'Fail', 'code' => 400, 'data' => [], 'error' => 'Bài hát không tìm thấy'], 400);
        $music['file_url'] = Helpers::file_url($music);
        $musicFavourite = false;
        if($request->sid) {
            $userSess = $this->sessionRepository->getSessionById($request->sid);
            if($userSess) {
                $getModelFavourite = $this->musicFavouriteRepository;
                if($music->cat_id == CAT_VIDEO)
                    $getModelFavourite = $this->videoFavouriteRepository;
                $musicFavourite = $getModelFavourite->getModel()::where([['user_id', $userSess->user_id ?? null], ['music_id', $music->music_id]])->first();
            }
        }
        return new JsonResponse(['message' => 'Success', 'code' => 200, 'data' => ['music' => Helpers::convertArrHtmlCharsDecode($music->toArray()), 'playlist' => Helpers::convertArrHtmlCharsDecode($playlistMusic), 'musicFavourite' => $musicFavourite ? true : false], 'error' => []], 200);
    }
    public function getPlaylistInfo(Request $request, $musicUrl) {
        $arrUrl = Helpers::splitPlaylistUrl($musicUrl, 'playlist');
        $playlist = $this->playlistRepository->getMusicByPlaylistId($arrUrl['id']);
        if(!$playlist)
            return new JsonResponse(['message' => 'Fail', 'code' => 400, 'data' => [], 'error' => 'không tìm thấy playlist'], 400);
        $playlistMusic = [];
        if(($playlist->music)) {
            $playlistMusic = $playlist->music->toArray();
        }
        if($playlistMusic) {
            $offsetPl = $playlistMusic[$request->playlist ? ($request->playlist > count($playlistMusic) ? count($playlistMusic) : $request->playlist) - 1 : 0];
            if($offsetPl['cat_id'] == CAT_VIDEO) {
                $music = $this->videoRepository->findOnlyMusicId($offsetPl['music_id']);
            }else{
                $music = $this->musicRepository->findOnlyMusicId($offsetPl['music_id']);
            }
        }else{
            return new JsonResponse(['message' => 'Fail', 'code' => 400, 'data' => [], 'error' => 'Nội dung playlist không có'], 400);
        }
        if(!$music)
            return new JsonResponse(['message' => 'Fail', 'code' => 400, 'data' => [], 'error' => 'Bài hát không tìm thấy'], 400);
        $music['file_url'] = Helpers::file_url($music);
        $musicFavourite = false;
        if($request->sid) {
            $userSess = $this->sessionRepository->getSessionById($request->sid);
            if($userSess) {
                $getModelFavourite = $this->musicFavouriteRepository;
                if($music->cat_id == CAT_VIDEO)
                    $getModelFavourite = $this->videoFavouriteRepository;
                $musicFavourite = $getModelFavourite->getModel()::where([['user_id', $userSess->user_id], ['music_id', $music->music_id]])->first();
            }
        }
        return new JsonResponse(['message' => 'Success', 'code' => 200, 'data' => ['music' => Helpers::convertArrHtmlCharsDecode($music->toArray()), 'playlist' => Helpers::convertArrHtmlCharsDecode($playlistMusic), 'musicFavourite' => $musicFavourite ? true : false], 'error' => []], 200);
    }
    public function listenSingleMusic(Request $request, $cat, $sub, $musicUrl) {
        try {
            $arrUrl = Helpers::splitMusicUrl($musicUrl);
        } catch (Exception $e) {
            return new JsonResponse(['message' => 'Fail', 'code' => 400, 'data' => [], 'error' => 'url sai cú pháp'], 400);
        }
        if($cat == CAT_VIDEO_URL) {
            $music = $this->videoRepository->findOnlyMusicId($arrUrl['id']);
        }else{
            $music = $this->musicRepository->findOnlyMusicId($arrUrl['id']);
        }
        if(!$music) {
            $music = $this->musicRepository->checkDeleteMusic($arrUrl['id'], false);
        }
        // +1 view
        if(Helpers::sessionCountTimesMusic($arrUrl['id'])){
            if($cat == CAT_VIDEO_URL) {
                $this->videoListenRepository->incrementListen($arrUrl['id']);
            }else{
                $this->musicListenRepository->incrementListen($arrUrl['id']);
            }
            if($_COOKIE['search_search'] ?? '') {
                unset($_COOKIE['search_search']);
                $this->musicSearchResultRepository->createSearch($music);
            }
        }
        $type = 'music';
        if($music->cat_id == CAT_VIDEO)
            $type = 'video';
        // update cookie music history
        $cookie = Helpers::MusicCookie($request, $music);
        //update cache file suggestion
        $this->musicRepository->suggestion($music, $type);
        $musicSet = [
            'type_listen' => 'single', // single | playlist | album
            'type_jw' =>  $type,  // music | video
            'playlist_music' => [],
            'music_history' => $cookie
        ];
//        // update search analytics
//        if(isset($request->ref) && isset($request->key_search)&& isset($request->type_search) && $request->ref == 'search') {
//            $this->searchResultRepository->createAnalytics($request->ref, $request->key_search, $music->music_id, $request->type_search);
//        }
        $musicFavourite = false;
        if($request->sid) {
            $userSess = $this->sessionRepository->getSessionById($request->sid);
            if($userSess) {
                $getModelFavourite = $this->musicFavouriteRepository;
                if($type == 'video')
                    $getModelFavourite = $this->videoFavouriteRepository;
                $musicFavourite = $getModelFavourite->getModel()::where([['user_id', $userSess->user_id], ['music_id', $music->music_id]])->first();
            }

        }
        return new JsonResponse(['message' => 'Success', 'code' => 200, 'data' => ['music' => Helpers::convertArrHtmlCharsDecode($music->toArray()), 'musicSet' => $musicSet, 'musicFavourite' => $musicFavourite ? true : false], 'error' => []], 200);
    }
    public function listenBxhNow(Request $request, $catUrl, $catLevel = '') {
        return $this->listenBxhMusic($request, str_replace('.html', '', $catUrl), 'now', $catLevel);
    }
    public function listenBxhWeek(Request $request, $catUrl, $catLevel = '') {
        return $this->listenBxhMusic($request, str_replace('.html', '', $catUrl), 'week', $catLevel);
    }
    public function listenBxhMonth(Request $request, $month, $year, $catUrl, $catLevel = '') {
        return $this->listenBxhMusic($request, str_replace('.html', '', $catUrl), 'month', $catLevel, $month, $year);
    }
    public function listenBxhYear(Request $request, $year, $catUrl, $catLevel = '') {
        return $this->listenBxhMusic($request, str_replace('.html', '', $catUrl), 'year', $catLevel, 'all', $year);
    }
    public function listenBxhMusic($request, $catUrl, $typeBxh = 'now', $catLevel = '', $month = 0, $year = 0) {
        $id = $request->id;
        $type = 'music';
        $playlistMusic = [];
        // cache array
        global $hot_music_rows;
        global $hot_video_rows;
        $month = sprintf('%02d', $month);
        if($typeBxh == 'now') {
            include(app_path() . '/../resources/views/cache/bxh/bxh_today.blade.php');
        }elseif($typeBxh == 'week') {
            include(app_path() . '/../resources/views/cache/bxh/bxh_week.blade.php');
        }elseif($typeBxh == 'month') {
            include(app_path() . '/../resources/views/cache/bxh/bxh_'.$month.'_'.$year.'.blade.php');
        }elseif($typeBxh == 'year') {
            $month = 'all';
            include(app_path() . '/../resources/views/cache/bxh/bxh_'.$month.'_'.$year.'.blade.php');
        }
        $category = $this->categoryListenRepository->getCategoryUrl($catUrl == CAT_VIDEO_URL ? $catLevel : $catUrl);
        if(!$category)
            return new JsonResponse(['message' => 'Fail', 'code' => 400, 'data' => [], 'error' => 'Danh mục không tìm thấy'], 400);
        if($catUrl == CAT_VIDEO_URL) {
            // video (sub category videoclip)
            $type = 'video';
            $playlistMusic = $hot_video_rows[$category->cat_level];
        }else{
            // music (category music level 0)
            $playlistMusic = $hot_music_rows[$category->cat_id];
        }
        if(!$id) {
            $firstMusic = $playlistMusic[$request->playlist ? $request->playlist - 1 : 0];
            $id = $firstMusic['music_id'];
        }
        if($catUrl == CAT_VIDEO_URL) {
            $music = $this->videoRepository->findOnlyMusicId(Helpers::decodeID($id));
        }else{
            $music = $this->musicRepository->findOnlyMusicId(Helpers::decodeID($id));
        }
        if(!$music) {
            $music = $this->musicRepository->checkDeleteMusic($id, false);
        }
        // +1 view
        if(Helpers::sessionCountTimesMusic($id)){
            if($catUrl == CAT_VIDEO) {
                $this->videoListenRepository->incrementListen($id);
            }else{
                $this->musicListenRepository->incrementListen($id);
            }
        }
        // update cookie music history
        $cookie = Helpers::MusicCookie($request, $music);
        //update cache file suggestion
        $this->musicRepository->suggestion($music, $type);
        $musicSet = [
            'type_listen' => 'album', // single | playlist | album
            'type_jw' =>  $type,  // music | video
            'playlist_music' => $playlistMusic,
            'music_history' => $cookie
        ];
        $musicFavourite = false;
        if($request->sid) {
            $userSess = $this->sessionRepository->getSessionById($request->sid);
            if($userSess) {
                $getModelFavourite = $this->musicFavouriteRepository;
                if($type == 'video')
                    $getModelFavourite = $this->videoFavouriteRepository;
                $musicFavourite = $getModelFavourite->getModel()::where([['user_id',$userSess->user_id], ['music_id', $music->music_id]])->first();
            }

        }
        return new JsonResponse(['message' => 'Success', 'code' => 200, 'data' => ['musicFavourite' => $musicFavourite ? true : false, 'music' => Helpers::convertArrHtmlCharsDecode($music->toArray()), 'musicSet' => $musicSet], 'error' => []], 200);
    }
    function musicFavourite (Request $request) {
        if($request->sid) {
            $userSess = $this->sessionRepository->getSessionById($request->sid);
            if(!$userSess)
                return new JsonResponse(['message' => 'Fail', 'code' => 400, 'data' => [], 'error' => 'Lỗi User'], 400);
        }else {
            return new JsonResponse(['message' => 'Fail', 'code' => 400, 'data' => [], 'error' => 'Lỗi User'], 400);
        }
        $typeMes = 'bài hát';
        $getModelFavourite = $this->musicFavouriteRepository;
        if($request->type_of == 'video') {
            $typeMes = 'video';
            $getModelFavourite = $this->videoFavouriteRepository;
        }
        if($request->type == 'false'){
            $msg = 'Đã bỏ '.$typeMes.' '.$request->name.' ra khỏi danh sách yêu thích.';
            $getModelFavourite->getModel()::where([['user_id', $userSess->user_id], ['music_id', $request->music_id]])->delete();
        }else{
            $msg = 'Đã thêm '.$typeMes.' '.$request->name.' vào danh sách yêu thích.';
            $getModelFavourite->create(['user_id' => $userSess->user_id, 'music_id' => $request->music_id]);
        }
        return new JsonResponse(['message' => $msg, 'code' => 200, 'data' => [], 'error' => []], 200);
    }
}