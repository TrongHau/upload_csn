<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
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
use App\Repositories\MusicSearchResult\MusicSearchResultEloquentRepository;
use App\Solr\Solarium;
use App\Http\Controllers\Sync\SearchResultController;
use DB;

class SearchResult extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search_counting_result {type?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync search counting';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $musicRepository;
    protected $videoRepository;
    protected $musicListenRepository;
    protected $musicDownloadRepository;
    protected $videoListenRepository;
    protected $videoDownloadRepository;
    protected $coverRepository;
    protected $searchRepository;
    protected $Solr;

    public function __construct(MusicEloquentRepository $musicRepository, MusicListenEloquentRepository $musicListenRepository, MusicDownloadEloquentRepository $musicDownloadRepository, VideoEloquentRepository $videoRepository,
                                VideoListenEloquentRepository $videoListenRepository, VideoDownloadEloquentRepository $videoDownloadRepository, Solarium $Solr, CoverEloquentRepository $coverRepository, MusicSearchResultEloquentRepository $searchRepository) {
        $this->musicRepository = $musicRepository;
        $this->videoRepository = $videoRepository;
        $this->musicListenRepository = $musicListenRepository;
        $this->musicDownloadRepository = $musicDownloadRepository;
        $this->videoListenRepository = $videoListenRepository;
        $this->videoDownloadRepository = $videoDownloadRepository;
        $this->coverRepository = $coverRepository;
        $this->searchRepository = $searchRepository;
        $this->Solr = $Solr;
        parent::__construct();
    }
    public function handle()
    {
        $search = new SearchResultController($this->musicRepository, $this->coverRepository, $this->videoRepository, $this->searchRepository, $this->Solr);
        if($this->argument('type') == 'report') {
            $search->syncCountSearch();
        }elseif($this->argument('type') == 'cache') {
            $search->CacheTopSearch();
        }
    }
}

