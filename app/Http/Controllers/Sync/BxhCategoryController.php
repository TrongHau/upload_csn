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
use App\Models\CategoryCsnModel;
use App\Repositories\Music\MusicEloquentRepository;
use App\Repositories\Category\CategoryEloquentRepository;
use App\Repositories\MusicListen\MusicListenEloquentRepository;
use App\Repositories\VideoListen\VideoListenEloquentRepository;
use App\Repositories\MusicException\MusicExceptionEloquentRepository;
use App\Repositories\VideoException\VideoExceptionEloquentRepository;
use App\Repositories\UploadException\UploadExceptionEloquentRepository;
use App\Repositories\ArtistException\ArtistExceptionRepository;
use App\Repositories\MusicDownload\MusicDownloadEloquentRepository;
use App\Repositories\VideoDownload\VideoDownloadEloquentRepository;
use DB;

class BxhCategoryController extends Controller
{
    protected $musicRepository;
    protected $categoryRepository;
    protected $musicListenRepository;
    protected $videoListenRepository;
    protected $artistExpRepository;
    protected $musicDownloadRepository;
    protected $videoDownloadRepository;
    protected $uploadExRepository;

    public function __construct(MusicEloquentRepository $musicRepository, CategoryEloquentRepository $categoryRepository, MusicListenEloquentRepository $musicListenRepository, VideoListenEloquentRepository $videoListenRepository, ArtistExceptionRepository $artistExpRepository,
                                    MusicDownloadEloquentRepository $musicDownloadRepository, VideoDownloadEloquentRepository $videoDownloadRepository, UploadExceptionEloquentRepository $uploadExRepository)
    {
        $this->musicRepository = $musicRepository;
        $this->categoryRepository = $categoryRepository;
        $this->musicListenRepository = $musicListenRepository;
        $this->videoListenRepository = $videoListenRepository;
        $this->artistExpRepository = $artistExpRepository;
        $this->musicDownloadRepository = $musicDownloadRepository;
        $this->videoDownloadRepository = $videoDownloadRepository;
        $this->uploadExRepository = $uploadExRepository;
    }
    public function syncBxhCategory($today = true, $week = false) {
        $catregory =$this->categoryRepository->getCategoryParent();
        DB::disconnect('mysql');
        if($today) {
        $ressultMusic = [];
        $ressultVideo = [];
        $artistExp = $this->artistExpRepository->getArrNames();
        foreach ($catregory as $item) {
//            $result = $this->musicListenRepository->bxhHotTodayCategoryMusic($item->cat_id)->toArray();
            $result = $this->musicDownloadRepository->bxhCategoryMusic($item->cat_id, [
                    'csn_music_download.music_downloads_today_0' => 'desc',
                    'csn_music_download.music_downloads_today_1' => 'desc',
                    'csn_music_download.music_downloads_this_week' => 'desc']
            )->toArray();
            foreach($result as $item2) {
                if(!Helpers::checkExitsExcepArtist($item2['music_artist'], $artistExp) || !$this->uploadExRepository->checkExist($item2['music_title'], $item2['music_artist'])) {
                    $item2['cover_html'] = Helpers::cover_url($item2['cover_id'], explode(';', $item2['music_artist_id'])[0]);
                    $item2['music_url'] = Helpers::listen_url($item2, false);
                    $item2['music_artist_html'] = Helpers::rawHtmlArtists($item2['music_artist_id'], $item2['music_artist']);
                    $item2['music_bitrate_html'] = Helpers::bitrate2str($item2['music_bitrate']);
                    $ressultMusic[$item->cat_id][] = $item2;
                }
            }
//            $result = $this->musicListenRepository->bxhHotTodayCategoryVideo($item->cat_id)->toArray();
//            $result = $this->videoDownloadRepository->bxhHotTodayCategoryVideo($item->cat_id)->toArray();
            $result = $this->videoListenRepository->bxhCategoryVideo($item->cat_id, [
                'csn_video_listen.music_listen_today_0' => 'desc',
                'csn_video_listen.music_listen_today_1' => 'desc',
                'csn_video_listen.music_listen_this_week' => 'desc']
            )->toArray();
            foreach($result as $item2) {
                if(!Helpers::checkExitsExcepArtist($item2['music_artist'], $artistExp) || !$this->uploadExRepository->checkExist($item2['music_title'], $item2['music_artist'])) {
                    $item2['cover_html'] = Helpers::cover_url($item2['cover_id'], explode(';', $item2['music_artist_id'])[0]);
                    $item2['music_url'] = Helpers::listen_url($item2, false);
                    $item2['music_artist_html'] = Helpers::rawHtmlArtists($item2['music_artist_id'], $item2['music_artist']);
                    $item2['music_bitrate_html'] = Helpers::size2str($item2['music_width'], $item2['music_height']);
                    $ressultVideo[$item->cat_id][] = $item2;
                }
            }
        }
        file_put_contents(resource_path().'/views/cache/bxh/bxh_today.blade.php',
            '<?php 
if ( !ENV(\'IN_PHPBB\') )
{
    die(\'Hacking attempt\');
    exit;
}
global $hot_music_rows;
global $hot_video_rows;
    
$hot_music_rows = ' . var_export($ressultMusic, true) . ';
$hot_video_rows = ' . var_export($ressultVideo, true) . ';
?>');
        }
        if($week) {
            $ressultMusic = [];
            $ressultVideo = [];
            foreach ($catregory as $item) {
//                $result = $this->musicListenRepository->bxhWeekCategoryMusic($item->cat_id)->toArray();
                $result = $this->musicDownloadRepository->bxhCategoryMusic($item->cat_id, [
                        'csn_music_download.music_downloads_this_week' => 'desc',
                        'csn_music_download.music_downloads_max_week' => 'desc']
                )->toArray();
                DB::disconnect('mysql');
                foreach ($result as $item2) {
                    $item2['cover_html'] = Helpers::cover_url($item2['cover_id'], explode(';', $item2['music_artist_id'])[0]);
                    $item2['music_url'] = Helpers::listen_url($item2, false);
                    $item2['music_artist_html'] = Helpers::rawHtmlArtists($item2['music_artist_id'], $item2['music_artist']);
                    $item2['music_bitrate_html'] = Helpers::bitrate2str($item2['music_bitrate']);
                    $ressultMusic[$item->cat_id][] = $item2;
                }
//                $result = $this->musicListenRepository->bxhWeekCategoryVideo($item->cat_id)->toArray();
                $result = $this->videoListenRepository->bxhCategoryVideo($item->cat_id, [
                        'csn_video_listen.music_listen_this_week' => 'desc',
                        'csn_video_listen.music_listen_max_week' => 'desc']
                )->toArray();
                DB::disconnect('mysql');
                foreach ($result as $item2) {
                    $item2['cover_html'] = Helpers::cover_url($item2['cover_id'], explode(';', $item2['music_artist_id'])[0]);
                    $item2['music_url'] = Helpers::listen_url($item2, false);
                    $item2['music_artist_html'] = Helpers::rawHtmlArtists($item2['music_artist_id'], $item2['music_artist']);
                    $item2['music_bitrate_html'] = Helpers::size2str($item2['music_width'], $item2['music_height']);
                    $ressultVideo[$item->cat_id][] = $item2;
                }
            }
            file_put_contents(resource_path() . '/views/cache/bxh/bxh_week.blade.php',
                '<?php 
if ( !ENV(\'IN_PHPBB\') )
{
    die(\'Hacking attempt\');
    exit;
}
global $hot_music_rows;
global $hot_video_rows;
    
$hot_music_rows = ' . var_export($ressultMusic, true) . ';
$hot_video_rows = ' . var_export($ressultVideo, true) . ';
?>');
        }
        return response(['Ok']);
    }
    public function syncBxhCategoryMonthYear($month = 'all', $year = CURRENT_YEAR) {
        $ressultMusic = [];
        $ressultVideo = [];
        $catregory =$this->categoryRepository->getCategoryParent();
        if($month == 'all') {
            foreach ($catregory as $item) {
//                $result = $this->musicListenRepository->bxhYearCategoryMusic($item->cat_id, $year)->toArray();
                $result = $this->musicDownloadRepository->bxhCategoryMusic($item->cat_id, [
                        'csn_music_download.music_downloads_max_week' => 'desc',
//                        'csn_music.music_downloads' => 'desc',
                ], $year)->toArray();
                DB::disconnect('mysql');
                foreach($result as $item2) {
                    $item2['cover_html'] = Helpers::cover_url($item2['cover_id'], explode(';', $item2['music_artist_id'])[0]);
                    $item2['music_url'] = Helpers::listen_url($item2, false);
                    $item2['music_artist_html'] = Helpers::rawHtmlArtists($item2['music_artist_id'], $item2['music_artist']);
                    $item2['music_bitrate_html'] = Helpers::bitrate2str($item2['music_bitrate']);
                    $ressultMusic[$item->cat_id][] = $item2;
                }
//                $result = $ressultVideo[$item->cat_id] = $this->musicListenRepository->bxhYearCategoryVideo($item->cat_id, $year)->toArray();
                $result = $this->videoListenRepository->bxhCategoryVideo($item->cat_id, [
                        'csn_video_listen.music_listen_max_week' => 'desc'
//                        'csn_video.music_listen' => 'desc'
                ], $year)->toArray();
                DB::disconnect('mysql');
                foreach($result as $item2) {
                    $item2['cover_html'] = Helpers::cover_url($item2['cover_id'], explode(';', $item2['music_artist_id'])[0]);
                    $item2['music_url'] = Helpers::listen_url($item2, false);
                    $item2['music_artist_html'] = Helpers::rawHtmlArtists($item2['music_artist_id'], $item2['music_artist']);
                    $item2['music_bitrate_html'] = Helpers::size2str($item2['music_width'], $item2['music_height']);
                    $ressultVideo[$item->cat_id][] = $item2;
                }
            }
            file_put_contents(resource_path().'/views/cache/bxh/bxh_'.$month.'_'.$year.'.blade.php',
                '<?php 
if ( !ENV(\'IN_PHPBB\') )
{
    die(\'Hacking attempt\');
    exit;
}
global $hot_music_rows;
global $hot_video_rows;
    
$hot_music_rows = ' . var_export($ressultMusic, true) . ';
$hot_video_rows = ' . var_export($ressultVideo, true) . ';
?>');
        }else{
            for($i = ($month == 'all_month' ? 1 : $month); $i <= ($month == 'all_month' ? 12 : $month); $i++) {
                $month_ = sprintf('%02d', $i);
                $firstDate = strtotime('01-'.$month_.'-'.$year);
                $lastDate = strtotime(date('t-m-Y', $firstDate));
                $ressultMusic = [];
                $ressultVideo = [];
                foreach ($catregory as $item) {
//                    $result = $this->musicListenRepository->bxhMonthCategoryMusic($item->cat_id, $firstDate, $lastDate, $year)->toArray();
                    $result = $this->musicDownloadRepository->bxhCategoryMusic($item->cat_id, [
                        'csn_music_download.music_downloads_max_week' => 'desc',
                    ], $year, $firstDate, $lastDate)->toArray();
                    DB::disconnect('mysql');
                    foreach($result as $item2) {
                        $item2['cover_html'] = Helpers::cover_url($item2['cover_id'], explode(';', $item2['music_artist_id'])[0]);
                        $item2['music_url'] = Helpers::listen_url($item2, false);
                        $item2['music_artist_html'] = Helpers::rawHtmlArtists($item2['music_artist_id'], $item2['music_artist']);
                        $item2['music_bitrate_html'] = Helpers::bitrate2str($item2['music_bitrate']);
                        $ressultMusic[$item->cat_id][] = $item2;
                    }
//                    $result = $this->musicListenRepository->bxhMonthCategoryVideo($item->cat_id, $firstDate, $lastDate, $year)->toArray();
                    $result = $this->videoListenRepository->bxhCategoryVideo($item->cat_id, [
                        'csn_video_listen.music_listen_max_week' => 'desc'
                    ], $year, $firstDate, $lastDate)->toArray();
                    DB::disconnect('mysql');
                    foreach($result as $item2) {
                        $item2['cover_html'] = Helpers::cover_url($item2['cover_id'], explode(';', $item2['music_artist_id'])[0]);
                        $item2['music_url'] = Helpers::listen_url($item2, false);
                        $item2['music_artist_html'] = Helpers::rawHtmlArtists($item2['music_artist_id'], $item2['music_artist']);
                        $item2['music_bitrate_html'] = Helpers::size2str($item2['music_width'], $item2['music_height']);
                        $ressultVideo[$item->cat_id][] = $item2;
                    }
                }
                file_put_contents(resource_path().'/views/cache/bxh/bxh_'.$month_.'_'.$year.'.blade.php',
                    '<?php
if ( !ENV(\'IN_PHPBB\') )
{
    die(\'Hacking attempt\');
    exit;
}
global $hot_music_rows;
global $hot_video_rows;
    
$hot_music_rows = ' . var_export($ressultMusic, true) . ';
$hot_video_rows = ' . var_export($ressultVideo, true) . ';
?>');
            }
        }
        return response(['Ok']);
    }
}