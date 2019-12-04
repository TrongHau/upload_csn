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
use App\Models\UserLogModel;
use DB;

class ReportUserLoginController extends CrudController
{

    public function __construct()
    {
        $this->middleware(function ($request, $next)
        {

            return $next($request);
        });

        parent::__construct();

    }

    public function index()
    {
        $this->crud->hasAccessOrFail('list');
        $this->crud->setOperation('list');

        $this->data['crud'] = $this->crud;
        $this->data['title'] = $this->crud->getTitle() ?? mb_ucfirst($this->crud->entity_name_plural);
        $chart = UserLogModel::select(DB::raw('DATE_FORMAT(FROM_UNIXTIME(log_date), \'%Y-%m-%d\') as date'), DB::raw('count(*) as views, type'))
            ->where('log_date', '>=', strtotime(date('Y-m-d', strtotime(TIME_60DAY_AGO)). ' 00:00'))
            ->groupBy('date', 'type')
            ->get()->toArray();
        $this->data['chart'] = $chart;
        return view('vendor.backpack.report.list_user_login', $this->data);
    }

    public function setup()
    {
//        parent::__construct();
        $this->crud->setModel("App\Models\UserLogModel");
        $this->crud->setEntityNameStrings('Kết quả tìm kiếm', 'User đăng nhập');
        $this->crud->setRoute(config('backpack.base.route_prefix').'/report_user_login');
//        $this->crud->setEntityNameStrings('menu item', 'menu items');


        $this->crud->denyAccess(['create', 'update', 'reorder', 'delete']);
        $this->crud->enableBulkActions();
        $this->crud->addBulkDeleteButton();
        $this->crud->removeAllButtons();

        $this->crud->orderBy('log_date', 'desc');

        $this->crud->addFilter([ // daterange filter
            'type' => 'date_range',
            'name' => 'from_to',
            'label'=> 'Hiển thị theo thời gian'
        ],
            false,
            function($value) {
                $dates = json_decode(htmlspecialchars_decode($value, ENT_QUOTES));
                $this->crud->addClause('where', 'log_date', '>=', strtotime($dates->from . ' 00:00'));
                $this->crud->addClause('where', 'log_date', '<=', strtotime($dates->to . ' 23:59'));
            });
        $this->crud->addFilter([ // dropdown filter
            'name' => 'type',
            'type' => 'dropdown',
            'label'=> 'Thể loại đăng ký'
        ], [
            'facebook' => 'Facebook',
            'google' => 'Google',
            'csn' => 'Tài khoản CSN',
        ], function($value) { // if the filter is active
            $this->crud->addClause('where', 'type', $value);
        });

        $this->crud->addColumn([
            'name'  => 'id',
            'label' => 'User',
            'type' => 'closure',
            'function' => function($entry) {
                $user = $entry->user()->select('name', 'id')->first();
                if($user)
                    return '<a href="/user/'.$user->id.'" target="_blank">'.$user->name.'</a>';
                return '<a href="#" target="_blank">ẩn danh</a>';
            },
        ]);

        $this->crud->addColumn([
            'name' => 'log_date',
            'label' => 'Đăng nhập vào lúc',
            'type' => "datetime",
            'format' => 'Y-m-d H:i'
        ]);
        $this->crud->addColumn([
            'label' => 'Dạng truy cập',
            'name' => 'type',
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