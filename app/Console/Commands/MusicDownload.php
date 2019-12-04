<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Sync\MusicDownloadController;
use App\Repositories\Cover\CoverEloquentRepository;
use App\Repositories\Music\MusicEloquentRepository;
use App\Repositories\Video\VideoEloquentRepository;

class MusicDownload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'music_download';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync music download';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $musicRepository;

    public function __construct(MusicEloquentRepository $musicRepository)
    {
        $this->musicRepository = $musicRepository;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $albumCat = new MusicDownloadController($this->musicRepository);
        $albumCat->syncMusicDownload();
    }
}
