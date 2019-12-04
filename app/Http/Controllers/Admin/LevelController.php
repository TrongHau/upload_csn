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
use Backpack\CRUD\app\Http\Controllers\CrudController;
// VALIDATION: change the requests to match your own file names if you need form validation
use Backpack\CRUD\app\Http\Requests\CrudRequest as StoreRequest;
use Backpack\CRUD\app\Http\Requests\CrudRequest as UpdateRequest;
use Illuminate\Support\Facades\Auth;



class LevelController extends CrudController
{
    public function __construct()
    {
        $this->middleware(function ($request, $next)
        {
            if(!backpack_user()->can('user_level_(list)')) {
                $this->crud->denyAccess(['list']);
                $this->crud->denyAccess(['create']);
                $this->crud->denyAccess(['update']);
                $this->crud->denyAccess(['delete']);
            }
            if(!backpack_user()->can('user_level_(create)')) {
                $this->crud->denyAccess(['create']);
            }
            if(!backpack_user()->can('user_level_(delete)')) {
                $this->crud->denyAccess(['delete']);
            }
            if(!backpack_user()->can('user_level_(update)')) {
                $this->crud->denyAccess(['update']);
            }
            return $next($request);
        });
        parent::__construct();

    }
    public function setup()
    {
        $this->crud->setModel("App\Models\LevelModel");
        $this->crud->setEntityNameStrings('Các gói cấp độ CSN', 'Các gói cấp độ CSN');
        $this->crud->setRoute(config('backpack.base.route_prefix').'/level');
//        $this->crud->setEntityNameStrings('menu item', 'menu items');

        $this->crud->addColumn([
            'name' => 'level_id',
            'label' => 'ID',
        ]);
        $this->crud->addColumn([
            'name' => 'level_packge',
            'label' => 'Level',
        ]);
        $this->crud->addColumn([
            'name' => 'level_name',
            'label' => 'Tên gói',
        ]);
        $this->crud->addColumn([
            'name' => 'level_time_expried',
            'label' => 'Thời hạn',
        ]);
        $this->crud->addColumn([
            'name' => 'level_cen',
            'type' => 'number',
            'label' => 'giá trị gói',
        ]);
        $this->crud->addColumn([
            'name'  => 'level_status',
            'label' => 'Tình Trạng',
            'type' => 'closure',
            'function' => function($entry) {
                return $entry->level_status == 1 ? '<span class="label label-success">Hoạt động</span>' : '<span class="label label-default">K.hoạt dộng</span>';
            },
        ]);


        $this->crud->addField([
            'name'  => 'level_name',
            'label' => 'Tên gói',
        ]);
        $this->crud->addField([
            'name'  => 'level_time_expried',
            'label' => 'Hạn Mức (format short time)',
        ]);


        $this->crud->addField([
            'name'  => 'level_cen',
            'label' => 'giá trị gói',
            'type' => 'number',
            'max' => 99999999,
            'min' => 0,
            'default' => 0,
        ]);
        $this->crud->addField([
            'name' => 'level_packge',
            'label' => 'Cấp độ',
            'max' => 99,
            'min' => 0,
        ]);
        $this->crud->addField([
            'label' => 'Tình trạng',
            'type' => 'select_from_array',
            'name' => 'level_status',
            'options' => [1 => 'Hoạt động', 0 => 'K.hoạt động'],
            'allows_null' => false,
            'default' => 1,
        ]);

        $this->crud->addField([
            'name'  => 'level_note',
            'label' => 'Ghi chú',
            'type' => 'textarea',
        ]);
    }

    public function store(StoreRequest $request)
    {
        return parent::storeCrud($request);
    }

    public function update(UpdateRequest $request)
    {
        return parent::updateCrud($request);
    }
}