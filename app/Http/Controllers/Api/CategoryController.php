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
use App\Http\Controllers\Controller;
use \Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    protected $categoryRepository;
    protected $musicRepository;
    protected $videoRepository;
    protected $musicListenRepository;
    protected $coverRepository;

    public function __construct(CategoryEloquentRepository $categoryRepository, MusicEloquentRepository $musicRepository, CoverEloquentRepository $coverRepository, VideoEloquentRepository $videoRepository) {
        $this->categoryRepository = $categoryRepository;
        $this->musicRepository = $musicRepository;
        $this->videoRepository = $videoRepository;
        $this->coverRepository = $coverRepository;
    }
    public function getTabCategory(Request $request) {
        switch ($request->tab) {
            case "album-" . CURRENT_YEAR:
                $cover = $this->coverRepository->getCategoryCoverSolr($request->cat_id, $request->cat_level, ['csn_cover.music_year', CURRENT_YEAR], MAX_LOSTLESS, 'cover_id', 'desc', LIMIT_PAGE_CATEGORY);
                Helpers::convertArrSolr($cover);
                return new JsonResponse(['message' => 'Success', 'code' => 200, 'data' => ['cover' => $cover], 'error' => []], 200);
                break;
            case "album-2018":
                $cover = $this->coverRepository->getCategoryCoverSolr($request->cat_id, $request->cat_level, ['csn_cover.music_year', 2018], MAX_LOSTLESS, 'cover_id', 'desc', LIMIT_PAGE_CATEGORY);
                Helpers::convertArrSolr($cover);
                return new JsonResponse(['message' => 'Success', 'code' => 200, 'data' => ['cover' => $cover], 'error' => []], 200);
                break;
            case "album-moi":
                $cover = $this->coverRepository->getCategoryCoverSolr($request->cat_id, $request->cat_level, null, null, 'cover_id', 'desc', LIMIT_PAGE_CATEGORY);
                Helpers::convertArrSolr($cover);
                return new JsonResponse(['message' => 'Success', 'code' => 200, 'data' => ['cover' => $cover], 'error' => []], 200);
                break;
            case "bai-hat-moi":
                $music = $this->musicRepository->getCategoryMusicSolr($request->cat_id, $request->cat_level, 'music_id', 'desc', LIMIT_MUSIC_PAGE_CATEGORY);
                Helpers::convertArrSolr($music);
                return new JsonResponse(['message' => 'Success', 'code' => 200, 'data' => ['music' => $music], 'error' => []], 200);
                break;
            case "video-".CURRENT_YEAR:
                $video = $this->videoRepository->getCategoryVideoSolr($request->cat_id, $request->cat_level, ['csn_video.music_year', CURRENT_YEAR], 'video_id', 'desc', LIMIT_PAGE_CATEGORY);
                Helpers::convertArrSolr($video);
                return new JsonResponse(['message' => 'Success', 'code' => 200, 'data' => ['video' => $video], 'error' => []], 200);
                break;
            case "video-2018":
                $video = $this->videoRepository->getCategoryVideoSolr($request->cat_id, $request->cat_level, ['csn_video.music_year', 2018], 'video_id', 'desc', LIMIT_PAGE_CATEGORY);
                Helpers::convertArrSolr($video);
                return new JsonResponse(['message' => 'Success', 'code' => 200, 'data' => ['video' => $video], 'error' => []], 200);
                break;
            case "video-moi":
                $video = $this->videoRepository->getCategoryVideoSolr($request->cat_id, $request->cat_level, null, 'video_id', 'desc', LIMIT_PAGE_CATEGORY);
                Helpers::convertArrSolr($video);
                return new JsonResponse(['message' => 'Success', 'code' => 200, 'data' => ['video' => $video], 'error' => []], 200);
                break;
            case "video-vua-download":
                $video = $this->videoRepository->getCategoryVideoSolr($request->cat_id, $request->cat_level, null,'video_id', 'desc', LIMIT_PAGE_CATEGORY);
                Helpers::convertArrSolr($video);
                return new JsonResponse(['message' => 'Success', 'code' => 200, 'data' => ['video' => $video], 'error' => []], 200);
                break;
            case "vua-download":
                $music = $this->musicRepository->getCategoryMusicSolr($request->cat_id, $request->cat_level, 'music_download_time', 'desc', LIMIT_MUSIC_PAGE_CATEGORY);
                return new JsonResponse(['message' => 'Success', 'code' => 200, 'data' => ['music' => $music], 'error' => []], 200);
                break;
            case "music":
                $music = $this->musicRepository->musicNewsSolr('music_id', 'desc', LIMIT_MUSIC_PAGE_CATEGORY);
                Helpers::convertArrSolr($music);
                return new JsonResponse(['message' => 'Success', 'code' => 200, 'data' => ['music' => $music], 'error' => []], 200);
                break;
            case "video":
                $video = $this->videoRepository->videoNewsSolr('video_id', 'desc', LIMIT_MUSIC_PAGE_CATEGORY);
                Helpers::convertArrSolr($video);
                return new JsonResponse(['message' => 'Success', 'code' => 200, 'data' => ['video' => $video], 'error' => []], 200);
                break;
            case "cover":
                $cover = $this->coverRepository->coverNewSolr('cover_id', 'desc', LIMIT_MUSIC_PAGE_CATEGORY);
                Helpers::convertArrSolr($cover);
                return new JsonResponse(['message' => 'Success', 'code' => 200, 'data' => ['cover' => $cover], 'error' => []], 200);
                break;
            default:
                $cover = $this->coverRepository->getCategoryCoverSolr($request->cat_id, $request->cat_level, ['csn_cover.music_year', CURRENT_YEAR], MAX_LOSTLESS, 'cover_id', 'desc', LIMIT_PAGE_CATEGORY);
                Helpers::convertArrSolr($cover);
                return new JsonResponse(['message' => 'Success', 'code' => 200, 'data' => ['cover' => $cover], 'error' => []], 200);
                break;
        }
    }

}