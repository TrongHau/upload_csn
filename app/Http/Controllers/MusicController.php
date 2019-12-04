<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8/21/2018
 * Time: 3:33 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\Helpers;
use App\Repositories\Music\MusicEloquentRepository;
use App\Repositories\Playlist\PlaylistEloquentRepository;
use App\Repositories\PlaylistPublisher\PlaylistPublisherEloquentRepository;
use App\Repositories\MusicListen\MusicListenEloquentRepository;
use App\Repositories\VideoListen\VideoListenEloquentRepository;
use App\Repositories\MusicDownload\MusicDownloadEloquentRepository;
use App\Repositories\VideoDownload\VideoDownloadEloquentRepository;
use App\Repositories\Video\VideoEloquentRepository;
use App\Repositories\Category\CategoryEloquentRepository;
use App\Repositories\Cover\CoverEloquentRepository;
use App\Repositories\Artist\ArtistRepository;
use App\Repositories\SearchResult\SearchResultEloquentRepository;
use App\Repositories\MusicFavourite\MusicFavouriteRepository;
use App\Repositories\VideoFavourite\VideoFavouriteRepository;
use App\Repositories\KaraokeSuggestion\KaraokeSuggestionEloquentRepository;
use App\Repositories\Upload\UploadEloquentRepository;
use App\Repositories\User\UserEloquentRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\PlaylistMusicModel;
use Jenssegers\Agent\Agent;
use App\Models\ErrorLogModel;
use App\Repositories\Karaoke\KaraokeEloquentRepository;
use App\Repositories\MusicDeleted\MusicDeletedEloquentRepository;
use App\Repositories\LyricSuggestion\LyricSuggestionEloquentRepository;
use App\Repositories\MusicSearchResult\MusicSearchResultEloquentRepository;
use Session;
use Response;
use DB;

