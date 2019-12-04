<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8/17/2018
 * Time: 3:38 PM
 */
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request as Request;
use Illuminate\Support\Facades\Auth;
use App\Library\Helpers;
use App\Http\Controllers\Controller;
use \Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
    public function __construct() {

    }
    public function index(Request $request) {
        global $album_hot;
        global $album_new;
        global $album_old;
        global $download_rows;
        global $top_uploader_rows;
        global $music_new_uploads;
        global $video_new_uploads;
        global $album_cat_new;
        include(app_path() . '/../resources/views/cache/def_home_album.blade.php');
        include(app_path() . '/../resources/views/cache/def_home_download.blade.php');
        include(app_path() . '/../resources/views/cache/def_home_album_cat.blade.php');

//        $video_new_uploads = Helpers::convertArrHtmlCharsDecode($video_new_uploads);
        $music_new_uploads = Helpers::convertArrHtmlCharsDecode($music_new_uploads);
        $album_new = Helpers::convertArrHtmlCharsDecode($album_new);
        $album_cat_new = Helpers::convertArrHtmlCharsDecode($album_cat_new);
        foreach ($video_new_uploads as $key => &$item) {
            $item = Helpers::convertArrHtmlCharsDecode($item);
            $item['cover_html'] = $item['cover_prv_html'];
        }
        return new JsonResponse(['message' => 'Success', 'code' => 200, 'data' => [
            'album_hot_home' => Helpers::getRandLimitArr($album_new, LIMIT_HOME_ALBUM_NEW_MOBILE),
            'album_new_home' => Helpers::getRandLimitArr($album_new, LIMIT_HOME_MUSIC_NEW),
            'music_new_home' => Helpers::getRandLimitArr($music_new_uploads, LIMIT_HOME_ALBUM_OLD_MOBILE),
            'video_new_home' => Helpers::getRandLimitArr($video_new_uploads, LIMIT_HOME_VIDEO_NEW_MOBILE),
            'album_cat_new_vn' => Helpers::getRandLimitArr($album_cat_new[3], LIMIT_HOME_CAT_MUSIC),
            'album_cat_new_us_uk' => Helpers::getRandLimitArr($album_cat_new[4], LIMIT_HOME_CAT_MUSIC),
            'album_cat_new_china' => Helpers::getRandLimitArr($album_cat_new[5], LIMIT_HOME_CAT_MUSIC),
            'album_cat_new_k_pop' => Helpers::getRandLimitArr($album_cat_new[6], LIMIT_HOME_CAT_MUSIC),
            'album_cat_new_japan' => Helpers::getRandLimitArr($album_cat_new[7], LIMIT_HOME_CAT_MUSIC),
            'music_new_tab' => $music_new_uploads,
            'video_new_tab' => $video_new_uploads,
        ], 'error' => []], 200);
    }

}