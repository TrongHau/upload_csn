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
use App\Library\Helpers;
use App\Solr\Solarium;
use \Illuminate\Http\JsonResponse;
use App\Repositories\Artist\ArtistRepository;
use App\Models\ArtistModel;
use App\Repositories\Music\MusicEloquentRepository;
use App\Repositories\Video\VideoEloquentRepository;
use App\Repositories\Cover\CoverEloquentRepository;
use App\Repositories\Session\SessionEloquentRepository;
use App\Repositories\PlaylistPublisher\PlaylistPublisherEloquentRepository;
use App\Repositories\ArtistFavourite\ArtistFavouriteRepository;
//use App\Repositories\ArtistSearchResult\ArtistSearchResultEloquentRepository;

class ArtistController extends Controller
{
    protected $artistRepository;
    protected $musicRepository;
    protected $videoRepository;
    protected $coverRepository;
    protected $playlistPublisherRepository;
    protected $artistFavouriteRepository;
    protected $artistSearchResult;
    protected $sessionRepository;
    protected $Solr;

    public function __construct(ArtistRepository $artistRepository, MusicEloquentRepository $musicRepository, VideoEloquentRepository $videoRepository, CoverEloquentRepository $coverRepository,
                                PlaylistPublisherEloquentRepository $playlistPublisherRepository, ArtistFavouriteRepository $artistFavouriteRepository, Solarium $Solr, SessionEloquentRepository $sessionRepository) {
        $this->artistRepository = $artistRepository;
        $this->musicRepository = $musicRepository;
        $this->videoRepository = $videoRepository;
        $this->coverRepository = $coverRepository;
        $this->sessionRepository = $sessionRepository;
        $this->playlistPublisherRepository = $playlistPublisherRepository;
        $this->artistFavouriteRepository = $artistFavouriteRepository;
//        $this->artistSearchResult = $artistSearchResult;
        $this->Solr = $Solr;
    }

