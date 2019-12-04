<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Sync\BxhCategoryController;
use App\Repositories\Music\MusicEloquentRepository;
use App\Repositories\Category\CategoryEloquentRepository;
use App\Repositories\MusicListen\MusicListenEloquentRepository;
use App\Repositories\VideoListen\VideoListenEloquentRepository;
use App\Repositories\ArtistException\ArtistExceptionRepository;
use App\Repositories\MusicDownload\MusicDownloadEloquentRepository;
use App\Repositories\VideoDownload\VideoDownloadEloquentRepository;
use App\Repositories\UploadException\UploadExceptionEloquentRepository;

class BxhCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bxh_cat:type {type? : cat} {month?} {year?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Rank Category';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $musicRepository;
    protected $categoryRepository;
    protected $musicListenRepository;
    protected $artistExpRepository;
    protected $musicDownloadRepository;
    protected $videoDownloadRepository;
    protected $uploadExRepository;
    protected $videoListenRepository;

    public function __construct(MusicEloquentRepository $musicRepository, CategoryEloquentRepository $categoryRepository, MusicListenEloquentRepository $musicListenRepository, VideoListenEloquentRepository $videoListenRepository, ArtistExceptionRepository $artistExpRepository, MusicDownloadEloquentRepository $musicDownloadRepository, VideoDownloadEloquentRepository $videoDownloadRepository, UploadExceptionEloquentRepository $uploadExRepository)
    {
        $this->musicRepository = $musicRepository;
        $this->categoryRepository = $categoryRepository;
        $this->musicListenRepository = $musicListenRepository;
        $this->videoListenRepository = $videoListenRepository;
        $this->artistExpRepository = $artistExpRepository;
        $this->musicDownloadRepository = $musicDownloadRepository;
        $this->videoDownloadRepository = $videoDownloadRepository;
        $this->uploadExRepository = $uploadExRepository;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $bxh = new BxhCategoryController($this->musicRepository, $this->categoryRepository, $this->musicListenRepository, $this->videoListenRepository, $this->artistExpRepository, $this->musicDownloadRepository, $this->videoDownloadRepository, $this->uploadExRepository );
        if($this->argument('type') == 'cat') {
            if($this->argument('month') == 'today') {
                // run sync category today
                $bxh->syncBxhCategory(true, false);
            }else{
                // run sync category week
                $bxh->syncBxhCategory(false, true);
            }
        }else {
            $month = $this->argument('month') ?? 'all';
            $year = $this->argument('year') ?? CURRENT_YEAR;
            $bxh->syncBxhCategoryMonthYear($month, $year); // month = all || 1->12
        }
    }
}
