<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Sync\AlbumController;
use App\Repositories\Cover\CoverEloquentRepository;
use App\Repositories\Music\MusicEloquentRepository;
use App\Repositories\Video\VideoEloquentRepository;

class Album extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'album';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Album';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $musicRepository;
    protected $coverRepository;
    protected $videoRepository;

    public function __construct(MusicEloquentRepository $musicRepository, CoverEloquentRepository $coverRepository, VideoEloquentRepository $videoRepository)
    {
        $this->musicRepository = $musicRepository;
        $this->coverRepository = $coverRepository;
        $this->videoRepository = $videoRepository;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $albumCat = new AlbumController($this->musicRepository, $this->coverRepository, $this->videoRepository);
        $albumCat->syncAlbum();
    }
}
