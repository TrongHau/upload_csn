<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Sync\SolrSyncController;
use App\Solr\Solarium;
use App\Repositories\Music\MusicEloquentRepository;

class Solr extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'solr:type {type?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Solr';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $Solr;

    public function __construct(Solarium $Solr)
    {
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
        $Solr = new SolrSyncController($this->Solr);
        if($this->argument('type') == 'music') {
            $Solr->syncMusic(null, null, strtotime(TIME_SOLR_TO_ADD_ITEM));
        }elseif($this->argument('type') == 'video') {
            $Solr->syncVideo(null, null, strtotime(TIME_SOLR_TO_ADD_ITEM));
        }elseif($this->argument('type') == 'artist') {
//            $Solr->syncArtist(null, null, TIME_SOLR_TO_ADD_ITEM);
        }elseif($this->argument('type') == 'cover') {
            $Solr->syncCover(null, null, strtotime(TIME_SOLR_TO_ADD_ITEM));
        }elseif($this->argument('type') == 'all') {
            $minute_now = intval(date('i'));
            // Music
            if ($minute_now < 30) {
                $limit = 50000;
                $offset = $minute_now * $limit;
                $Solr->syncMusic(null, null, null, '', $offset, $limit);
            } elseif ($minute_now == 30) {
                $this->Solr->solrDeleteByQuery('(id:music_*)AND(solr_updated_time:[0 TO '. (time() - 2000) .'])');
            }
            // Video
            elseif ($minute_now < 34) {
                $limit = 50000;
                $offset = ($minute_now - 31) * $limit;
                $Solr->syncVideo(null, null, null, '', $offset, $limit);
            } elseif ($minute_now == 34) {
                $this->Solr->solrDeleteByQuery('(id:video_*)AND(solr_updated_time:[0 TO '. (time() - 1000) .'])');
            }
            // Artist
            elseif ($minute_now == 35) {
                $Solr->syncArtist();
                $this->Solr->solrDeleteByQuery('(id:artist_*)AND(solr_updated_time:[0 TO '. (time() - 2*86400) .'])');
            }
            // Cover
            elseif ($minute_now < 40) {
                $limit = 50000;
                $offset = ($minute_now - 36) * $limit;
                $Solr->syncCover(null, null, null, '', $offset, $limit);
            } elseif ($minute_now == 40) {
//                $this->Solr->solrDeleteByQuery('(id:cover_*)AND(solr_updated_time:[0 TO ' . (time() - 1000) . '])');
            }
        }
    }
}
