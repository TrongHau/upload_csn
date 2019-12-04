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
use App\Repositories\PlaylistCategory\PlaylistCategoryEloquentRepository;
use App\Repositories\PlaylistMusic\PlaylistMusicEloquentRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\PlaylistMusicModel;
use App\Models\PlaylistModel;
use Illuminate\Support\Facades\Storage;

class PlaylistController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $playlistRepository;
    protected $playlistCategoryRepository;
    protected $playlistMusicRepository;

    public function __construct(PlaylistEloquentRepository $playlistRepository, PlaylistCategoryEloquentRepository $playlistCategoryRepository,
                                PlaylistMusicEloquentRepository $playlistMusicRepository)
    {
        $this->playlistRepository = $playlistRepository;
        $this->playlistCategoryRepository = $playlistCategoryRepository;
        $this->playlistMusicRepository = $playlistMusicRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPlayList(Request $request) {
        if(!Auth::check()){
            Helpers::ajaxResult(false, 'Bạn chưa đang nhập.', null);
        }
        $result = $this->playlistRepository->getByUser(Auth::user()->id);
        foreach ($result as &$item) {
            $item->music_exists = $item->findExistsMusic($request->music_id);
        }
        return Helpers::ajaxResult(true, '', $result);
    }
    public function createPlayList(Request $request) {
        if(!Auth::check()){
            Helpers::ajaxResult(false, 'Bạn chưa đang nhập.', null);
        }
        // check banned user
        if(backpack_user()->can('banned_user_playlist')){
            abort(403, 'Lỗi truy cập, tài khoản bạn bị khóa chức năng tạo playlist.');
        }
        if(!$request->input('playlist_title')){
            Helpers::ajaxResult(false, 'Bạn chưa nhập tên playlist mới.', null);
        }
        if(strlen($request->input('playlist_title')) <= 1 || strlen($request->input('playlist_title')) > 100){
            Helpers::ajaxResult(false, 'Tên playlist mới ít nhất 2 và nhỏ hơn 100 ký tư.', null);
        }
        $result = $this->playlistRepository->create([
            'user_id' => Auth::user()->id,
            'playlist_time' => time(),
            'playlist_music_total' => 0,
            'playlist_status' => 1,
            'playlist_title' => $request->input('playlist_title')
        ]);
        Helpers::ajaxResult(true, 'Đã tạo playlist.', $result);
    }
    public function addMusicPlayList(Request $request) {
        if(!Auth::check()){
            Helpers::ajaxResult(false, 'Bạn chưa đang nhập.', null);
        }
        // check banned user
        if(backpack_user()->can('banned_user_playlist')){
            abort(403, 'Lỗi truy cập, tài khoản bạn bị khóa chức năng thêm nhạc vào playlist.');
        }

        $playlistUser = $this->playlistRepository->getByUser(Auth::user()->id, $request->input('playlist_id'))->first();
        if(!$playlistUser) {
            Helpers::ajaxResult(false, 'Không tìm thấy playlist của bạn', null);
        }
        $countUpdate = 1;
        $dataResult = null;
        $mess = 'Đã thêm vào playlist.';
        $exist = PlaylistMusicModel::where([['playlist_id', $request->input('playlist_id')], ['music_id', $request->input('music_id')]]);
        if($exist->exists()) {
            $exist->delete();
            $countUpdate = -1;
            $dataResult = ['remove' => true];
            $mess = 'Đã xóa bài hát khỏi playlist.';
        }else{
            $countPlaylist = PlaylistMusicModel::where(['playlist_id' => $request->input('playlist_id')])->count();
            if($countPlaylist > LIMIT_ADD_PLAYLIST) {
                Helpers::ajaxResult(false, 'Playlist của bạn đã đạt quá 100 bài hát', null);
            }
            $result = PlaylistMusicModel::firstOrCreate([
                'playlist_id' => $request->input('playlist_id'),
                'music_id' => $request->input('music_id')
            ]);
        }
        $playlistUser->playlist_time = time();
        $playlistUser->playlist_music_total = $playlistUser->playlist_music_total + $countUpdate;
        // add and sort artist
        if($request->input('artist')) {
            $artistNew = explode(';', htmlspecialchars_decode($request->input('artist'), ENT_QUOTES));
            if(!$request->input('artist_id')) {
                $artistIdNew = urlencode(htmlspecialchars_decode($request->input('artist'), ENT_QUOTES));
                $artistIdNew = explode('%3B+', $artistIdNew);
            }else{
                $artistIdNew = explode(';', htmlspecialchars_decode($request->input('artist_id'), ENT_QUOTES));
            }
            $artistOld = [];
            $arrNew = [];
            if($playlistUser->playlist_artist) {
                $artistOld = unserialize(htmlspecialchars_decode($playlistUser->playlist_artist, ENT_QUOTES));
                foreach($artistNew as $key => $val) {
                    $keyExits = $artistIdNew[$key] == -1 ? urlencode($val): $artistIdNew[$key];
                    if(isset($artistOld[$keyExits])) {
                        // +1 duplicate
                        $artistOld[$keyExits]['order'] = $artistOld[$keyExits]['order'] + 1;
                    }else{
                        // add new artist
                        $artistOld[$keyExits] = [
                            'order' => 0,
                            'name' => $val
                        ];
                    }
                }
                arsort($artistOld);
            }else {
                foreach ($artistNew as $key => $val) {
                    $artistOld[$artistIdNew[$key] == -1 ? urlencode($val): $artistIdNew[$key]] = [
                        'order' => 0,
                        'name' => $val
                    ];
                }
            }
            $playlistUser->playlist_artist = serialize($artistOld);
        }
        $playlistUser->save();
        Helpers::ajaxResult(true, $mess, $dataResult);
    }
    public function editPlaylist(Request $request, $id) {
//        $playlistUser = $this->playlistRepository->getByUser(Auth::user()->id, $id)->with('playlist_arr_ids')->first();
        $playlistUser = $this->playlistRepository->getByUser(Auth::user()->id, $id)->with('music')->first();
        if(!$playlistUser) {
            return view('errors.404');
        }
//        $listMusicVideo = $this->playlistRepository->getMusicVideo(array_column($playlistUser->playlist_arr_ids->toArray(), 'music_id'));
        $listMusicVideo = $playlistUser->music;
        $playlistLevel = $this->playlistCategoryRepository->getList();
        $playlistCategory = $this->playlistCategoryRepository->getCategory();
        return view('user.playlist.create_update_playlist', compact('playlistUser', 'playlistLevel', 'playlistCategory', 'listMusicVideo'));
    }
    public function editPagePlaylist(Request $request) {
        $playlistUser = $this->playlistRepository->getByUser(Auth::user()->id);
        return view('user.playlist.edit_playlist', compact('playlistUser'));
    }
    public function storePlaylist(Request $request) {
        $this->validate($request, [
            'playlist_title' => 'required|max:255|min:2',
            'sumbit_action' => 'required'
        ]);
        // check banned user
        if(backpack_user()->can('banned_user_playlist')){
            abort(403, 'Lỗi truy cập, tài khoản bạn bị khóa chức năng chỉnh sửa playlist.');
        }
        $id = $request->input('playlist_id');
        $action = $request->input('sumbit_action');
        $playlistData = [];
        if($action == 'edit') {
            $playlist = PlaylistModel::where([['playlist_id', $id], ['user_id', Auth::user()->id]]);
            $playlistData = $playlist->first();
            if(!$playlist->exists()) {
                return view('errors.404');
            }
        }else{
            $playlist = new PlaylistModel();
        }
        $update = [
            'playlist_title' => $request->input('playlist_title'),
            'playlist_cat_id' => $request->input('playlist_cat_id') ?? 0,
            'playlist_cat_level' => $request->input('playlist_cat_level') ?? 0,
            'user_id' => Auth::user()->id,
            'playlist_time' => time()
        ];
        // remove music, update count
        if($request->input('remove_music')) {
            $arrMusic = explode(',', substr($request->input('remove_music'), 1));
            $countRemove = PlaylistMusicModel::where('playlist_id', $id)->whereIn('music_id', $arrMusic)->delete();
            $update['playlist_music_total'] = $playlist->first()->playlist_music_total - $countRemove;
            $removeArtist = str_replace(';', ',', substr($request->input('remove_artist'), 1));
            $removeArtistId = str_replace(';', ',', substr($request->input('remove_artist_id'), 1));
            $artistRemove = explode(',', $removeArtist);
            $artistIdRemove = explode(',', $removeArtistId);
            $artistOld = unserialize($playlistData->playlist_artist);
            foreach ($artistIdRemove as $key => $val) {
                $keyExits = $val == -1 ? urlencode($artistRemove[$key]): $val;
                if(isset($artistOld[$keyExits])) {
                    if($artistOld[$keyExits]['order'] == 0){
                        unset($artistOld[$keyExits]);
                    }else{
                        $artistOld[$keyExits]['order'] = $artistOld[$keyExits]['order'] - 1;
                    }
                }
            }
            arsort($artistOld);
            $update['playlist_artist'] = serialize($artistOld);

        }
        if($request->input('order_music')) {
            $arrMusic = explode(',', substr($request->input('order_music'), 1));
            foreach ($arrMusic as $key => $item) {
                $this->playlistMusicRepository->getModel()::where('music_id', $item)->update(['playlist_order' => $key]);
            }
        }
        if($request->input('playlist_cover'))
            $update['playlist_cover'] = SET_ACTIVE;
        if($action == 'edit') {
            $result = $playlist->update($update);
            $mes = 'Đã Cập nhập playlist.';
            $imgPlaylist = '';
            // update cover
            if($request->input('playlist_cover')) {
                $fileNameCover = Helpers::saveBase64ImageJpg($request->input('playlist_cover'), Helpers::file_path($id, MUSIC_PLAYLIST_PATH, true), $id);
                $imgPlaylist = Helpers::file_path($id, PUBLIC_MUSIC_PLAYLIST_PATH, true). $fileNameCover;
            }
            return redirect()->route('playlist.update_playlist', $id)->with(['success' => $mes, 'imgPlaylist' => $imgPlaylist]);
        }else{
            $update['playlist_status'] = SET_ACTIVE;

            $result = $playlist->create($update);
            $mes = 'Đã tạo playlist '.$result->playlist_title;
            // update cover
            if($request->input('playlist_cover')) {
                $fileNameCover = Helpers::saveBase64ImageJpg($request->input('playlist_cover'), Helpers::file_path($result->playlist_id, MUSIC_PLAYLIST_PATH, true), $result->playlist_id);
            }
            return redirect('/user/playlist/chinh-sua')->with('success', $mes);
        }
    }
    public function deletePlaylist(Request $request) {
        if(!Auth::check()){
            return response()->json([
                'status' => false,
                'message' => 'Bạn chưa đăng nhập',
            ]);
        }
        // check banned user
        if(backpack_user()->can('banned_user_playlist')){
            abort(403, 'Lỗi truy cập, tài khoản bạn bị khóa chức năng xóa playlist.');
        }
        $playlist = PlaylistModel::whereIn('playlist_id', $request->input('playlis_ids'))->where('user_id', Auth::user()->id);
        if(!$playlist->exists()) {
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy playlist',
            ]);
        }
        foreach($playlist->get() as $item) {
            if($item->playlist_cover)
                Storage::delete('public' . Helpers::file_path($item->playlist_id, MUSIC_PLAYLIST_PATH, true) . $item->playlist_id.'.jpg');
        }
        $playlist->delete();
        return response()->json([
            'status' => true,
            'message' => 'Đã xóa playlist thành công',
        ]);
    }
    public function createPagePlaylist(Request $request) {
        $playlistUser = [];
        $playlistmusic = [];
        $playlistLevel = $this->playlistCategoryRepository->getList();
        $playlistCategory = $this->playlistCategoryRepository->getCategory();
        return view('user.playlist.create_update_playlist', compact('playlistUser', 'playlistmusic', 'playlistLevel', 'playlistCategory'));
    }
}
