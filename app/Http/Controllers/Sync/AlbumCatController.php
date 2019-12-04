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
use App\Repositories\Cover\CoverEloquentRepository;
use App\Repositories\Music\MusicEloquentRepository;
use App\Repositories\Video\VideoEloquentRepository;
use DB;

class AlbumCatController extends Controller
{
    protected $musicRepository;
    protected $coverRepository;
    protected $videoRepository;

    public function __construct(MusicEloquentRepository $musicRepository, CoverEloquentRepository $coverRepository, VideoEloquentRepository $videoRepository) {
        $this->musicRepository = $musicRepository;
        $this->coverRepository = $coverRepository;
        $this->videoRepository = $videoRepository;
    }
    public function syncAlbum() {
        $arrCat = [3, 4, 5, 6 ,7];
        $album_cat_new = [];
        foreach($arrCat as $cat) {
            $cache = $this->coverRepository->getCategoryCover($cat, 0, ['csn_cover.music_year', CURRENT_YEAR], MAX_LOSTLESS, 'csn_cover.cover_id', 'desc', LIMIT_PAGE_CATEGORY);
            DB::disconnect('mysql');
            $cache = $cache->toArray();
            $album_cat_new[$cat] = [];
            foreach($cache['data'] as $key => $item) {
                $album_artist_id = $item['album_artist_id_1'];
                $album_artist = $item['album_artist_1'];
                if ($item['album_artist_id_2']) {
                    $album_artist_id = $album_artist_id . ';' . $item['album_artist_id_2'];
                    $album_artist = $album_artist . ';' . $item['album_artist_2'];
                }
                $album_cat_new[$cat][] = [
                    'cover_id' => $item['cover_id'],
                    'music_album' => $item['music_album'],
                    'cover_url' => Helpers::cover_url($item['cover_id']),
                    'album_url' => Helpers::album_url($item),
                    'music_artist' => $album_artist,
                    'album_artist_id' => $album_artist_id,
                    'music_artist_html' => !empty($album_artist) ? Helpers::rawHtmlArtists($album_artist_id, $album_artist) : '',
                    'music_bitrate' => $item['music_bitrate'],
                    'music_bitrate_html' => Helpers::bitrate2str($item['music_bitrate']),
                ];
            }
        }
        file_put_contents(resource_path().'/views/cache/def_home_album_cat.blade.php',
'<?php 
if ( !ENV(\'IN_PHPBB\') )
{
    die(\'Hacking attempt\');
    exit;
}
global $album_cat_new;
    
$album_cat_new = ' . var_export($album_cat_new, true) . ';
?>');
        return response(['Ok']);
    }
}