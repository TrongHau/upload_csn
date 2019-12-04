<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8/17/2018
 * Time: 3:38 PM
 */
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use \Illuminate\Http\JsonResponse;
use Illuminate\Http\Request as Request;
use Illuminate\Support\Facades\Auth;
use App\Library\Helpers;
use App\Repositories\Category\CategoryEloquentRepository;

class BxhController extends Controller
{
    protected $categoryListenRepository;

    public function __construct(CategoryEloquentRepository $categoryListenRepository) {
        $this->categoryListenRepository = $categoryListenRepository;
    }
    public function now(Request $request) {
        $titleBxh = 'Bảng xếp hạng hot trong ngày';
        $category = $this->categoryListenRepository->getAllParentCategory(0, [['cat_id', '!=', 1]]);
        global $hot_music_rows;
        global $hot_video_rows;
        include(app_path() . '/../resources/views/cache/bxh/bxh_today.blade.php');
        $dataBxh = [];
        foreach ($category as $item) {
            $dataBxh[$item->cat_id] = [
                'cat_name' => $item->cat_short_title,
                'cat_url' => $item->cat_url,
                'music' => $hot_music_rows[$item->cat_id] ?? [],
                'video' => $hot_video_rows[$item->cat_id - 2] ?? []
            ];
        }
        return new JsonResponse(['message' => 'Success', 'code' => 200, 'data' => ['dataBxh' => Helpers::convertArrHtmlCharsDecode($dataBxh), 'titleBxh' => $titleBxh], 'error' => []], 200);
    }
    public function week(Request $request, $cat = false) {
        $titleBxh = 'Bảng xếp hạng hot trong tuần';
        $category = $this->categoryListenRepository->getAllParentCategory(0, [['cat_id', '!=', 1]]);
        global $hot_music_rows;
        global $hot_video_rows;
        include(app_path() . '/../resources/views/cache/bxh/bxh_week.blade.php');
        $dataBxh = [];
        foreach ($category as $item) {
            $dataBxh[$item->cat_id] = [
                'cat_name' => $item->cat_short_title,
                'music' => $hot_music_rows[$item->cat_id] ?? [],
                'video' => $hot_video_rows[$item->cat_id - 2] ?? []
            ];
        }
        return new JsonResponse(['message' => 'Success', 'code' => 200, 'data' => ['dataBxh' => Helpers::convertArrHtmlCharsDecode($dataBxh), 'titleBxh' => $titleBxh], 'error' => []], 200);
    }
    public function month(Request $request, $month, $year, $cat = false) {
        $cacheBxh = 'bxh_'.sprintf('%02d', $month).'_'.$year;
        $titleBxh = 'Bảng xếp hạng hot trong tháng ' . $month . ' năm '.$year;
        $category = $this->categoryListenRepository->getAllParentCategory(0, [['cat_id', '!=', 1]]);
        global $hot_music_rows;
        global $hot_video_rows;
        include(app_path() . '/../resources/views/cache/bxh/'.$cacheBxh.'.blade.php');
        $dataBxh = [];
        foreach ($category as $item) {
            $dataBxh[$item->cat_id] = [
                'cat_name' => $item->cat_short_title,
                'music' => $hot_music_rows[$item->cat_id] ?? [],
                'video' => $hot_video_rows[$item->cat_id - 2] ?? []
            ];
        }
        return new JsonResponse(['message' => 'Success', 'code' => 200, 'data' => ['dataBxh' => Helpers::convertArrHtmlCharsDecode($dataBxh), 'titleBxh' => $titleBxh], 'error' => []], 200);
    }
    public function year(Request $request, $year, $cat = false) {
        $cacheBxh = 'bxh_all_'.$year;
        $titleBxh = 'Bảng xếp hạng hot trong năm '.$year;
        $category = $this->categoryListenRepository->getAllParentCategory(0, [['cat_id', '!=', 1]]);
        global $hot_music_rows;
        global $hot_video_rows;
        include(app_path() . '/../resources/views/cache/bxh/'.$cacheBxh.'.blade.php');
        $dataBxh = [];
        foreach ($category as $item) {
            $dataBxh[$item->cat_id] = [
                'cat_name' => $item->cat_short_title,
                'music' => $hot_music_rows[$item->cat_id] ?? [],
                'video' => $hot_video_rows[$item->cat_id - 2] ?? []
            ];
        }
        return new JsonResponse(['message' => 'Success', 'code' => 200, 'data' => ['dataBxh' => Helpers::convertArrHtmlCharsDecode($dataBxh), 'titleBxh' => $titleBxh], 'error' => []], 200);
    }
}