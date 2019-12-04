<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8/17/2018
 * Time: 3:38 PM
 */
namespace App\Http\Controllers;
use Illuminate\Http\Request as Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Music\MusicEloquentRepository;
use App\Library\Helpers;
use App\Solr\Solarium;
use App\Repositories\Category\CategoryEloquentRepository;
use App\Models\ErrorBugSlowModel;
use Jenssegers\Agent\Agent;

class SystemController extends Controller
{
    public function addBugSlow(Request $request) {
        ErrorBugSlowModel::firstOrCreate([
            'type' => 'file_not_found',
            'link' => $request->url,
            'device_display' => $request->display_by,
            'ip_address' => Helpers::getIp(),
        ]);
    }
}