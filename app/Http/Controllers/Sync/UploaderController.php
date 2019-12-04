<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8/17/2018
 * Time: 3:38 PM
 */
namespace App\Http\Controllers\Sync;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request as Request;
use Illuminate\Support\Facades\Auth;
use App\Library\Helpers;
use App\Repositories\Cover\CoverEloquentRepository;
use App\Repositories\User\UserEloquentRepository;
use App\Repositories\Music\MusicEloquentRepository;
use App\Repositories\Video\VideoEloquentRepository;
use App\Repositories\Category\CategoryEloquentRepository;
use App\Repositories\Upload\UploadEloquentRepository;
use App\Repositories\MusicDownload\MusicDownloadEloquentRepository;
use App\Repositories\VideoDownload\VideoDownloadEloquentRepository;
use Illuminate\Support\Facades\Storage;
use DB;
use File;

class UploaderController extends Controller
{
    protected $musicRepository;
    protected $videoRepository;
    protected $categoryRepository;
    protected $userRepository;
    protected $uploadRepository;
    protected $musicDownloadRepository;
    protected $videoDownloadRepository;

    public function __construct(MusicEloquentRepository $musicRepository, VideoEloquentRepository $videoRepository, CategoryEloquentRepository $categoryRepository, UserEloquentRepository $userRepository,
                                UploadEloquentRepository $uploadRepository, MusicDownloadEloquentRepository $musicDownloadRepository, VideoDownloadEloquentRepository $videoDownloadRepository) {
        $this->musicRepository = $musicRepository;
        $this->videoRepository = $videoRepository;
        $this->categoryRepository = $categoryRepository;
        $this->userRepository = $userRepository;
        $this->uploadRepository = $uploadRepository;
        $this->musicDownloadRepository = $musicDownloadRepository;
        $this->videoDownloadRepository = $videoDownloadRepository;
    }
    public function uploader() {
        $top_uploader_weeks = $this->uploadRepository->getModel()::select(DB::raw('music_username, music_user_id, COUNT(*) AS music_total, SUM(music_32_filesize + music_filesize + music_320_filesize + music_m4a_filesize + music_lossless_filesize) AS size_total'))
            ->where('music_time', '>', strtotime(date('Y-m-d', strtotime(TIME_7DAY_AGO)). ' 00:00'))
            ->where('music_state', '>', 0)
            ->where('music_320_filesize', '>', 0)
            ->groupBy('music_username', 'music_user_id')
            ->orderBy('size_total', 'desc')
            ->limit(10)
            ->get()->toArray();
        foreach($top_uploader_weeks as &$item) {
            $music = $this->musicRepository->getModel()::select(DB::raw('SUM(music_downloads_this_week + music_downloads_today_0) as download_total'))->where('music_user_id', $item['music_user_id'])->first();
            $video = $this->videoRepository->getModel()::select(DB::raw('SUM(music_downloads_this_week + music_downloads_today_0) as download_total'))->where('music_user_id', $item['music_user_id'])->first();
            $item['download_total'] = $music->download_total + $video->download_total;
        }
        $pathDir = resource_path() . '/views/cache/uploader/';
        file_put_contents($pathDir.'uploader_week.blade.php',
            '<?php 
if ( !ENV(\'IN_PHPBB\') )
{
    die(\'Hacking attempt\');
    exit;
}
global $top_uploader_weeks;
$top_uploader_weeks = ' . var_export($top_uploader_weeks, true) . ';
?>');


        return response(['Ok']);
    }
    public function scanFileCacheUpload() {
        $files =  Storage::disk('public')->files(DEFAULT_STORAGE_CACHE_MUSIC_PATH);
        if($files) {
            foreach ($files as $item) {
                $dir = Storage::disk('public')->getAdapter()->getPathPrefix();
                $fileTime = filemtime($dir.$item);
                if(time() - $fileTime >= TIMESPAN_TWO_DAY) {
                    Storage::delete('public' . '/' . $item);
                }
            }
        }
        // clear all file debug bar
        $files = Storage::disk('debugbar')->allFiles();
        foreach ($files as $item) {
            if($item != '.gitignore')
                Storage::disk('debugbar')->delete($item);
        }
        return response(['Ok']);
    }
}