class MusicController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
    protected $karaokeSuggestionRepository;
    protected $lyricSuggestionRepository;
    protected $musicSearchResultRepository;
    protected $musicDeletedRepository;
    protected $uploadRepository;
    protected $userRepository;

    public function __construct(MusicEloquentRepository $musicRepository, PlaylistEloquentRepository $playlistRepository, MusicListenEloquentRepository $musicListenRepository,
                                CategoryEloquentRepository $categoryListenRepository, CoverEloquentRepository $coverRepository, VideoEloquentRepository $videoRepository, ArtistRepository $artistRepository,
                                MusicFavouriteRepository $musicFavouriteRepository, VideoFavouriteRepository $videoFavouriteRepository, MusicDownloadEloquentRepository $musicDownloadRepository, KaraokeEloquentRepository $karaokeRepository,
                                VideoListenEloquentRepository $videoListenRepository, VideoDownloadEloquentRepository $videoDownloadRepository, PlaylistPublisherEloquentRepository $playlistPublisherRepository, SearchResultEloquentRepository $searchResultRepository,
                                KaraokeSuggestionEloquentRepository $karaokeSuggestionRepository, LyricSuggestionEloquentRepository $lyricSuggestionRepository, MusicSearchResultEloquentRepository $musicSearchResultRepository, MusicDeletedEloquentRepository $musicDeletedRepository,
                                UploadEloquentRepository $uploadRepository, UserEloquentRepository $userRepository)
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
        $this->karaokeSuggestionRepository = $karaokeSuggestionRepository;
        $this->lyricSuggestionRepository = $lyricSuggestionRepository;
        $this->karaokeRepository = $karaokeRepository;
        $this->searchResultRepository = $searchResultRepository;
        $this->musicSearchResultRepository = $musicSearchResultRepository;
        $this->musicDeletedRepository = $musicDeletedRepository;
        $this->uploadRepository = $uploadRepository;
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
    public function listenSingleMusic(Request $request, $cat, $sub, $musicUrl) {
        try {
            $arrUrl = Helpers::splitMusicUrl($musicUrl);
        } catch (Exception $e) {
            return view('errors.errors')->with('e');
        }
        if($cat == CAT_VIDEO_URL) {
            $music = $this->videoRepository->findOnlyMusicId($arrUrl['id']);
        }else{
            $music = $this->musicRepository->findOnlyMusicId($arrUrl['id']);
        }
        if(!$music) {
            return $this->musicRepository->checkDeleteMusic($arrUrl['id']);
        }
        if(!(isset($arrUrl['url'][0]) && isset($arrUrl['url'][1])) || ($music->music_title_url && ($arrUrl['url'][0] . ($arrUrl['url'][1] ? '~' .$arrUrl['url'][1] : '')) != $music->music_title_url)) {
            return redirect(Helpers::listen_url($music->toArray()));
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
        if(Auth::check()){
            $getModelFavourite = $this->musicFavouriteRepository;
            if($type == 'video')
                $getModelFavourite = $this->videoFavouriteRepository;
            $musicFavourite = $getModelFavourite->getModel()::where([['user_id', Auth::user()->id], ['music_id', $music->music_id]])->first();
        }
        global $MusicSameArtist;
        global $VideoSameArtist;
        global $titleDup;
        global $video;
        include(app_path() . '/../resources/views/cache/suggestion/'.ceil($music->music_id / 1000).'/'.$music->music_id.'.blade.php');
        return view('jwplayer.music', compact('music', 'musicSet', 'musicFavourite', 'MusicSameArtist', 'VideoSameArtist', 'titleDup', 'video'));
    }
    public function listenPlaylistMusic(Request $request, $musicUrl) {
        $arrUrl = Helpers::splitPlaylistUrl($musicUrl);
        $playlistMusic = [];
        $music = [];
        $playlist = [];
        $typeListen = 'single';
        $musicSet = [];
        if($arrUrl['type'] == 'nghe-album') {
            $album = $this->coverRepository->getCoverMusicById($arrUrl['id']);
            if(!$album)
                return view('errors.text_error')->with('message', 'Album không tìm thấy.');
            $typeListen = 'album';
            if($album->music) {
                $playlistMusic = $album->music->toArray();
            }
        }elseif($arrUrl['type'] == 'playlist'){
            $playlist = $this->playlistRepository->getMusicByPlaylistId($arrUrl['id']);
            if(!$playlist)
                return view('errors.404');
            $typeListen = 'playlist';
            if($playlist->music) {
                $playlistMusic = $playlist->music->toArray();
            }
            $playlist->playlist_cover = $playlist->playlist_cover ? Helpers::file_path($playlist->playlist_id, env('DATA_URL').MUSIC_PLAYLIST_PATH, true).$playlist->playlist_id . '.jpg' : env('APP_URL').'/imgs/no_cover.jpg';
        }elseif($arrUrl['type'] == 'playlist_publisher'){
            $playlist = $this->playlistPublisherRepository->getMusicByPlaylistId($arrUrl['id']);
            if(!$playlist)
                return view('errors.404');
            $typeListen = 'playlist';
            if(($playlist->music)) {
                $playlistMusic = $playlist->music->toArray();
            }
            $playlist->playlist_cover = $playlist->playlist_cover ? env('APP_URL').Helpers::file_path($playlist->playlist_id, env('DATA_URL').MUSIC_PLAYLIST_PATH, true).$playlist->playlist_id . '.jpg' : env('APP_URL').'/imgs/no_cover.jpg';
        }elseif($arrUrl['type'] == 'nghe-bat-hat-ca-si'){
            $arrUrl = Helpers::splitArtistUrl($musicUrl);
            $artist = $this->artistRepository->find($arrUrl['id']);
            if(!$artist)
                return view('errors.text_error')->with('message', 'Ca sĩ chưa được phát hành.');
            $musicSet['page'] = $request->trang ?? 1;
            $Agent = new Agent();
            $playlistMusic = $this->musicRepository->findMusicByArtist($artist->artist_id, $musicSet['page'],'music_last_update_time', 'desc', $Agent->isMobile() ? LIMIT_LISTEN_MUSIC_ARTIST_MOBILE : LIMIT_LISTEN_MUSIC_ARTIST);
            if(!$playlistMusic)
                return view('errors.text_error')->with('message', 'Ca sĩ chưa có bài hát nào phát hành.');
            $typeListen = 'playlist';
            $playlist = new \stdClass();
            $playlist->playlist_cover = $artist->artist_avatar ? env('APP_URL').Helpers::file_path($artist->artist_id, PUBLIC_COVER_ARTIST_PATH, true).$artist->artist_avatar : env('APP_URL').'/imgs/no_cover_artist2.jpg';
            $playlist->playlist_title = 'Tất cả bài hát ca sĩ '.$artist->artist_nickname;
        }
        elseif($arrUrl['type'] == 'nghe-bat-hat-yeu-thich'){
            $arrUrl = Helpers::splitArtistUrl($musicUrl);
            $type = last(explode('/', $request->path()));
            if(!Auth::check())
                return view('errors.text_error')->with('message', 'Bạn cần phải đăng nhập để hiển thị bài hát.');
            if($type == 'music') {
                $musicFavourite = $this->musicFavouriteRepository->getModel()::where('user_id', Auth::user()->id)->with('music')->orderBy('id', 'desc')->limit(LIMIT_LISTEN_MUSIC_FAVOURITE)->get();
            }else{
                $musicFavourite = $this->videoFavouriteRepository->getModel()::where('user_id', Auth::user()->id)->with('video')->orderBy('id', 'desc')->limit(LIMIT_LISTEN_MUSIC_FAVOURITE)->get();
            }
            if(!count($musicFavourite))
                return view('errors.text_error')->with('message', 'Bạn chưa có bài hát nào yêu thích');
            foreach ($musicFavourite->toArray() as $item) {
                $playlistMusic[] = $item[$type];
            }
            $typeListen = 'album';
        }
        if($playlistMusic) {
            $offsetPlaylist = intval($request->playlist ?? 1);
            $maxNumPlaylist = count($playlistMusic);
            if($offsetPlaylist > $maxNumPlaylist){
                return redirect(url()->current() . '?playlist=' . 1);
            }
            $offsetPl = $playlistMusic[$offsetPlaylist - 1];
            if($offsetPl['cat_id'] == CAT_VIDEO) {
                $music = $this->videoRepository->findOnlyMusicId($offsetPl['music_id']);
            }else{
                $music = $this->musicRepository->findOnlyMusicId($offsetPl['music_id']);
            }
            if(!$music) {
                $music = $this->musicRepository->checkDeleteMusic($music, false);
                if(!$music) {
                    if($offsetPlaylist >= $maxNumPlaylist) {
                        $offsetPlaylist = 1;
                    }else{
                        $offsetPlaylist ++;
                    }
                    return redirect(url()->current() . '?playlist=' . $offsetPlaylist);
                }
                $playlistMusic[$offsetPlaylist - 1] = $music->toArray();
            }
        }else{
            if(Auth::check() && backpack_user()->can('duyet_sua_nhac')){
                abort(403, '<a href="/dang-tai/album/'.$arrUrl['id'].'" style="font-size: 18px; display: block">Qua trang chỉnh sửa upload</a>Nhạc đang cập nhật.');
            }
            return view('errors.text_error')->with('message', 'Nội dung playlist không có.');
        }

        // +1 view
        if(Helpers::sessionCountTimesMusic($music->music_id)){
            if($music->cat_id == CAT_VIDEO) {
                $this->videoListenRepository->incrementListen($music->music_id);
            }else{
                $this->musicListenRepository->incrementListen($music->music_id);
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
//        // update search analytics
//        if(isset($request->ref) && isset($request->key_search)&& isset($request->type_search) && $request->ref == 'search') {
//            $this->searchResultRepository->createAnalytics($request->ref, $request->key_search, $music->music_id, $request->type_search);
//        }
        $musicSet = array_merge($musicSet, [
            'type_listen' => $typeListen, // single | playlist | album
            'type_jw' =>  $type,  // playlist | music | video
            'playlist_music' => $playlistMusic,
            'music_history' => $cookie,
            'playlist' => $playlist,
            'page' => 1
        ]);
        $musicFavourite = false;
        if(Auth::check()){
            $getModelFavourite = $this->musicFavouriteRepository;
            if($type == 'video')
                $getModelFavourite = $this->videoFavouriteRepository;
            $musicFavourite = $getModelFavourite->getModel()::where([['user_id', Auth::user()->id], ['music_id', $music->music_id]])->first();
        }
        global $MusicSameArtist;
        global $VideoSameArtist;
        global $titleDup;
        global $video;
        include(app_path() . '/../resources/views/cache/suggestion/'.ceil($music->music_id / 1000).'/'.$music->music_id.'.blade.php');
        return view('jwplayer.music', compact('music', 'musicSet', 'musicFavourite', 'MusicSameArtist', 'VideoSameArtist', 'titleDup', 'video'));
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
            return view('errors.text_error')->with('message', 'Danh mục không tìm thấy.');
        if($catUrl == CAT_VIDEO_URL) {
            // video (sub category videoclip)
            $type = 'video';
            $playlistMusic = $hot_video_rows[$category->cat_level];
        }else{
            // music (category music level 0)
            $playlistMusic = $hot_music_rows[$category->cat_id];
        }
        $offsetPlaylist = intval($request->playlist ?? 1);
        $maxNumPlaylist = count($playlistMusic);
        if($offsetPlaylist > $maxNumPlaylist) {
            return redirect(url()->current() . '?playlist=' . 1);
        }
        $firstMusic = $playlistMusic[$offsetPlaylist - 1];
        if($catUrl == CAT_VIDEO_URL) {
            $music = $this->videoRepository->findOnlyMusicId($firstMusic['music_id']);
        }else{
            $music = $this->musicRepository->findOnlyMusicId($firstMusic['music_id']);
        }
        if(!$music) {
            $music = $this->musicRepository->checkDeleteMusic($firstMusic['music_id'], false);
            if(!$music) {
                if($offsetPlaylist >= $maxNumPlaylist) {
                    $offsetPlaylist = 1;
                }else{
                    $offsetPlaylist ++;
                }
                return redirect(url()->current() . '?playlist=' . $offsetPlaylist);
            }
            $playlistMusic[$offsetPlaylist - 1] = $music->toArray();
        }
        // +1 view
        if(Helpers::sessionCountTimesMusic($music->music_id)){
            if($catUrl == CAT_VIDEO) {
                $this->videoListenRepository->incrementListen($music->music_id);
            }else{
                $this->musicListenRepository->incrementListen($music->music_id);
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
        if(Auth::check()){
            $getModelFavourite = $this->musicFavouriteRepository;
            if($type == 'video')
                $getModelFavourite = $this->videoFavouriteRepository;
            $musicFavourite = $getModelFavourite->getModel()::where([['user_id', Auth::user()->id], ['music_id', $music->music_id]])->first();
        }
        global $MusicSameArtist;
        global $VideoSameArtist;
        global $titleDup;
        global $video;
        include(app_path() . '/../resources/views/cache/suggestion/'.ceil($music->music_id / 1000).'/'.$music->music_id.'.blade.php');
        return view('jwplayer.music', compact('music', 'musicSet', 'musicFavourite', 'MusicSameArtist', 'VideoSameArtist', 'titleDup', 'video'));
    }
    public function embed(Request $request, $cat, $sub, $musicUrl) {
        try {
            $arrUrl = Helpers::splitMusicUrl($musicUrl);
        } catch (Exception $e) {
            return view('errors.errors')->with('e');
        }
        if($cat == CAT_VIDEO_URL) {
            $music = $this->videoRepository->findOnlyMusicId($arrUrl['id']);
        }else{
            $music = $this->musicRepository->findOnlyMusicId($arrUrl['id']);
        }
        if(!$music)
            return view('errors.404')->with('message', 'Nhạc đang cập nhật.');
        // +1 view
        if(Helpers::sessionCountTimesMusic($arrUrl['id'])){
            if($cat == CAT_VIDEO_URL) {
                $this->videoListenRepository->incrementListen($arrUrl['id']);
            }else{
                $this->musicListenRepository->incrementListen($arrUrl['id']);
            }
        }
        if(!$music)
            return view('errors.404');
        return view('jwplayer.embed_mp3', compact('music'));
    }
    public function historyListen(Request $request) {
        $result = [];
        $musics = [];
        $musicRecent = $_COOKIE['music_history'] ?? '';
        if(Auth::check()) {
            $musicRecent = Auth::user()->user_music_recent;
        }
        if($musicRecent) {
            $musicHistory = unserialize($musicRecent);
            $tempStr = implode(',', $musicHistory);
            $musics = $this->musicRepository->getHistoryRecents($tempStr);
            if($request->isMethod('post')) {
                foreach ($musics as $key => $item) {
                    $result[] = [
                        'title' => ++$key . '. ' . $item->music_title . ' - '. str_replace(';', ', ', $item->music_artist),
                        'link' => Helpers::listen_url([
                            'music_id'=> $item->music_id,
                            'cat_id' => $item->cat_id,
                            'cat_level' => $item->cat_level,
                            'music_title_url' => $item->music_title_url,
                        ])
                    ];
                }
            }else {

            }

        }
        if($request->isMethod('post'))
            return response($result);
        return view('catalog.history', compact('musics'));
    }
    function musicFavourite (Request $request) {
        $dataRes = null;
        if(!Auth::check())
            return 'Lỗi User';
        $typeMes = 'bài hát';
        $getModelFavourite = $this->musicFavouriteRepository;
        if($request->type_of == 'video') {
            $typeMes = 'video';
            $getModelFavourite = $this->videoFavouriteRepository;
        }
        if($request->type == 'true'){
            $msg = 'Đã bỏ '.$typeMes.' '.$request->name.' ra khỏi danh sách yêu thích.';
            $dataRes = [];
            $getModelFavourite->getModel()::where([['user_id', Auth::user()->id], ['music_id', $request->music_id]])->delete();
        }else{
            $msg = 'Đã thêm '.$typeMes.' '.$request->name.' vào danh sách yêu thích.';
            $getModelFavourite->create(['user_id' => Auth::user()->id, 'music_id' => $request->music_id]);
        }
        Helpers::ajaxResult(true, $msg, $dataRes);
    }
    public function countDownload(Request $request) {
        // +1 download
        if($request->music_id) {
            if(Helpers::sessionCountTimesMusic($request->music_id, 'download')){
                if($request->cat_id == CAT_VIDEO) {
                    $this->videoDownloadRepository->incrementDownload($request->music_id);
                }else{
                    $this->musicDownloadRepository->incrementDownload($request->music_id);
                }
            }
        }
        Helpers::ajaxResult(true, '', null);
    }
    public function suggestionLyric(Request $request) {

        if($request->cat_id == CAT_VIDEO_URL) {
            $music = $this->videoRepository->findOnlyMusicId($request->id);
        }else{
            $music = $this->musicRepository->findOnlyMusicId($request->id);
        }
        if(!$music) {
            Helpers::ajaxResult(false, 'Nhạc không tìm thấy', null);
        }
        if($request->submit == 'get') {
            Helpers::ajaxResult(true, '', ['lyric' => $music->music_lyric]);
        }else{
            if(!$request->lyric) {
                Helpers::ajaxResult(false, 'vui lòng nhập thông tin lyric', null);
            }
            if($request->submit == 'store') {
                if(!backpack_user()->can('duyet_sua_nhac')){
                    abort(403, 'Lỗi truy cập, tài khoản bạn không có chỉnh sửa lyric.');
                }
                $music->music_lyric = $request->lyric;
                $music->save();
                Helpers::ajaxResult(true, 'Sửa lyric thành công', ['lyric' => $music->music_lyric]);
            }else {
                $this->lyricSuggestionRepository->getModel()::where(['music_id' => $music->music_id, 'user_id' => Auth::user()->id])->delete();
                if($music->music_lyric == $request->lyric)
                    Helpers::ajaxResult(false, 'thông tin nhập không thay đổi', null);
                $this->lyricSuggestionRepository->create([
                    'music_id' => $music->music_id,
                    'music_title' => $music->music_title,
                    'music_artist' => $music->music_artist,
                    'music_time' => time(),
                    'music_length' => $music->music_length,
                    'music_lyric' => $request->lyric,
                    'user_id' => Auth::user()->id,
                ]);
                Helpers::ajaxResult(true, 'Gửi gợi ý lyric cho bài hát thành công', null);
            }

        }
    }
    public function suggestionKaraoke(Request $request) {

        if($request->cat_id == CAT_VIDEO_URL) {
            $music = $this->videoRepository->findOnlyMusicId($request->id);
        }else{
            $music = $this->musicRepository->findOnlyMusicId($request->id);
        }
        if(!$music) {
            Helpers::ajaxResult(false, 'Karaoke không tìm thấy', null);
        }
        if($request->submit == 'get') {
            Helpers::ajaxResult(true, '', ['lyric' => $music->musicKara->music_lyric_karaoke ?? '']);
        }else{
            if(!$request->karaoke) {
                Helpers::ajaxResult(false, 'Vui lòng nhập thông tin karaoke', null);
            }
            if($request->submit == 'store') {
                if(!backpack_user()->can('duyet_sua_karaoke')){
                    abort(403, 'Lỗi truy cập, tài khoản bạn không có chỉnh sửa karaoke.');
                }
                if(!$music->musicKara) {
                    $this->karaokeRepository->create([
                        'music_id' => $music->music_id,
                        'music_title' => $music->music_title,
                        'music_artist' => $music->music_artist,
                        'music_downloads_this_week' => $music->music_downloads_this_week,
                        'music_time' => time(),
                        'music_length' => $music->music_length,
                        'music_lyric_karaoke' => $request->karaoke,
                    ]);
                }else{
                    $music->musicKara->music_lyric_karaoke = $request->karaoke;
                    $music->musicKara->save();
                }
                Helpers::ajaxResult(true, 'Sửa lyric thành công', null);
            }else{
                if(!$request->karaoke) {
                    Helpers::ajaxResult(false, 'Vui lòng nhập thông tin karaoke', null);
                }
                $this->karaokeSuggestionRepository->getModel()::where(['music_id' => $music->music_id, 'user_id' => Auth::user()->id])->delete();
                if($music->musicKara)
                    if($music->musicKara->music_lyric_karaoke == $request->karaoke)
                        Helpers::ajaxResult(false, 'Thông tin nhập không thay đổi', null);
                $this->karaokeSuggestionRepository->create([
                    'music_id' => $music->music_id,
                    'music_title' => $music->music_title,
                    'music_artist' => $music->music_artist,
                    'music_downloads_this_week' => $music->music_downloads_this_week,
                    'music_time' => time(),
                    'music_length' => $music->music_length,
                    'music_lyric_karaoke' => $request->karaoke,
                    'user_id' => Auth::user()->id,
                ]);
                Helpers::ajaxResult(true, 'Gửi gợi ý karaoke cho bài hát thành công', null);
            }
        }
    }
    public function downloadAlbum(Request $request) {
        $memberVip = Helpers::checkMemberVip();
        if(!$memberVip) {
            Helpers::ajaxResult(false, 'Bạn chưa có quyền download tất cả nhạc album', null);
        }
        $arrUrl = Helpers::splitPlaylistUrl($request->album_url, $request->type);
        $playlistMusic = [];
        $music = [];
        $playlist = [];
        $typeListen = 'single';
        $musicDownload = [];
        if($arrUrl['type'] == 'album') {
            $album = $this->coverRepository->getCoverMusicById($arrUrl['id']);
            if(!$album)
                Helpers::ajaxResult(false, 'Album không tìm thấy.', null);
            $music = $album->musicDownload;
            if($music) {
                $playlistMusic = $music->toArray();
            }
        }elseif($arrUrl['type'] == 'playlist'){
            $playlist = $this->playlistRepository->getMusicByPlaylistId($arrUrl['id']);
            if(!$playlist)
                Helpers::ajaxResult(false, 'Playlist không tìm thấy.', null);
            $music = $playlist->musicDownload;
            if($music) {
                $playlistMusic = $music->toArray();
            }
        }
        foreach ($playlistMusic as $key => $item) {
            $item['music_file_cache'] = '';
            $musicDownload[] = last(Helpers::file_url($item));
        }
        $statusCode = 200;
        $content = view('javascript.download_album')->with('musicDownload', $musicDownload);
        $response = Response::make($content, $statusCode);
        $response->header('Content-Type', 'application/javascript');
        return $response;
    }
    public function mergeMusic(Request $request) {
        if(Auth::check() && backpack_user()->can('duyet_sua_nhac')){
            $music = $this->musicRepository->findOnlyMusicId($request->id);
            if(!$music)
                Helpers::ajaxResult(false, 'Nhạc không tồn tại.', null);
//            , ['music_deleted', '<=', 0]
            $musicSame = $this->musicRepository->getModel()::select('music_id', 'music_title_url', 'cat_id', 'cat_level', 'cover_id', 'music_title', 'music_artist', 'music_listen', 'music_downloads')->where([['music_title', $music->music_title], ['music_artist', $music->music_artist], ['music_id', '!=', $music->music_id], ['music_deleted', '<=', 0]])->get()->toArray();
            if(!$musicSame)
                Helpers::ajaxResult(false, 'Không có nhạc để nhập.', null);

            foreach ($musicSame as &$item) {
                $item['listen_url'] = Helpers::listen_url($item);
            }
            Helpers::ajaxResult(true, '', $musicSame);
        }
    }
    public function approveMusic(Request $request) {
        if(Auth::check() && backpack_user()->can('duyet_sua_nhac')){
            $idMusic = $request->id;
            $idMerge = $request->id_merge;
            $music = $this->musicRepository->getModel()::where([['music_id', $idMusic], ['music_deleted', '<=', 0]])->first();
            $musicListen = $this->musicListenRepository->getModel()::where('music_id', $idMusic)->first();
            $musicDownload = $this->musicDownloadRepository->getModel()::where('music_id', $idMusic)->first();
            $merge = $this->musicRepository->getModel()::where([['music_id', $idMerge], ['music_deleted', '<=', 0]])->first();
            $mergeListen = $this->musicListenRepository->getModel()::where('music_id', $idMusic)->first();
            $mergeDownload = $this->musicDownloadRepository->getModel()::where('music_id', $idMusic)->first();
            $url = '';
            if($idMusic > $idMerge) {
                //  Trường hợp ID1 > ID2
                $merge->music_listen = $merge->music_listen + $music->music_listen;
                $merge->music_downloads = $merge->music_downloads + $music->music_downloads;
                $mergeListen->music_listen = $mergeListen->music_listen + $musicListen->music_listen;
                $mergeListen->music_listen_today = $mergeListen->music_listen_today + $musicListen->music_listen_today;
                $mergeListen->music_downloads = $mergeListen->music_downloads + $mergeDownload->music_downloads;
                $mergeListen->music_downloads_today = $mergeListen->music_downloads_today + $mergeDownload->music_downloads_today;
                $merge->save();
                $music->music_deleted = $merge->music_id;
                $this->musicDeletedRepository->getModel()::create($music->toArray());
                $music->delete();
                $url = Helpers::listen_url($merge->toArray());
            }else{
                //  Trường hợp ID1 < ID2
                $music->music_listen = $music->music_listen + $merge->music_listen;
                $music->music_downloads = $music->music_downloads + $merge->music_downloads;
                $musicListen->music_listen = $musicListen->music_listen + $mergeListen->music_listen;
                $musicListen->music_listen_today = $musicListen->music_listen_today + $mergeListen->music_listen_today;
                $musicDownload->music_downloads = $mergeDownload->music_downloads + $mergeListen->music_downloads;
                $musicDownload->music_downloads_today = $mergeDownload->music_downloads_today + $mergeListen->music_downloads_today;
                $music->save();
                $merge->music_deleted = $music->music_id;
                $this->musicDeletedRepository->getModel()::create($merge->toArray());
                $merge->delete();
                $url = Helpers::listen_url($music->toArray());


            }
            Helpers::ajaxResult(true, 'Nhập bài hát thành công', ['url' => $url]);
        }
        Helpers::ajaxResult(false, 'Lỗi ngoài hệ thống nhập', null);
    }
    public function checkMusicBitrate(Request $request) {
        if($request->music_id) {
            $upload = $this->uploadRepository->findOnlyPublished($request->music_id);
            if($upload && $upload->music_bitrate_fixed_by > 0) {
                $user = $this->userRepository->findOnlyPublished($upload->music_bitrate_fixed_by)->first();
                Helpers::ajaxResult(true, '', ['user_bitrate_fixed' => $user->username]);
            }
        }
        Helpers::ajaxResult(false, '', []);
    }
}
