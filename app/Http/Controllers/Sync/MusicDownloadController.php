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
use App\Models\MusicModel;
use App\Models\VideoModel;
use App\Models\CoverModel;
use App\Repositories\Cover\CoverEloquentRepository;
use App\Models\ArtistModel;
use App\Repositories\Music\MusicEloquentRepository;
use DB;

class MusicDownloadController extends Controller
{
    protected $musicRepository;

    public function __construct(MusicEloquentRepository $musicRepository) {
        $this->musicRepository = $musicRepository;
    }
    public function syncMusicDownload() {
        $cache = $this->musicRepository->getQueryPublished()
            ->where('cover_id', '>', 0)
            ->select('music_id', 'music_title_url', 'music_title', 'music_artist', 'music_artist_id', 'cat_id', 'cat_level', 'cat_sublevel', 'cat_custom', 'cover_id', 'music_download_time', 'music_last_update_time', 'music_title_url',
                'music_title_search', 'music_artist_search', 'music_album_search', 'music_composer', 'music_album', 'music_listen', 'music_track_id', 'music_track_id', 'music_filename', 'music_bitrate', 'music_shortlyric', 'music_last_update_time', 'music_time')
            ->orderBy('music_download_time', 'desc')
            ->limit(20)->get();
        $download_rows = $cache->toArray();
        foreach ($download_rows as $key => $item) {
            $download_rows[$key]['cover_html'] = Helpers::cover_url($item['cover_id'], explode(';', $item['music_artist_id'])[0]);
            $download_rows[$key]['music_url'] = Helpers::listen_url($item, false);
            $download_rows[$key]['music_bitrate_html'] = Helpers::bitrate2str($item['music_bitrate']);
            $download_rows[$key]['music_artist_html'] = Helpers::rawHtmlArtists($item['music_artist_id'], $item['music_artist']);
        }
        file_put_contents(resource_path().'/views/cache/def_home_download.blade.php',
            '<?php 
if ( !ENV(\'IN_PHPBB\') )
{
    die(\'Hacking attempt\');
    exit;
}
global $download_rows;
    
$download_rows = ' . var_export($download_rows, true) . ';
?>');
        return response(['Ok']);
    }
}