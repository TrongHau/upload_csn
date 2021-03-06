<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Sync\ArtistController;
use App\Repositories\Cover\CoverEloquentRepository;
use App\Repositories\Music\MusicEloquentRepository;
use App\Repositories\Video\VideoEloquentRepository;
use App\Repositories\Artist\ArtistRepository;

class TopArtist extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'top_artist';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync top artist';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $musicRepository;
    protected $coverRepository;
    protected $videoRepository;
    protected $artistRepository;

    public function __construct(MusicEloquentRepository $musicRepository, CoverEloquentRepository $coverRepository, VideoEloquentRepository $videoRepository, ArtistRepository $artistRepository)
    {
        $this->musicRepository = $musicRepository;
        $this->coverRepository = $coverRepository;
        $this->videoRepository = $videoRepository;
        $this->artistRepository = $artistRepository;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $albumCat = new ArtistController($this->musicRepository, $this->coverRepository, $this->videoRepository, $this->artistRepository);
        $albumCat->topArtist();
    }
}
