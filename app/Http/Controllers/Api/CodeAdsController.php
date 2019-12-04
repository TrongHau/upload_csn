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
use App\Repositories\CodeAds\CodeAdsEloquentRepository;
use App\Http\Controllers\Controller;
use \Illuminate\Http\JsonResponse;

class CodeAdsController extends Controller
{
    protected $codeAdsRepository;

    public function __construct(CodeAdsEloquentRepository $codeAdsRepository) {
        $this->codeAdsRepository = $codeAdsRepository;
    }
    public function index(Request $request) {
        if(!$request->key)
            return new JsonResponse(['message' => 'Fail', 'code' => 400, 'data' => [], 'error' => 'không tìm thấy từ khóa'], 400);
        $content = $this->codeAdsRepository->getModel()::where('key', $request->key)->first();
        if(!$content)
            return new JsonResponse(['message' => 'Fail', 'code' => 400, 'data' => [], 'error' => 'không tìm thấy Code quảng cáo'], 400);
        $code = '';
        $arrLink = [];
        if($content->type == 'ARRAY LINK') {
            ($content->code1 ? ( $arrLink[] = $content->code1) : null);
            ($content->code2 ? ( $arrLink[] = $content->code2) : null);
            ($content->code3 ? ( $arrLink[] = $content->code3) : null);
            ($content->code4 ? ( $arrLink[] = $content->code4) : null);
            ($content->code5 ? ( $arrLink[] = $content->code5) : null);
            ($content->code6 ? ( $arrLink[] = $content->code6) : null);
            ($content->code7 ? ( $arrLink[] = $content->code7) : null);
            ($content->code8 ? ( $arrLink[] = $content->code8) : null);
            ($content->code9 ? ( $arrLink[] = $content->code9) : null);
            ($content->code10 ? ( $arrLink[] = $content->code10) : null);
        }else{
            $ranD = rand(1, 10);
            $code = $content['code'.$ranD];
        }
        return new JsonResponse(['message' => 'Success', 'code' => 200, 'data' => [
            'name' => $content->name,
            'key' => $content->key,
            'type' => $content->type,
            'description' => $content->description,
            'code_html' => $code,
            'array_link' => $arrLink,
            'updated_at' => $content->updated_at,
        ], 'error' => ''], 200);
    }

}