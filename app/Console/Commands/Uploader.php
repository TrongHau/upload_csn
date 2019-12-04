<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Sync\UploaderController;
use App\Repositories\Cover\CoverEloquentRepository;
use App\Repositories\User\UserEloquentRepository;
use App\Repositories\Music\MusicEloquentRepository;
use App\Repositories\Video\VideoEloquentRepository;
use App\Repositories\Category\CategoryEloquentRepository;
use App\Repositories\Upload\UploadEloquentRepository;
use App\Repositories\MusicDownload\MusicDownloadEloquentRepository;
use App\Repositories\VideoDownload\VideoDownloadEloquentRepository;

class Uploader extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'uploader:type {type?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Suggestion category';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $musicRepository;
    protected $coverRepository;
    protected $videoRepository;
    protected $categoryRepository;
    protected $userRepository;
    protected $uploadRepository;
    protected $musicDownloadRepository;
    protected $videoDownloadRepository;

    public function __construct(MusicEloquentRepository $musicRepository, CoverEloquentRepository $coverRepository, VideoEloquentRepository $videoRepository, CategoryEloquentRepository $categoryRepository, UserEloquentRepository $userRepository,
                                UploadEloquentRepository $uploadRepository, MusicDownloadEloquentRepository $musicDownloadRepository, VideoDownloadEloquentRepository $videoDownloadRepository)
    {
        $this->musicRepository = $musicRepository;
        $this->videoRepository = $videoRepository;
        $this->categoryRepository = $categoryRepository;
        $this->userRepository = $userRepository;
        $this->uploadRepository = $uploadRepository;
        $this->musicDownloadRepository = $musicDownloadRepository;
        $this->videoDownloadRepository = $videoDownloadRepository;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $upload = new UploaderController($this->musicRepository, $this->videoRepository,$this->categoryRepository, $this->userRepository, $this->uploadRepository, $this->musicDownloadRepository, $this->videoDownloadRepository);
        if($this->argument('type') == '7day') {
            $upload->uploader();
        }elseif($this->argument('type') == 'cache_upload') {
            $upload->scanFileCacheUpload();
        }
    }
}
