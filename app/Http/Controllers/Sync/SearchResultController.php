<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8/17/2018
 * Time: 3:38 PM
 */
namespace App\Http\Controllers\Sync;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Sync\SolrSyncController;
use Illuminate\Http\Request as Request;
use Illuminate\Support\Facades\Auth;
use App\Library\Helpers;
use App\Solr\Solarium;
use App\Models\MusicSearchResultReportModel;
use App\Repositories\Cover\CoverEloquentRepository;
use App\Repositories\Music\MusicEloquentRepository;
use App\Repositories\Video\VideoEloquentRepository;
use App\Repositories\MusicSearchResult\MusicSearchResultEloquentRepository;
use DB;
use View;

class SearchResultController extends Controller
{
    protected $musicRepository;
    protected $coverRepository;
    protected $videoRepository;
    protected $searchRepository;
    protected $Solr;

    public function __construct(MusicEloquentRepository $musicRepository, CoverEloquentRepository $coverRepository, VideoEloquentRepository $videoRepository, MusicSearchResultEloquentRepository $searchRepository, Solarium $Solr) {
        $this->musicRepository = $musicRepository;
        $this->coverRepository = $coverRepository;
        $this->videoRepository = $videoRepository;
        $this->searchRepository = $searchRepository;
        $this->Solr = $Solr;
    }
    public function syncCountSearch() {
        $date = date('Y-m-d',strtotime(TIME_MUSIC_SEARCH_RESULT_1DAY_AGO)) . ' 23:59:59';
        $queryMusic = "UPDATE csn_music_search_result AS s, csn_music AS m
                        SET m.music_search_result = m.music_search_result + s.music_search_count
                        WHERE s.created_at <= '" . $date . "'
                            AND s.music_id = m.music_id";

        $queryVideo = "UPDATE csn_music_search_result AS s, csn_video AS v
                        SET v.music_search_result = v.music_search_result + s.music_search_count
                        WHERE s.created_at <= '" . $date . "'
                            AND s.music_id = v.music_id";
        DB::connection( 'mysql' )->select( $queryMusic );
        DB::connection( 'mysql' )->select( $queryVideo );
        $Solr = new SolrSyncController($this->Solr);
//        ->where('csn_music_search_result.cat_id', '!=', CAT_VIDEO)
        $musicArr = $this->searchRepository->getModel()::join("csn_music","csn_music.music_id","=","csn_music_search_result.music_id")
            ->select('csn_music.*')
            ->where('csn_music_search_result.created_at', '<=', $date)
            ->where('csn_music_search_result.music_search_count', '>', 3)
            ->orderBy('csn_music_search_result.music_search_count', 'desc')
            ->limit(25000)
            ->get();
        $videoArr = $this->searchRepository->getModel()::join("csn_video","csn_video.music_id","=","csn_music_search_result.music_id")
            ->select('csn_video.*')
            ->where('csn_music_search_result.created_at', '<=', $date)
            ->where('csn_music_search_result.music_search_count', '>', 3)
            ->orderBy('csn_music_search_result.music_search_count', 'desc')
            ->limit(25000)
            ->get();
        $searchResult = $this->searchRepository->getModel()::where('created_at', '<=', $date)->where('music_search_count', '>', 3)->get()->toArray();
        foreach ($searchResult as $item) {
            MusicSearchResultReportModel::insert($item);
        }
        $this->searchRepository->getModel()::where('created_at', '<=', $date)->delete();
        if(count($musicArr))
            $Solr->syncMusic(null, $musicArr);
        if(count($videoArr))
            $Solr->syncVideo(null, $videoArr);
        return response(['Ok']);
    }
    public function CacheTopSearch () {
        $date = date('Y-m-d',strtotime(TIME_MUSIC_SEARCH_RESULT_1DAY_AGO)) . ' 23:59:59';
        $musicArr = $this->searchRepository->getModel()::join("csn_music","csn_music.music_id","=","csn_music_search_result.music_id")
            ->select('csn_music.*')
            ->where('csn_music_search_result.music_search_count', '>', 3)
            ->orderBy('csn_music_search_result.music_search_count', 'desc')
            ->limit(5)
            ->get();
        if(count($musicArr) < 3) {
            $musicArr = MusicSearchResultReportModel::join("csn_music","csn_music.music_id","=","csn_music_search_result_report.music_id")
                ->select('csn_music.*')
                ->where('csn_music_search_result_report.created_at', '<=', $date)
                ->where('csn_music_search_result_report.music_search_count', '>', 10)
                ->orderBy('csn_music_search_result_report.music_search_count', 'desc')
                ->limit(5)
                ->get();
        }
        $content = view::make('web.search.cache_top_search', compact('musicArr'))->render();
        file_put_contents(resource_path().'/views/cache/top_search.blade.php', $content);
    }
}