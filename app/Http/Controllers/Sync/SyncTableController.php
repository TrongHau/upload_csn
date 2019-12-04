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
use App\Models\CoverModel;
use App\Models\MusicFavouriteModel;
use App\Models\VideoFavouriteModel;
use App\Models\UploadModel;
use App\Models\UserModel;
use App\Repositories\Cover\CoverEloquentRepository;
use App\Repositories\Music\MusicEloquentRepository;
use App\Repositories\Video\VideoEloquentRepository;
use App\Repositories\Category\CategoryEloquentRepository;
use App\Solr\Solarium;
use DB;

class SyncTableController extends Controller
{
    protected $musicRepository;
    protected $coverRepository;
    protected $videoRepository;
    protected $categoryRepository;
    protected $Solr;

    public function __construct(MusicEloquentRepository $musicRepository, CoverEloquentRepository $coverRepository, VideoEloquentRepository $videoRepository, CategoryEloquentRepository $categoryRepository, Solarium $Solr) {
        $this->musicRepository = $musicRepository;
        $this->coverRepository = $coverRepository;
        $this->videoRepository = $videoRepository;
        $this->categoryRepository = $categoryRepository;
        $this->Solr = $Solr;
    }
    public function syncArtistCategoryCover() {
        $cover = CoverModel::with('music')->offset(100000)->limit(10000)->get();
        foreach ($cover as $item) {
            if($item->music) {
                $artists = [];
                $artist_ids = [];
                $bitrates = [];
                $cat = [];
                foreach ($item->music as $music) {
                    $artists = array_merge($artists, explode(';', htmlspecialchars_decode(trim($music->music_artist), ENT_QUOTES)));
                    $artist_ids = array_merge($artist_ids, explode(';', htmlspecialchars_decode(trim($music->music_artist_id), ENT_QUOTES)));
                    $bitrates[] = $music->music_bitrate;
                    $cat[] = $music->cat_id.'_'.$music->cat_level;
                }
                $artistDup = array_count_values($artists);
                $artistIdDup = array_count_values($artist_ids);
                $bitrateDup = array_count_values($bitrates);
                $cat = array_count_values($cat);
                arsort($artistDup);
                arsort($artistIdDup);
                arsort($bitrateDup);
                arsort($cat);
                $artistDup = array_keys($artistDup);
                $artistIdDup = array_keys($artistIdDup);
                $cat = array_keys($cat);
                $item->music_bitrate = isset(array_keys($bitrateDup)[0]) ? array_keys($bitrateDup)[0] : null;
                $item->album_artist_1 = isset($artistDup[0]) ? $artistDup[0] : null;
                $item->album_artist_id_1 = isset($artistIdDup[0]) ? $artistIdDup[0] : null;
                $item->album_artist_2 = isset($artistDup[1]) ? $artistDup[1] : null;
                $item->album_artist_id_2 = isset($artistIdDup[1]) ? $artistIdDup[1] : null;
                $item->album_cat_id_1 = isset($cat[0]) ? explode('_', $cat[0])[0] : null;
                $item->album_cat_level_1 = isset($cat[0]) ? explode('_', $cat[0])[1] : null;
                $item->album_cat_id_2 = isset($cat[1]) ? explode('_', $cat[1])[0] : null;
                $item->album_cat_level_2 = isset($cat[1]) ? explode('_', $cat[1])[1] : null;
                $item->save();
            }
        }
        return response(['Ok']);
    }
    public function user() {
        $user = UserModel::where('user_favourite', '!=', '')->where('user_id', '>=', 811757)->get();
        DB::disconnect('mysql');
        foreach($user as $item) {
            $arrFav = explode(',', $item->user_favourite);
            foreach ($arrFav as $item2) {
                $music = UploadModel::where('music_id', $item2)->where('music_state', '>', -1)->first();
                if($music) {
                    if($music->cat_id == CAT_VIDEO) {
                        VideoFavouriteModel::create([
                            'user_id' => $item->user_id,
                            'music_id' => $item2,
                        ]);
                    }else{
                        MusicFavouriteModel::create([
                            'user_id' => $item->user_id,
                            'music_id' => $item2,
                        ]);
                    }
                }
            }
        }
        return response(['Ok']);
    }
    public function demo() {

    }
}