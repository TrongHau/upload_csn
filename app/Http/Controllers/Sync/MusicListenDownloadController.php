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
use App\Repositories\Music\MusicEloquentRepository;
use App\Repositories\Video\VideoEloquentRepository;
use App\Repositories\MusicListen\MusicListenEloquentRepository;
use App\Repositories\VideoListen\VideoListenEloquentRepository;
use App\Repositories\MusicDownload\MusicDownloadEloquentRepository;
use App\Repositories\VideoDownload\VideoDownloadEloquentRepository;
use App\Solr\Solarium;
use App\Http\Controllers\Sync\SolrSyncController;
use DB;

class MusicListenDownloadController extends Controller
{
    protected $musicRepository;
    protected $videoRepository;
    protected $musicListenRepository;
    protected $musicDownloadRepository;
    protected $videoListenRepository;
    protected $videoDownloadRepository;
    protected $Solr;

    public function __construct(MusicEloquentRepository $musicRepository, MusicListenEloquentRepository $musicListenRepository, MusicDownloadEloquentRepository $musicDownloadRepository, VideoEloquentRepository $videoRepository,
                                VideoListenEloquentRepository $videoListenRepository, VideoDownloadEloquentRepository $videoDownloadRepository, Solarium $Solr) {
        $this->musicRepository = $musicRepository;
        $this->videoRepository = $videoRepository;
        $this->musicListenRepository = $musicListenRepository;
        $this->musicDownloadRepository = $musicDownloadRepository;
        $this->videoListenRepository = $videoListenRepository;
        $this->videoDownloadRepository = $videoDownloadRepository;
        $this->Solr = $Solr;
    }
    public function syncMusicListen() {
        $query  = "UPDATE csn_music_listen SET music_listen_this_week = (music_listen_today_7 + music_listen_today_6 + music_listen_today_5 + music_listen_today_4 + music_listen_today_3 + music_listen_today_2 + music_listen_today_1), music_listen_today_7 = music_listen_today_6,
                        music_listen_today_6 = music_listen_today_5, music_listen_today_5 = music_listen_today_4, music_listen_today_4 = music_listen_today_3, music_listen_today_3 = music_listen_today_2, music_listen_today_2 = music_listen_today_1, music_listen_today_1 = music_listen_today_0, 
                        music_listen_ago = music_listen_today_0, music_listen_today = music_listen_today / 2, music_listen_today_0 = 0, music_listen_max_week = IF(music_listen_this_week > music_listen_max_week, music_listen_this_week, music_listen_max_week)";
        $result = DB::connection( 'mysql' )->select( $query );
        return response(['Ok']);
    }
    public function syncMusicDownload() {
        $query  = "UPDATE csn_music_download SET music_downloads_this_week = (music_downloads_today_7 + music_downloads_today_6 + music_downloads_today_5 + music_downloads_today_4 + music_downloads_today_3 + music_downloads_today_2 + music_downloads_today_1), music_downloads_today_7 = music_downloads_today_6,
                        music_downloads_today_6 = music_downloads_today_5, music_downloads_today_5 = music_downloads_today_4, music_downloads_today_4 = music_downloads_today_3, music_downloads_today_3 = music_downloads_today_2, music_downloads_today_2 = music_downloads_today_1, music_downloads_today_1 = music_downloads_today_0, 
                        music_downloads_ago = music_downloads_today_0, music_downloads_today = music_downloads_today / 2, music_downloads_today_0 = 0, music_downloads_max_week = IF(music_downloads_this_week > music_downloads_max_week, music_downloads_this_week, music_downloads_max_week)";
        $result = DB::connection( 'mysql' )->select( $query );
        return response(['Ok']);
    }

    public function syncVideoListen() {
        $query  = "UPDATE csn_video_listen SET music_listen_this_week = (music_listen_today_7 + music_listen_today_6 + music_listen_today_5 + music_listen_today_4 + music_listen_today_3 + music_listen_today_2 + music_listen_today_1), music_listen_today_7 = music_listen_today_6,
                        music_listen_today_6 = music_listen_today_5, music_listen_today_5 = music_listen_today_4, music_listen_today_4 = music_listen_today_3, music_listen_today_3 = music_listen_today_2, music_listen_today_2 = music_listen_today_1, music_listen_today_1 = music_listen_today_0, 
                        music_listen_ago = music_listen_today_0, music_listen_today = music_listen_today / 2, music_listen_today_0 = 0, music_listen_max_week = IF(music_listen_this_week > music_listen_max_week, music_listen_this_week, music_listen_max_week)";
        $result = DB::connection( 'mysql' )->select( $query );
        return response(['Ok']);
    }
    public function syncVideoDownload() {
        $query  = "UPDATE csn_video_download SET music_downloads_this_week = (music_downloads_today_7 + music_downloads_today_6 + music_downloads_today_5 + music_downloads_today_4 + music_downloads_today_3 + music_downloads_today_2 + music_downloads_today_1), music_downloads_today_7 = music_downloads_today_6,
                        music_downloads_today_6 = music_downloads_today_5, music_downloads_today_5 = music_downloads_today_4, music_downloads_today_4 = music_downloads_today_3, music_downloads_today_3 = music_downloads_today_2, music_downloads_today_2 = music_downloads_today_1, music_downloads_today_1 = music_downloads_today_0, 
                        music_downloads_ago = music_downloads_today_0, music_downloads_today = music_downloads_today / 2, music_downloads_today_0 = 0, music_downloads_max_week = IF(music_downloads_this_week > music_downloads_max_week, music_downloads_this_week, music_downloads_max_week)";
        $result = DB::connection( 'mysql' )->select( $query );
        return response(['Ok']);
    }

