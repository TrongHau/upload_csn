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



class VoucherController extends CrudController
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
        $this->crud->setModel("App\Models\VoucherModel");
        $this->crud->setEntityNameStrings('Các gói Voucher CSN', 'Các gói Voucher CSN');
        $this->crud->setRoute(config('backpack.base.route_prefix').'/voucher');
//        $this->crud->setEntityNameStrings('menu item', 'menu items');

        $this->crud->addColumn([
            'name' => 'voucher_id',
            'label' => 'ID',
        ]);
        $this->crud->addColumn([
            'name' => 'voucher_name',
            'label' => 'Tên voucher',
        ]);
        $this->crud->addColumn([
            'name' => 'voucher_pay_cen',
            'label' => 'Giá trị voucher',
            'type' => 'number',
        ]);
        $this->crud->addColumn([
            'name' => 'gift_value_cen',
            'label' => 'Cen được tặng',
            'type' => 'number',
        ]);
        $this->crud->addColumn([
            'label' => 'Gói level',
            'type' => 'select',
            'name' => 'level_id',
            'entity' => 'level',
            'attribute' => 'level_name',
        ]);
        $this->crud->addColumn([
            'name'  => 'voucher_note',
            'label' => 'Note Voucher',
        ]);
        $this->crud->addColumn([
            'name'  => 'voucher_status',
            'label' => 'Tình Trạng',
            'type' => 'closure',
            'function' => function($entry) {
                return $entry->voucher_status == 1 ? '<span class="label label-success">Hoạt động</span>' : '<span class="label label-default">K.hoạt dộng</span>';
            },
        ]);


        $this->crud->addField([
            'name'  => 'voucher_name',
            'label' => 'Tên voucher',
        ]);
        $this->crud->addField([
            'name' => 'gift_value_cen',
            'label' => 'Cen được tặng',
            'type' => 'number',
            'max' => 99999,
            'min' => 0,
            'default' => 0,
        ]);
        $this->crud->addField([
            'name'  => 'value_cen',
            'label' => 'giá trị voucher',
            'type' => 'number',
            'max' => 99999,
            'min' => 0,
            'default' => 0,
        ]);
//        $this->crud->addField([       // Select2Multiple = n-n relationship (with pivot table)
//            'label' => 'Áp dụng gói',
//            'type' => 'select',
//            'name' => 'level_id', // the method that defines the relationship in your Model
//            'entity' => 'levelEnable', // the method that defines the relationship in your Model
//            'attribute' => 'level_name', // foreign key attribute that is shown to user
//        ]);
        $this->crud->addField([
            'label' => 'Áp dụng gói',
            'type' => 'select_from_array',
            'name' => 'level_id',
            'options' => \App\Models\LevelModel::where('level_status', 1)->pluck('level_name', 'level_id')->toArray(),
            'allows_null' => true,
        ]);

        $this->crud->addField([
            'label' => 'Tình trạng',
            'type' => 'select_from_array',
            'name' => 'voucher_status',
            'options' => [1 => 'Hoạt động', 0 => 'K.hoạt động'],
            'allows_null' => false,
            'default' => 1,
        ]);
        $this->crud->addField([
            'name'  => 'voucher_note',
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