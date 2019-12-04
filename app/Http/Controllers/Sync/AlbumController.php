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

class AlbumController extends Controller
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
        $cache = $this->coverRepository->getCoverNew('album_last_updated');
        DB::disconnect('mysql');
        $album_new = [];
        foreach($cache as $key => $item) {
            $album_artist_id = $item->album_artist_id_1;
            $album_artist = $item->album_artist_1;
            if ($item->album_artist_id_2) {
                $album_artist_id = $album_artist_id . ';' . $item->album_artist_id_2;
                $album_artist = $album_artist . ';' . $item->album_artist_2;
            }
            $album_new[] = [
                'cover_id' => $item->cover_id,
                'music_album' => $item->music_album,
                'album_url' => Helpers::album_url(['cover_id' => $item->cover_id, 'music_album' => $item->music_album]),
                'cover_url' =>  Helpers::cover_url($item->cover_id),
                'music_artist' => $album_artist,
                'music_artist_html' => !empty($album_artist) ? Helpers::rawHtmlArtists($album_artist_id, $album_artist) : '',
                'music_bitrate' => $item->music_bitrate,
                'music_bitrate_html' => Helpers::bitrate2str($item->music_bitrate),
            ];
        }
        $cache = $this->coverRepository->getCoverNew2();
        DB::disconnect('mysql');
        $album_old = [];
        foreach($cache as $item) {
            $album_artist_id = $item->album_artist_id_1;
            $album_artist = $item->album_artist_1;
            if ($item->album_artist_id_2) {
                $album_artist_id = $album_artist_id . ';' . $item->album_artist_id_2;
                $album_artist = $album_artist . ';' . $item->album_artist_2;
            }
            $album_old[] = [
                'cover_id' => $item->cover_id,
                'music_album' => $item->music_album,
                'album_url' => Helpers::album_url(['cover_id' => $item->cover_id, 'music_album' => $item->music_album]),
                'cover_url' =>  Helpers::cover_url($item->cover_id),
                'music_artist' => $album_artist,
                'music_artist_id' => $album_artist_id,
                'music_artist_html' => !empty($album_artist) ? Helpers::rawHtmlArtists($album_artist_id, $album_artist) : '',
                'music_bitrate' => $item->music_bitrate,
                'music_bitrate_html' => Helpers::bitrate2str($item->music_bitrate),
            ];
        }
        $music_new_uploads_tmp = $this->musicRepository->getQueryPublished()->select('music_id', 'music_title_url', 'music_title', 'music_artist', 'music_artist_id', 'cat_id', 'cat_level', 'cat_sublevel', 'cat_custom', 'cover_id', 'music_download_time', 'music_last_update_time', 'music_title_url',
                'music_title_search', 'music_artist_search', 'music_album_search', 'music_composer', 'music_album', 'music_listen', 'music_track_id', 'music_track_id', 'music_filename', 'music_bitrate', 'music_shortlyric', 'music_last_update_time', 'music_time')
//            ->groupBy('music_artist_id')
            ->orderBy('music_year', 'desc')
            ->orderBy('music_id', 'desc')
            ->limit(200)->get()->toArray();
        $music_new_uploads_artist = [];
        foreach ($music_new_uploads_tmp as $key => $item) {
            $music_new_uploads_artist[$item['music_artist_id']] = isset($music_new_uploads_artist[$item['music_artist_id']]) ? $music_new_uploads_artist[$item['music_artist_id']] + 1 : 1;
            if ($music_new_uploads_artist[$item['music_artist_id']] < 3) {
                $total = isset($total) ? $total + 1 : 0;
                if ($total > 19) break;

                $music_new_uploads[$total] = $music_new_uploads_tmp[$key];
                $music_new_uploads[$total]['cover_html'] = Helpers::cover_url($item['cover_id'], explode(';', $item['music_artist_id'])[0]);
                $music_new_uploads[$total]['music_url'] = Helpers::listen_url($item, false);
                $music_new_uploads[$total]['music_bitrate_html'] = Helpers::bitrate2str($item['music_bitrate']);
                $music_new_uploads[$total]['music_artist_html'] = Helpers::rawHtmlArtists($item['music_artist_id'], $item['music_artist']);
            }
        }
        $video_new_uploads = $this->videoRepository->getModel()::orderBy('music_last_update_time', 'desc')
            ->select('music_id', 'music_title_url', 'music_title', 'music_artist', 'music_artist_id', 'cat_id', 'cat_level', 'cat_sublevel', 'cat_custom', 'cover_id', 'music_download_time', 'music_last_update_time', 'music_title_url',
                'music_title_search', 'music_artist_search', 'music_album_search', 'music_composer', 'music_album', 'music_listen', 'music_track_id', 'music_track_id', 'music_filename', 'music_bitrate', 'music_shortlyric', 'music_last_update_time', 'music_length', 'music_time', 'music_width', 'music_height')
            ->limit(50)->get()->toArray();
        foreach ($video_new_uploads as $key => $item) {
            $video_new_uploads[$key]['cover_html'] = Helpers::thumbnail_url($item);
            $video_new_uploads[$key]['cover_prv_html'] = Helpers::thumbnail_url($item, 'preview');
            $video_new_uploads[$key]['music_url'] = Helpers::listen_url($item, false);
            $video_new_uploads[$key]['music_bitrate_html'] = Helpers::size2str($item['music_width'], $item['music_height']);
            $video_new_uploads[$key]['music_artist_html'] = Helpers::rawHtmlArtists($item['music_artist_id'], $item['music_artist']);
        }

        file_put_contents(resource_path().'/views/cache/def_home_album.blade.php',
'<?php 
if ( !ENV(\'IN_PHPBB\') )
{
    die(\'Hacking attempt\');
    exit;
}
global $album_hot;
global $album_new;
global $album_old;
global $music_new_uploads;
global $video_new_uploads;
    
$album_hot = ' . var_export($album_new, true) . ';
$album_new = ' . var_export($album_new, true) . ';
$album_old = ' . var_export($album_old, true) . ';
$music_new_uploads = ' . var_export($music_new_uploads, true) . ';   
$video_new_uploads = ' . var_export($video_new_uploads, true) . ';     
?>');
        return response(['Ok']);
    }
}