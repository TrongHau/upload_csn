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
use App\Models\LevelModel;
use App\Models\VoucherModel;


class PaymentLogController extends CrudController
{
    public function __construct()
    {
        $this->middleware(function ($request, $next)
        {
            if(!backpack_user()->can('user_level_(list)')) {
                $this->crud->denyAccess(['list']);
            }
            $this->crud->denyAccess(['delete']);
            $this->crud->denyAccess(['create']);
            $this->crud->denyAccess(['update']);
            return $next($request);
        });

        parent::__construct();
    }
    public function setup()
    {
        $this->crud->setModel("App\Models\PaymentModel");
        $this->crud->setEntityNameStrings('Lịch sử giao dịch', 'Lịch sử giao dịch');
        $this->crud->setRoute(config('backpack.base.route_prefix').'/payment_log');
//        $this->crud->setEntityNameStrings('menu item', 'menu items');
        $this->crud->orderBy('payment_id', 'desc');
        $this->crud->removeAllButtons();

        $this->crud->addFilter([ // daterange filter
            'type' => 'date_range',
            'name' => 'from_to',
            'label'=> 'Tìm theo ngày tạo'
        ],
            false,
            function($value) {
                $dates = json_decode(htmlspecialchars_decode($value, ENT_QUOTES));
                $this->crud->addClause('whereDate', 'created_at', '>=', $dates->from);
                $this->crud->addClause('whereDate', 'created_at', '<=', $dates->to);
            });
        $this->crud->addFilter([ // select2_multiple filter
            'name' => 'type_level',
            'type' => 'select2_multiple',
            'label'=> 'Tìm theo gói',
            'placeholder' => 'Tìm theo gói'
        ], function () {
            return LevelModel::orderBy('level_id', 'asc')->pluck('level_name', 'level_id')->toArray();
        }, function ($values) {
            $values = json_decode(htmlspecialchars_decode($values, ENT_QUOTES));
            if (!empty($values)) {
                $this->crud->addClause('where', 'level_id', $values);
            }
        });
        $this->crud->addFilter([ // select2_multiple filter
            'name' => 'type_voucher',
            'type' => 'select2_multiple',
            'label'=> 'Tìm theo voucher',
            'placeholder' => 'Tìm theo voucher'
        ], function () {
            return VoucherModel::orderBy('voucher_id', 'asc')->pluck('voucher_name', 'voucher_id')->toArray();
        }, function ($values) {
            $values = json_decode(htmlspecialchars_decode($values, ENT_QUOTES));
            if (!empty($values)) {
                $this->crud->addClause('where', 'voucher_id', $values);
            }
        });



        $this->crud->addColumn([
            'name' => 'user_id',
            'label' => 'User ID',

        ]);
        $this->crud->addColumn([
            'name' => 'created_at',
            'label' => 'Ngày tạo',
            'type' => 'date',
            'format' => 'd/m/Y H:i',
        ]);
        $this->crud->addColumn([
            'name'  => 'user_id2',
            'label' => 'Tên người tạo',
            'type' => 'closure',
            'function' => function($entry) {
                return '<a href="/user/'.$entry->user_id.'" target="_blank">'.$entry->user->name.'</a>';
            },
        ]);
//        $this->crud->addColumn([
//            'label' => 'Người tạo',
//            'type' => 'select',
//            'name' => 'user_id2',
//            'entity' => 'user',
//            'attribute' => 'name',
//        ]);

        $this->crud->addColumn([
            'label' => 'Gói đang sử dụng',
            'type' => 'select',
            'name' => 'level_id',
            'entity' => 'level',
            'attribute' => 'level_name',
        ]);
        $this->crud->addColumn([
            'label' => 'Hạn mức',
            'type' => 'select',
            'name' => 'level_id_2',
            'entity' => 'level',
            'attribute' => 'level_time_expried',
        ]);
        $this->crud->addColumn([
            'label' => 'Yêu cầu từ',
            'name' => 'request_from',
        ]);

        $this->crud->addColumn([
            'name'  => 'status',
            'label' => 'Tình Trạng',
            'type' => 'closure',
            'function' => function($entry) {
                if($entry->status == 'SUCCESS') {
                    return '<span class="label label-success">Thành Công</span>';
                }elseif ($entry->status == 'PROCESS') {
                    return '<span class="label label-default">Xử Lý</span>';
                }else{
                    return '<span class="label label-danger">Lỗi</span>';
                }
            },
        ]);
        $this->crud->addColumn([
            'label' => 'Voucher',
            'type' => 'select',
            'name' => 'level_id_2',
            'entity' => 'voucher',
            'attribute' => 'voucher_name',
        ]);
        $this->crud->addColumn([
            'name' => 'pay_cen_value',
            'label' => 'Cen trả',
            'type' => 'closure',
            'function' => function($entry) {
                if($entry->cen_promotion > 0) {
                    return number_format($entry->cen_value) . ' - KM: '. number_format($entry->cen_promotion);
                }else{
                    return number_format($entry->cen_value);
                }
            },
        ]);
        $this->crud->addColumn([
            'name' => 'pay_money_value',
            'label' => 'Tiền VNĐ',
            'type' => 'closure',
            'function' => function($entry) {
                if($entry->money_promotion > 0) {
                    return number_format($entry->money_value) . ' - KM: '. number_format($entry->money_promotion);
                }else{
                    return number_format($entry->money_value);
                }
            },
        ]);
        $this->crud->addColumn([
            'name' => 'note',
            'label' => 'Ghi chú',
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