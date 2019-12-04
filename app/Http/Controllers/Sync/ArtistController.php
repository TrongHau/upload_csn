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
use App\Repositories\Artist\ArtistRepository;
use DB;

class ArtistController extends Controller
{
    protected $musicRepository;
    protected $coverRepository;
    protected $videoRepository;
    protected $artistRepository;

    public function __construct(MusicEloquentRepository $musicRepository, CoverEloquentRepository $coverRepository, VideoEloquentRepository $videoRepository, ArtistRepository $artistRepository) {
        $this->musicRepository = $musicRepository;
        $this->coverRepository = $coverRepository;
        $this->videoRepository = $videoRepository;
        $this->artistRepository = $artistRepository;
    }
    public function topArtist() {
        $musics = $this->musicRepository->getQueryPublished()->where('music_downloads_this_week', '>', 5)->select('music_artist_id', 'music_downloads_this_week')->orderBy('music_downloads_this_week', 'desc')->get();
        $top_artist_rows = [];
        foreach($musics as $item) {
            $music_artist_id = explode(';', $item->music_artist_id);
            foreach ($music_artist_id as $ar) {
                if ( $ar > 0 ) {
                    if (($top_artist_rows[$ar]['music_total'] ?? 0) < 5) {
                        $top_artist_rows[$ar] = [
                            'music_downloads_this_week' => ($top_artist_rows[$ar]['music_downloads_this_week'] ?? 0) + $item->music_downloads_this_week,
                            'music_total' => ($top_artist_rows[$ar]['music_total'] ?? 0) + 1,
                            'id' => $ar
                        ];
                    }
                }
            }
        }
        rsort($top_artist_rows);
        $result = [];
        foreach ($top_artist_rows as $key => $item) {
            $artist = $this->artistRepository->getModel()::find($item['id']);
            if($artist) {
                $result[] = [
                    'music_artist_points' => $item['music_downloads_this_week'],
                    'music_artist' => $artist->artist_nickname,
                    'artist_face_id' => $item['id'],
                    'artist_avatar' => $artist->artist_avatar ? Helpers::file_path($artist->artist_id, PUBLIC_AVATAR_ARTIST_PATH, true).$artist->artist_avatar : '/imgs/no_cover.jpg',
                    'artist_cover' => $artist->artist_cover ? Helpers::file_path($artist->artist_id, PUBLIC_COVER_ARTIST_PATH, true).$artist->artist_cover : '/imgs/no_cover_artist.jpg',
                    'artist_url' => Helpers::artistUrl($item['id'], $artist->artist_nickname),
                    'music_total' => $item['music_total']
                ];
            }
            if($key == 20)
                break;
        }
        file_put_contents(resource_path() . '/views/cache/top_artist.blade.php',
                    '<?php 
if ( !ENV(\'IN_PHPBB\') )
{
    die(\'Hacking attempt\');
    exit;
}
global $top_artist_rows;
$top_artist_rows = ' . var_export($result, true) . ';
?>');
        return response(['Ok']);
    }
}