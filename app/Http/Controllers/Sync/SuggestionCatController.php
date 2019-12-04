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
use App\Repositories\Category\CategoryEloquentRepository;
use DB;

class SuggestionCatController extends Controller
{
    protected $musicRepository;
    protected $coverRepository;
    protected $videoRepository;
    protected $categoryRepository;

    public function __construct(MusicEloquentRepository $musicRepository, CoverEloquentRepository $coverRepository, VideoEloquentRepository $videoRepository, CategoryEloquentRepository $categoryRepository) {
        $this->musicRepository = $musicRepository;
        $this->coverRepository = $coverRepository;
        $this->videoRepository = $videoRepository;
        $this->categoryRepository = $categoryRepository;
    }
    public function suggestion() {
        $catregory = $this->categoryRepository->getCategoryParent();
        foreach ($catregory as $item) {
            $childrenCat = $this->categoryRepository->getAllCatId($item->cat_id);
            $model = $this->musicRepository;
            if($item->cat_id == 1) {
                $model = $this->videoRepository;
            }
            foreach ($childrenCat as $level) {
                $typeDup = $model->getQueryPublished()->where(['cat_id' => $item->cat_id, 'cat_level' => $level->cat_level])
                    ->select('music_id', 'cat_id', 'cat_level', 'cover_id', 'music_title_url', 'music_title', 'music_artist', 'music_artist_id', 'music_album_id', 'music_listen', 'music_bitrate', 'music_filename', 'music_width', 'music_height', 'music_length')
//                    ->select( DB::raw('DISTINCT(music_title)') )
//                    ->distinct('music_title')
                    ->limit(200)
                    ->orderBy('music_downloads_today', 'desc')
                    ->orderBy('music_downloads_this_week', 'desc')
                    ->orderBy('music_downloads', 'desc')
                    ->get()->toArray();
                DB::disconnect('mysql');
                foreach ($typeDup as $key => $item2) {
                    $typeDup[$key]['music_artist_html'] = Helpers::rawHtmlArtists($item2['music_artist_id'], $item2['music_artist']);
                    if($item->cat_id == 1) {
                        $typeDup[$key]['music_bitrate_html'] = Helpers::size2str($item2['music_width'], $item2['music_height']);
                    }else{
                        $typeDup[$key]['music_bitrate_html'] = Helpers::bitrate2str($item2['music_bitrate']);
                    }
                }
                $pathDir = resource_path() . '/views/cache/suggestion_cat/';
                file_put_contents($pathDir.$item->cat_id .'_'. $level->cat_level . '.blade.php',
                    '<?php
if ( !ENV(\'IN_PHPBB\') )
{
    die(\'Hacking attempt\');
    exit;
}
global $typeDup;
$typeDup = ' . var_export($typeDup, true) . ';
?>');
            }
        }
        return response(['Ok']);
    }
}