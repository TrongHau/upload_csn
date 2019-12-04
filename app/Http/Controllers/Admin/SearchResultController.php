<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8/17/2018
 * Time: 3:38 PM
 */
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request as Request;

use App\Http\Requests;
use App\Library\Helpers;
use Backpack\CRUD\app\Http\Controllers\CrudController;
// VALIDATION: change the requests to match your own file names if you need form validation
use Backpack\CRUD\app\Http\Requests\CrudRequest as StoreRequest;
use Backpack\CRUD\app\Http\Requests\CrudRequest as UpdateRequest;
use Illuminate\Support\Facades\Auth;
use App\Repositories\SearchResult\SearchResultEloquentRepository;
use App\Repositories\Music\MusicEloquentRepository;
use App\Repositories\User\UserEloquentRepository;
use DB;

class SearchResultController extends CrudController
{

    public function __construct()
    {
        $this->middleware(function ($request, $next)
        {
            if(!backpack_user()->can('search_results(list)')) {
                $this->crud->denyAccess(['list']);
            }
            return $next($request);
        });

        parent::__construct();
    }

    public function setup()
    {
//        parent::__construct();
        $this->crud->setModel("App\Models\MusicSearchResultReportModel");
        $this->crud->setEntityNameStrings('Kết quả tìm kiếm', 'Kết quả tìm kiếm');
        $this->crud->setRoute(config('backpack.base.route_prefix').'/search_results');
//        $this->crud->setEntityNameStrings('menu item', 'menu items');


        $this->crud->denyAccess(['create', 'update', 'reorder', 'delete']);
        $this->crud->enableBulkActions();
        $this->crud->addBulkDeleteButton();
        $this->crud->removeAllButtons();


//        $this->crud->groupBy('music_id', 'music_title');
        $this->crud->orderBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')"), 'desc');
        $this->crud->orderBy('music_search_count', 'desc');

//        $this->crud->addColumn([
//            'name' => 'music_search_count',
//            'label' => 'Truy cập',
//            'type' => "model_function",
//            'function_name' => 'getTotalSum',
//        ]);
//        $this->crud->addClause('whereDate', 'created_at', '>=', date('Y-m-d', time()));
        $this->crud->addFilter([ // daterange filter
            'type' => 'date_range',
            'name' => 'from_to',
            'label'=> 'Hiển thị theo thời gian'
        ],
            false,
            function($value) {
                $dates = json_decode(htmlspecialchars_decode($value, ENT_QUOTES));
                $this->crud->addClause('whereDate', 'created_at', '>=', $dates->from);
                $this->crud->addClause('whereDate', 'created_at', '<=', $dates->to);
//                $this->crud->removeColumns(['music_title']);
//                $this->crud->removeColumns(['created_at']);


//                $this->crud->groupBy('music_id');
//                $this->crud->orderBy('music_search_count', 'desc');

//
//                $this->crud->query = $this->crud->query->selectRaw('music_id, sum(music_search_count) as music_search_count')
//                    ->groupBy('csn_music_search_result.music_id');

            });



        $this->crud->addColumn([
            'name'  => 'music_id',
            'label' => 'ID',
            'type' => 'closure',
            'function' => function($entry) {
                return '<a href="/user/music_uploaded/redirect/'.$entry->music_id.'" target="_blank">'.$entry->music_id.'</a>';
            },
        ]);
        $this->crud->addColumn([
            'name' => 'music_title',
            'label' => 'Bài hát (video)',
        ]);
        $this->crud->addColumn([
            'name' => 'music_search_count',
            'label' => 'Truy cập',
        ]);
        $this->crud->addColumn([
            'name' => 'updated_at',
            'label' => 'Cập nhật',
            'type' => "datetime",
            'format' => 'Y-m-d H:i'
        ]);

//        $this->crud->addButtonFromView('line', 'view', 'show', 'end');

    }
    public function store(StoreRequest $request)
    {
        return parent::storeCrud();
    }
    public function destroy($id)
    {
        $this->crud->hasAccessOrFail('delete');

        // get entry ID from Request (makes sure its the last ID for nested resources)
        $id = $this->crud->getCurrentEntryId() ?? $id;
        return $this->crud->delete($id);
    }
    public function update(UpdateRequest $request)
    {
        return parent::updateCrud();
    }
}