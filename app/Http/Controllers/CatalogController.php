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
use App\Repositories\Playlist\PlaylistEloquentRepository;
use App\Repositories\Upload\UploadEloquentRepository;
use App\Repositories\UploadException\UploadExceptionEloquentRepository;
use DB;

class CatalogController extends Controller
{
    protected $categoryRepository;
    protected $musicRepository;
    protected $videoRepository;
    protected $musicListenRepository;
    protected $coverRepository;
    protected $playlistRepository;
    protected $uploadRepository;
    protected $uploadExpRepository;

    public function __construct(CategoryEloquentRepository $categoryRepository, MusicEloquentRepository $musicRepository, CoverEloquentRepository $coverRepository, VideoEloquentRepository $videoRepository, PlaylistEloquentRepository $playlistRepository, UploadEloquentRepository $uploadRepository, UploadExceptionEloquentRepository $uploadExpRepository) {
        $this->categoryRepository = $categoryRepository;
        $this->musicRepository = $musicRepository;
        $this->videoRepository = $videoRepository;
        $this->coverRepository = $coverRepository;
        $this->playlistRepository = $playlistRepository;
        $this->uploadRepository = $uploadRepository;
        $this->uploadExpRepository = $uploadExpRepository;
    }
    public function playlistPublisher(Request $request, $url) {
        $catalog = config('constants.catalog');
        $result = $catalog[$url];
        if(!$result)
            return redirect()->guest('/');
        $caption = $result['caption'];
        $playlist = $this->playlistRepository->getByUser($result['user_id']);
        return view('catalog.playlist_publisher', compact('playlist', 'caption'));
    }
    public function musicNews(Request $request) {
        $music = $this->musicRepository->musicNewsSolr('music_id', 'desc', LIMIT_MUSIC_PAGE_CATEGORY);
        $htmlMusic = view('category_solr.music_item', compact('music'));;
        return view('catalog.music_news', compact('htmlMusic'));

    }
    public function videoNews(Request $request) {
        $video = $this->videoRepository->videoNewsSolr('video_id', 'desc', LIMIT_MUSIC_PAGE_CATEGORY);
        $htmlVideo = view('category_solr.video_item', compact('video'));
        return view('catalog.video_news', compact('htmlVideo'));
    }
    public function albumNews(Request $request) {
        $cover = $this->coverRepository->coverNewSolr('cover_id', 'desc', LIMIT_MUSIC_PAGE_CATEGORY);
        $htmlCover = view('category_solr.cover_item', compact('cover'));
        return view('catalog.cover_news', compact('htmlCover'));
    }
    public function copyright(Request $request) {
        $upload = $this->uploadExpRepository->getModel()::select('music_id', 'music_title', 'music_artist', 'cat_id', 'cat_level', 'cat_sublevel', 'cat_custom', 'cover_id', 'music_composer', 'music_album', 'music_track_id', 'music_track_id', 'music_filename', 'music_bitrate', 'date_expirted');
        if($request->load_ajax) {
            if($request->search) {
                $q = strtolower($request->search);
                $upload->whereRaw("(LOWER(music_title) LIKE '%" . $q . "%' or LOWER(music_artist) LIKE '%" . $q . "%')");

            }
            $upload = $upload->orderBy('created_at', 'desc')->paginate(LIMIT_PAGE_CATEGORY);
            return view('catalog.item_upload_copyright', compact('upload'));
        }

        $upload = $upload->orderBy('created_at', 'desc')->paginate(LIMIT_PAGE_CATEGORY);
        $htmlMusic = view('catalog.item_upload_copyright', compact('upload'));
        return view('catalog.upload_copyright', compact('htmlMusic'));

    }
}