    public function realMusicListen(){
//        $result = $this->musicListenRepository->getModel()::where('music_listen_time', '>',  strtotime(TIME_EXPIRED_UPLOAD_LISTEN_DOWNLOAD))->with('hasOneMusic')->get();
        $query  = "UPDATE csn_music_listen AS l, csn_music AS m 
                        SET m.music_listen = l.music_listen + l.music_listen_fake, m.music_listen_time = l.music_listen_time
                        WHERE l.music_listen_time > ".strtotime(TIME_EXPIRED_UPLOAD_LISTEN_DOWNLOAD)."
                            AND m.music_id = l.music_id";
        $result = DB::connection( 'mysql' )->select( $query );

//        $result = $this->musicListenRepository->getModel()::where('music_listen_time', '>',  strtotime(TIME_EXPIRED_UPLOAD_LISTEN_DOWNLOAD))->pluck('music_id');
//        $musicArr = $this->musicRepository->getModel()::whereIn('music_id', $result)->get();
        $Solr = new SolrSyncController($this->Solr);
        $Solr->syncMusic(null, null, strtotime(TIME_EXPIRED_UPLOAD_LISTEN_DOWNLOAD), 'music_listen_time');
        return response(['Ok']);
    }
    public function realMusicDownload(){
//        $result = $this->musicDownloadRepository->getModel()::select('music_id', 'music_downloads', 'music_downloads_time')->where('music_downloads_time', '>',  strtotime(TIME_EXPIRED_UPLOAD_LISTEN_DOWNLOAD))->with('hasOneMusic')->get();
        $query  = "UPDATE csn_music_download AS d, csn_music AS m 
                        SET m.music_downloads = d.music_downloads, m.music_download_time = d.music_downloads_time
                        WHERE d.music_downloads_time > ".strtotime(TIME_EXPIRED_UPLOAD_LISTEN_DOWNLOAD)."
                            AND m.music_id = d.music_id";
        $result = DB::connection( 'mysql' )->select( $query );
        $Solr = new SolrSyncController($this->Solr);
        $Solr->syncMusic(null, null, strtotime(TIME_EXPIRED_UPLOAD_LISTEN_DOWNLOAD), 'music_download_time');
        return response(['Ok']);
    }
    public function realVideoListen(){
        $query  = "UPDATE csn_video_listen AS l, csn_video AS v 
                        SET v.music_listen = l.music_listen + l.music_listen_fake, v.music_listen_time = l.music_listen_time
                        WHERE l.music_listen_time > ".strtotime(TIME_EXPIRED_UPLOAD_LISTEN_DOWNLOAD)."
                            AND v.music_id = l.music_id";
        $result = DB::connection( 'mysql' )->select( $query );
        $Solr = new SolrSyncController($this->Solr);
        $Solr->syncMusic(null, null, strtotime(TIME_EXPIRED_UPLOAD_LISTEN_DOWNLOAD), 'music_listen_time');
        return response(['Ok']);
    }
    public function realVideoDownload(){
//        $result = $this->musicDownloadRepository->getModel()::select('music_id', 'music_downloads', 'music_downloads_time')->where('music_downloads_time', '>',  strtotime(TIME_EXPIRED_UPLOAD_LISTEN_DOWNLOAD))->with('hasOneMusic')->get();
        $query  = "UPDATE csn_video_download AS d, csn_video AS v 
                        SET v.music_downloads = d.music_downloads, v.music_download_time = d.music_downloads_time
                        WHERE d.music_downloads_time > ".strtotime(TIME_EXPIRED_UPLOAD_LISTEN_DOWNLOAD)."
                            AND v.music_id = d.music_id";
        $result = DB::connection( 'mysql' )->select( $query );
        $Solr = new SolrSyncController($this->Solr);
        $Solr->syncMusic(null, null, strtotime(TIME_EXPIRED_UPLOAD_LISTEN_DOWNLOAD), 'music_download_time');
        return response(['Ok']);
    }
}