    public function getProfile(Request $request) {
        if(!$request->artist_id)
            return new JsonResponse(['message' => 'Fail', 'code' => 400, 'data' => [], 'error' => 'vui lòng nhập id của ca sĩ'], 400);
        $artist = $this->artistRepository->find($request->artist_id);
        if(!$artist)
            return new JsonResponse(['message' => 'Fail', 'code' => 400, 'data' => [], 'error' => 'không tìm thấy ca sĩ'], 400);
        $artist->artist_cover = env('APP_URL').($artist->artist_cover ? Helpers::file_path($artist->artist_id, PUBLIC_COVER_ARTIST_PATH, true).$artist->artist_cover : '/imgs/no_cover_artist.jpg');
        $music = $this->Solr->search(['music_artist_id' => $artist->artist_id], 1, LIMIT_MUSIC_PAGE_ARTIST, ['_version_' => 'desc']);
        Helpers::convertArrSolr($music);
        unset($music['status']);
        unset($music['message']);
        $artistFavourite = false;
        if($request->sid) {
            $userSess = $this->sessionRepository->getSessionById($request->sid);
            if($userSess)
                $artistFavourite = $this->artistFavouriteRepository->getModel()::where([['user_id',$userSess->user_id], ['artist_id', $artist->artist_id]])->first();
        }
        return new JsonResponse([
            'message' => 'Success',
            'code' => 200,
            'data' => [
                'profile' => $artist,
                'is_favourite' => $artistFavourite ? true : false,
                'list_music' => $music,
            ],
            'error' => []
        ], 200);
    }
    public function getTabArtist(Request $request) {
        if(!$request->artist_id)
            return new JsonResponse(['message' => 'Fail', 'code' => 400, 'data' => [], 'error' => 'vui lòng nhập id của ca sĩ'], 400);
        $data= [];
        switch ($request->tab) {
            case "music":
                $data = $this->Solr->search(['music_artist_id' => $request->artist_id], $request->page ?? 1, LIMIT_MUSIC_PAGE_ARTIST, ['_version_' => 'desc']);
                break;
            case "video":
                $data = $this->Solr->search(['video_artist_id' => $request->artist_id], $request->page ?? 1, LIMIT_MUSIC_PAGE_ARTIST, ['_version_' => 'desc']);
                break;
            case "album":
                $data = $this->Solr->search(['album_music_artist_id' => $request->artist_id], $request->page ?? 1, LIMIT_MUSIC_PAGE_ARTIST, ['_version_' => 'desc']);
                break;
            case "playlist":
                $data = $this->playlistPublisherRepository->getPlaylistPageByArtist($request->artist_id, 'playlist_artist_id', 'desc', LIMIT_MUSIC_PAGE_ARTIST);
                break;
            default:
                $data = $this->Solr->search(['music_artist_id' => $request->artist_id], $request->page ?? 1, LIMIT_MUSIC_PAGE_ARTIST, ['_version_' => 'desc']);
                $request->tab = 'music';
        }
        Helpers::convertArrSolr($data);
        unset($data['status']);
        unset($data['message']);
        return new JsonResponse([
            'message' => 'Success',
            'code' => 200,
            'data' => [
                'data' => $data,
                'tab' => $request->tab,
            ],
            'error' => []
        ], 200);
    }
    public function favourite(Request $request) {
        if(!$request->artist_id || !$request->sid)
            return new JsonResponse(['message' => 'Fail', 'code' => 400, 'data' => [], 'error' => 'vui lòng nhập id của ca sĩ và sid'], 400);
        $userSess = $this->sessionRepository->getSessionById($request->sid);
        if(!$userSess)
            return new JsonResponse(['message' => 'Fail', 'code' => 400, 'data' => [], 'error' => 'chưa đăng nhập, sid không tồn tại'], 400);
        $artist = $this->artistRepository->find($request->artist_id);
        if(!$artist)
            return new JsonResponse(['message' => 'Fail', 'code' => 400, 'data' => [], 'error' => 'không tìm thấy ca sĩ'], 400);
        if($request->is_favourite == 'true'){
            $msg = 'Đã thêm ca sĩ '.$artist->artist_nickname.' vào danh sách yêu thích.';
            $this->artistFavouriteRepository->getModel()::firstOrCreate(['user_id' => $userSess->user_id, 'artist_id' => $artist->artist_id]);
        }else{
            $msg = 'Đã bỏ ca sĩ '.$artist->artist_nickname.' ra khỏi danh sách yêu thích.';
            $this->artistFavouriteRepository->getModel()::where([['user_id', $userSess->user_id], ['artist_id', $artist->artist_id]])->delete();
        }
        return new JsonResponse(['message' => $msg, 'code' => 200, 'data' => [], 'error' => ''], 200);
    }
    public function listMusic(Request $request) {
        if(!$request->artist_id)
            return new JsonResponse(['message' => 'Fail', 'code' => 400, 'data' => [], 'error' => 'vui lòng nhập id của ca sĩ'], 400);

        $artist = $this->artistRepository->find($request->artist_id);
        if(!$artist)
            return new JsonResponse(['message' => 'Fail', 'code' => 400, 'data' => [], 'error' => 'không tìm thấy ca sĩ'], 400);
        $playlistMusic = $this->musicRepository->findMusicByArtist($artist->artist_id, $request->trang ?? 1,'music_last_update_time', 'desc', LIMIT_LISTEN_MUSIC_ARTIST);
        if(!$playlistMusic)
            return new JsonResponse(['message' => 'Fail', 'code' => 400, 'data' => [], 'error' => 'Ca sĩ chưa có bài hát nào phát hành.'], 400);
        return new JsonResponse(['message' => 'Success', 'code' => 200, 'data' => Helpers::convertArrHtmlCharsDecode($playlistMusic), 'error' => ''], 200);
    }

}