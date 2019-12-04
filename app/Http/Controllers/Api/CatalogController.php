<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8/17/2018
 * Time: 3:38 PM
 */
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request as Request;
use Illuminate\Support\Facades\Auth;
use App\Library\Helpers;
use App\Repositories\Category\CategoryEloquentRepository;
use App\Repositories\Music\MusicEloquentRepository;
use App\Repositories\Cover\CoverEloquentRepository;
use App\Repositories\Video\VideoEloquentRepository;
use App\Repositories\Playlist\PlaylistEloquentRepository;
use App\Http\Controllers\Controller;
use \Illuminate\Http\JsonResponse;

class CatalogController extends Controller
{
    protected $categoryRepository;
    protected $musicRepository;
    protected $videoRepository;
    protected $musicListenRepository;
    protected $coverRepository;
    protected $playlistRepository;

    public function __construct(CategoryEloquentRepository $categoryRepository, MusicEloquentRepository $musicRepository, CoverEloquentRepository $coverRepository, VideoEloquentRepository $videoRepository, PlaylistEloquentRepository $playlistRepository) {
        $this->categoryRepository = $categoryRepository;
        $this->musicRepository = $musicRepository;
        $this->videoRepository = $videoRepository;
        $this->coverRepository = $coverRepository;
        $this->playlistRepository = $playlistRepository;
    }
    public function playlistPublisher(Request $request, $url) {
        $catalog = config('constants.catalog');
        $result = $catalog[$url];
        if(!$result)
            return redirect()->guest('/');
        $caption = $result['caption'];
        $playlist = $this->playlistRepository->getByUser($result['user_id'])->toArray();
        foreach($playlist as $key => $item) {
            $artistArr = [];
            if($item['playlist_artist']) {
                $artistPlaylist = unserialize($item['playlist_artist']);
                $i = 0;
                foreach($artistPlaylist as $key2 => $itemArtist) {
                    $artistArr[] = [
                        'id' => $key2,
                        'name' => $itemArtist['name']
                    ];
                    if(++$i == 2)
                        break;
                }
            }
            $playlist[$key]['playlist_artist'] = $artistArr;
            $playlist[$key]['playlist_cover_url'] = $item['playlist_cover'] ? Helpers::file_path($item['playlist_id'], env('DATA_URL').MUSIC_PLAYLIST_PATH, true).$item['playlist_id'] . '.jpg' : '/imgs/avatar_default.png';
        }
        return new JsonResponse(['message' => 'Success', 'code' => 200, 'data' => ['caption' => $result['caption'], 'playlist' => Helpers::convertArrHtmlCharsDecode($playlist)], 'error' => []], 200);
    }
    public function musicNews(Request $request) {
        $music = $this->musicRepository->musicNewsSolr('music_id', 'desc', LIMIT_MUSIC_PAGE_CATEGORY);
        Helpers::convertArrSolr($music);
        return new JsonResponse(['message' => 'Success', 'code' => 200, 'data' => ['music' => $music], 'error' => []], 200);
    }
    public function videoNews(Request $request) {
        $video = $this->videoRepository->videoNewsSolr('video_id', 'desc', LIMIT_MUSIC_PAGE_CATEGORY);
        Helpers::convertArrSolr($video);
        foreach ($video['data'] as $key => &$item) {
            $item = Helpers::convertArrHtmlCharsDecode($item);
            $item['video_cover'] = Helpers::thumbnail_url(['music_id' => $item['video_id'], 'cat_id' => $item['video_cat_id']], 'preview');
        }
        return new JsonResponse(['message' => 'Success', 'code' => 200, 'data' => ['video' => $video], 'error' => []], 200);
    }
    public function albumNews(Request $request) {
        $cover = $this->coverRepository->coverNewSolr('cover_id', 'desc', LIMIT_MUSIC_PAGE_CATEGORY);
        Helpers::convertArrSolr($cover);
        return new JsonResponse(['message' => 'Success', 'code' => 200, 'data' => ['cover' => $cover], 'error' => []], 200);
    }
}