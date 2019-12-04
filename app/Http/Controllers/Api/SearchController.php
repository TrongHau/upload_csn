<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8/17/2018
 * Time: 3:38 PM
 */
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request as Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Music\MusicEloquentRepository;
use App\Library\Helpers;
use App\Solr\Solarium;
use Socialite;
use Session;
use App\Repositories\Category\CategoryEloquentRepository;
use \Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\Session as SessionModel;
use App\Http\Controllers\SearchController as SearchSolr;

class SearchController extends Controller
{
    protected $Solr;

    public function __construct(Solarium $Solr) {
        $this->Solr = $Solr;
    }
    public function index(Request $request) {
        if(!$request->q)
            return new JsonResponse(['message' => 'Fail', 'code' => 400, 'data' => [], 'error' => 'vui lòng nhập thông tin tìm kiếm'], 400);
        $search = mb_strtolower($request->q, 'UTF-8');
        $request->view_music = true;
        $request->view_album = true;
        $request->view_video = true;
        $request->view_artist= true;
        $search = new SearchSolr($this->Solr);
        $result = $search->ajaxSearch($request, $request->quick_search ?? false);
        $result = $result[0];
        $result['q'] = $request->q;
        if($result['album']['data']) {
            foreach ($result['album']['data'] as $key => $item) {
                $result['album']['data'][$key]['album_url'] = Helpers::album_url(['music_album' => $item['music_album'], 'cover_id' => $item['cover_id']]);
            }
        }
        return new JsonResponse(['message' => 'Success', 'code' => 200, 'data' => $result, 'error' => []], 200);
    }

}