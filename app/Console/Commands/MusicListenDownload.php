<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Sync\MusicListenDownloadController;
use App\Repositories\Music\MusicEloquentRepository;
use App\Repositories\Video\VideoEloquentRepository;
use App\Repositories\MusicListen\MusicListenEloquentRepository;
use App\Repositories\VideoListen\VideoListenEloquentRepository;
use App\Repositories\MusicDownload\MusicDownloadEloquentRepository;
use App\Repositories\VideoDownload\VideoDownloadEloquentRepository;
use App\Solr\Solarium;

class MusicListenDownload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'music_listen_download:type {type?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync music count listen download';

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
    protected $Solr;


    public function __construct(MusicEloquentRepository $musicRepository, MusicListenEloquentRepository $musicListenRepository, MusicDownloadEloquentRepository $musicDownloadRepository, VideoEloquentRepository $videoRepository,
                                VideoListenEloquentRepository $videoListenRepository, VideoDownloadEloquentRepository $videoDownloadRepository, Solarium $Solr)
    {
        $this->musicRepository = $musicRepository;
        $this->videoRepository = $videoRepository;
        $this->musicListenRepository = $musicListenRepository;
        $this->musicDownloadRepository = $musicDownloadRepository;
        $this->videoListenRepository = $videoListenRepository;
        $this->videoDownloadRepository = $videoDownloadRepository;
        $this->Solr = $Solr;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $listenDownload = new MusicListenDownloadController($this->musicRepository, $this->musicListenRepository, $this->musicDownloadRepository, $this->videoRepository, $this->videoListenRepository, $this->videoDownloadRepository, $this->Solr);
        if($this->argument('type') == 'real') {
            $listenDownload->realMusicListen();
            $listenDownload->realMusicDownload();
            $listenDownload->realVideoListen();
            $listenDownload->realVideoDownload();
        }elseif($this->argument('type') == 'today') {
            $listenDownload->syncMusicListen();
            $listenDownload->syncMusicDownload();
            $listenDownload->syncVideoListen();
            $listenDownload->syncVideoDownload();
        }
    }
}
