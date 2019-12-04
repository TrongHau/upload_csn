<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8/17/2018
 * Time: 3:38 PM
 */
namespace App\Http\Controllers;
use Illuminate\Http\Request as Request;
use Illuminate\Support\Facades\Auth;
use App\Library\Helpers;
use App\Repositories\Category\CategoryEloquentRepository;
use App\Repositories\Music\MusicEloquentRepository;
use App\Repositories\Cover\CoverEloquentRepository;
use App\Repositories\Video\VideoEloquentRepository;

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
    public function index1(Request $request, $sub) {
        $category = $this->categoryRepository->getCategoryParentByUrl($sub);
        $_GET['page'] = 1;
        if(isset($request->tab) && ($request->tab == 'album-'.CURRENT_YEAR || $request->tab == 'video-'.CURRENT_YEAR)) {
            $_GET['page'] = $request->page;
        }
        if(!$category)
            return redirect()->guest('/');
        if($category->cat_id != CATEGORY_ID_VIDEO) {
            $cover = $this->coverRepository->getCategoryCoverSolr($category->cat_id, $category->cat_level, ['csn_cover.music_year', CURRENT_YEAR], MAX_LOSTLESS, 'cover_id', 'desc', LIMIT_PAGE_CATEGORY);
            $firstTab = view('category_solr.cover_item', compact('cover'));
        }else{
            $video = $this->videoRepository->getCategoryVideo($category->cat_id, $category->cat_level, ['csn_video.music_year', CURRENT_YEAR], 'music_time', 'desc', LIMIT_PAGE_CATEGORY);
            $firstTab = view('category.video_item', compact('video'));
        }
        $caption = $category->cat_title;
        return view('category.index', compact('category', 'firstTab', 'caption'));
    }
    public function index2(Request $request, $cat, $sub) {
        $category = $this->categoryRepository->getCategoryParentByUrl($cat);
        $title = $category->cat_title;
        $category = $this->categoryRepository->getCategorySub($category->cat_id, $sub);
        if(!$category)
            return view('errors.404');
        if($category->cat_id != CATEGORY_ID_VIDEO) {
            $cover = $this->coverRepository->getCategoryCoverSolr($category->cat_id, $category->cat_level, ['csn_cover.music_year', CURRENT_YEAR], MAX_LOSTLESS, 'cover_id', 'desc', LIMIT_PAGE_CATEGORY);
            $firstTab = view('category_solr.cover_item', compact('cover'));
            $caption = $title .' > '. str_replace('Nhạc', '', $category->cat_title);
            $caption = str_replace('Playback', ' ', $caption);
        }else {
            $video = $this->videoRepository->getCategoryVideo($category->cat_id, $category->cat_level, ['csn_video.music_year', CURRENT_YEAR], 'music_time', 'desc', LIMIT_PAGE_CATEGORY);
            $firstTab = view('category.video_item', compact('video'));
            $caption = $title .' > '. str_replace('Video', ' ', $category->cat_title);
        }
        if(!$category)
            return view('errors.404');
        return view('category.index', compact('category', 'firstTab', 'caption'));
    }
    public function getTabCategory(Request $request) {
        switch ($request->tab) {
            case "album-" . CURRENT_YEAR:
                $cover = $this->coverRepository->getCategoryCoverSolr($request->cat_id, $request->cat_level, ['csn_cover.music_year', CURRENT_YEAR], MAX_LOSTLESS, 'cover_id', 'desc', LIMIT_PAGE_CATEGORY);
                return view('category_solr.cover_item', compact('cover'));
                break;
            case "album-2018":
                $cover = $this->coverRepository->getCategoryCoverSolr($request->cat_id, $request->cat_level, ['csn_cover.music_year', 2018], MAX_LOSTLESS, 'cover_id', 'desc', LIMIT_PAGE_CATEGORY);
                return view('category_solr.cover_item', compact('cover'));
                break;
            case "album-moi":
                $cover = $this->coverRepository->getCategoryCoverSolr($request->cat_id, $request->cat_level, null, null, 'cover_id', 'desc', LIMIT_PAGE_CATEGORY);
                return view('category_solr.cover_item', compact('cover'));
                break;
            case "bai-hat-moi":
                $music = $this->musicRepository->getCategoryMusicSolr($request->cat_id, $request->cat_level, 'music_id', 'desc', LIMIT_MUSIC_PAGE_CATEGORY);
                return view('category_solr.music_item', compact('music'));
                break;
            case "video-".CURRENT_YEAR:
                $video = $this->videoRepository->getCategoryVideoSolr($request->cat_id, $request->cat_level, ['csn_video.music_year', CURRENT_YEAR], 'video_id', 'desc', LIMIT_PAGE_CATEGORY);
                return view('category_solr.video_item', compact('video'));
                break;
            case "video-2018":
                $video = $this->videoRepository->getCategoryVideoSolr($request->cat_id, $request->cat_level, ['csn_video.music_year', 2018], 'video_id', 'desc', LIMIT_PAGE_CATEGORY);
                return view('category_solr.video_item', compact('video'));
                break;
            case "video-moi":
                $video = $this->videoRepository->getCategoryVideoSolr($request->cat_id, $request->cat_level, null, 'video_id', 'desc', LIMIT_PAGE_CATEGORY);
                return view('category_solr.video_item', compact('video'));
                break;
            case "video-vua-download":
                $video = $this->videoRepository->getCategoryVideoSolr($request->cat_id, $request->cat_level, null,'video_id', 'desc', LIMIT_PAGE_CATEGORY);
                return view('category_solr.video_item', compact('video'));
                break;
            case "vua-download":
                $music = $this->musicRepository->getCategoryMusicSolr($request->cat_id, $request->cat_level, 'music_download_time', 'desc', LIMIT_MUSIC_PAGE_CATEGORY);
                return view('category_solr.music_item', compact('music'));
                break;
            case "music":
                $music = $this->musicRepository->musicNewsSolr('music_id', 'desc', LIMIT_MUSIC_PAGE_CATEGORY);
                return view('category_solr.music_item', compact('music'));
                break;
            case "video":
                $video = $this->videoRepository->videoNewsSolr('video_id', 'desc', LIMIT_MUSIC_PAGE_CATEGORY);
                return view('category_solr.video_item', compact('video'));
                break;
            case "cover":
                $cover = $this->coverRepository->coverNewSolr('cover_id', 'desc', LIMIT_MUSIC_PAGE_CATEGORY);
                return view('category_solr.cover_item', compact('cover'));
                break;
            default:
                $cover = $this->coverRepository->getCategoryCoverSolr($request->cat_id, $request->cat_level, ['csn_cover.music_year', CURRENT_YEAR], MAX_LOSTLESS, 'cover_id', 'desc', LIMIT_PAGE_CATEGORY);
                return view('category_solr.cover_item', compact('cover'));
                break;
        }
    }

}