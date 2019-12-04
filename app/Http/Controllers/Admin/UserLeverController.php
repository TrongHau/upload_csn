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
use App\Models\UserModel;
use App\Models\LevelModel;
use App\Models\VoucherModel;
use App\Models\PaymentModel;
use App\Library\Helpers;
use App\Models\UserLevelModel;
use DB;

class UserLeverController extends CrudController
{
    public function __construct()
    {
        $this->middleware(function ($request, $next)
        {
            if(!backpack_user()->can('user_level_(list)')) {
                $this->crud->denyAccess(['list']);
            }
            if(!backpack_user()->can('user_level_(create)')) {
                $this->crud->denyAccess(['create']);
            }
            if(!backpack_user()->can('user_level_(update)')) {
                $this->crud->denyAccess(['update']);
            }
            $this->crud->denyAccess(['delete']);
            return $next($request);
        });
        parent::__construct();
    }
    public function setup()
    {
        $this->crud->setModel("App\Models\UserLevelModel");
        $this->crud->setEntityNameStrings('Cấp độ hoặc chỉnh sửa level của user', 'Cấp độ user đã mua');
        $this->crud->setRoute(config('backpack.base.route_prefix').'/history_level');
//        $this->crud->setEntityNameStrings('menu item', 'menu items');

//        $this->crud->addColumn([
//            'name' => 'user_id',
//            'label' => 'User ID',
//        ]);
        $this->crud->addFilter([ // daterange filter
            'type' => 'date_range',
            'name' => 'from_to',
            'label'=> 'Tìm theo hạn mức'
        ],
            false,
            function($value) {
                $dates = json_decode(htmlspecialchars_decode($value, ENT_QUOTES));
                $this->crud->addClause('where', 'level_expried', '>=', strtotime($dates->from . ' 00:00'));
                $this->crud->addClause('where', 'level_expried', '<=',  strtotime($dates->to . ' 23:59'));
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

        $this->crud->addFilter([ // dropdown filter
            'name' => 'status',
            'type' => 'dropdown',
            'label'=> 'Tình Trạng'
        ], [
            1 => 'Hoạt động',
            0 => 'V.hiệu hóa',
        ], function($value) { // if the filter is active
            $this->crud->addClause('where', 'level_status', $value);
        });

        $this->crud->addColumn([
            'name'  => 'user_id',
            'label' => 'User ID',
//            'type' => 'closure',
//            'function' => function($entry) {
//                return '<a href="/user/'.$entry->user_id.'" target="_blank">'.$entry->user_id.'</a>';
//            },
        ]);
        $this->crud->addColumn([
            'label' => 'Người tạo',
            'type' => 'select',
            'name' => 'name',
            'entity' => 'user',
            'attribute' => 'name',
        ]);
        $this->crud->addColumn([
            'label' => 'Cen hiện có',
            'type' => 'select',
            'name' => 'nameư',
            'entity' => 'user',
            'attribute' => 'user_money',
        ]);
        $this->crud->addColumn([
            'label' => 'Gói đang sử dụng',
            'type' => 'select',
            'name' => 'level_id',
            'entity' => 'level',
            'attribute' => 'level_name',
        ]);
        $this->crud->addColumn([
            'label' => 'Hạn mức của gói',
            'type' => 'select',
            'name' => 'level_id_2',
            'entity' => 'level',
            'attribute' => 'level_time_expried',
        ]);

        $this->crud->addColumn([
            'name'  => 'level_expried',
            'label' => 'Ngày hết hạn',
            'type' => 'closure',
            'function' => function($entry) {
                return $entry->level_expried >= time() ? '<span class="label label-success" style="font-size: 90%">'.date('d/m/Y H:i', $entry->level_expried).'</span>' : '<span class="label label-danger" style="font-size: 90%">'.date('H:i - d/m/Y', $entry->level_expried).'</span>';
            },
        ]);
        $this->crud->addColumn([
            'name'  => 'level_status',
            'label' => 'Tình Trạng',
            'type' => 'closure',
            'function' => function($entry) {
                return $entry->level_status == 1 ? '<span class="label label-success">Hoạt động</span>' : '<span class="label label-danger">V.hiệu hóa</span>';
            },
        ]);


        $this->crud->addField([
            'label' => "Chọn người dùng", // Table column heading
            'type' => "select2_from_ajax",
            'name' => 'user_id', // the column that contains the ID of that connected entity
            'entity' => 'user', // the method that defines the relationship in your Model
            'attribute' => "name", // foreign key attribute that is shown to user
            'data_source' => url("admin/history_level/search_user"), // url to controller search function (with /{id} should return model)
            'placeholder' => "Lựa chọn người dùng", // placeholder for the select
            'minimum_input_length' => 2, // minimum characters to type before querying results
        ]);
        $this->crud->addField([
            'label' => 'Áp dụng gói',
            'type' => 'select_from_array',
            'name' => 'level_id',
            'options' => \App\Models\LevelModel::where('level_status', 1)->select(DB::Raw("CONCAT(level_name, ' - Cấp: ', level_packge,' - Cen: ', level_cen, ' ', level_time_expried) as level_name"), 'level_id')->pluck('level_name', 'level_id', 'level_time_expired')->toArray(),
            'allows_null' => true,
        ]);
        $this->crud->addField([
            'label' => 'Áp dụng voucher',
            'type' => 'select_from_array',
            'name' => 'voucher_id',
            'options' => \App\Models\VoucherModel::where('voucher_status', 1)->pluck('voucher_name', 'voucher_id')->toArray(),
            'allows_null' => true,
        ]);
        $this->crud->addField([
            'name' => 'level_status',
            'label' => 'Tình trạng',
            'type' => 'checkbox'
        ]);


        $this->crud->setEditView('vendor.backpack.user_level.edit_user_level');
        $this->crud->setCreateView('vendor.backpack.user_level.add_user_level');
    }

    public function searchUser(Request $request)
    {
        $search_term = $request->input('q');
        $page = $request->input('page');

        if ($search_term)
        {
            $results = UserModel::select(DB::raw("CONCAT(name, ' - ', email, ' - Cen: ', user_money) as name, user_id, user_id as id"))

                ->where(function($q) use ($search_term) {
                    $q->where('user_id', $search_term)
                        ->orWhere('email', 'LIKE', '%'.$search_term.'%')
                        ->orWhere('user_id', $search_term);
                })
                ->paginate(10);
        }
        else
        {
            $results = UserModel::paginate(10);
        }

        return $results;
    }
    public function showLevelUser(Request $request, $id) {
        $userLevel = UserLevelModel::where('user_id', $id)->with('level')->first();
        if($userLevel) {
            $userLevel['d_level_expried'] = date('H:i - d/m/Y', $userLevel->level_expried);
            Helpers::ajaxResult(true, '', $userLevel);
        }
        Helpers::ajaxResult(false, '', []);
    }
    public function showLevel(Request $request, $id) {
        $level = LevelModel::where('level_id', $id)->first();
        $level['d_level_time_expried'] = date('H:i - d/m/Y', strtotime($level->level_time_expried));
        Helpers::ajaxResult(true, '', $level);
    }
    public function showVoucher(Request $request, $id) {
        $voucher = VoucherModel::where('voucher_id', $id)->with('levelEnableRow')->first();
        Helpers::ajaxResult(true, '', $voucher);
    }
    public function showUser($id)
    {
        return UserModel::find($id);
    }
    public function store(StoreRequest $request)
    {
        $this->crud->hasAccessOrFail('create');
        $this->crud->setOperation('create');
        if (is_null($request)) {
            $request = \Request::instance();
        }
        $user = UserModel::find($request->user_id);
        if(!$user) {
            \Alert::error('User không tồn tại')->flash();
            return redirect()->back();
        }
        $userLevel = UserLevelModel::where('user_id', $request->user_id)->with('level')->first();
        $payment = [
            'user_id' => $user->user_id,
            'level_id' => null,
            'voucher_id' => null,
            'cen_value' => 0,
            'cen_add' => 0,
            'status' => 'SUCCESS',
            'request_from' => 'ADMIN',
            'cen_promotion' => 0,
            'cen_current_user' => $user->user_money,
            'note' => 'Admin cung cấp',
        ];
        $level = [];
        if($request->level_id) {
            $level = LevelModel::where('level_id', $request->level_id)->where('level_status', 1)->first();
            $payment['level_id'] = $level->level_id;
            $payment['level_cen'] = $level->level_cen;
            $payment['level_money'] = $level->level_money;
            $payment['time_add_expired'] = $level->level_time_expried;
//            $payment['cen_value'] = $level->level_cen;
        }else{
            $voucher = VoucherModel::where('voucher_id', $request->voucher_id)->where('voucher_status', 1)->with('levelEnableRow')->first();
            $payment['voucher_id'] = $voucher->voucher_id;
            $payment['cen_add'] = $voucher->gift_value_cen;
            if(isset($voucher->levelEnableRow)) {
                $level = $voucher->levelEnableRow;
                $payment['level_id'] = $voucher->levelEnableRow->level_id;
                $payment['time_add_expired'] = $voucher->levelEnableRow->level_time_expried;
                $payment['level_cen'] = $voucher->levelEnableRow->level_cen;
                $payment['level_money'] = $voucher->levelEnableRow->level_money;
//                $payment['cen_value'] = $voucher->levelEnableRow->level_cen;
            }

        }
        if($level) {
            if($userLevel) {
                if($userLevel->level->level_packge != $level->level_packge) {
                    if($userLevel->level->level_packge > $level->level_packge) {
                        \Alert::error('Gói hiện tại của bạn cao hơn gói vừa chọn')->flash();
                        return redirect()->back();
                    }
                    // khác cấp (tự động reset hạn mức mới)
                    $userLevel->level_expried = strtotime($level->level_time_expried);
                }else{
                    // cùng cấp
                    if($userLevel->level_expried > time()) {
                        // thêm gia hạn đã có (thêm hạn mức với hạn mức cũ)
                        $userLevel->level_expried = strtotime($level->level_time_expried, $userLevel->level_expried);
                    }else{
                        // bắt đầu gia hạn mới (hiện tại + hạn mức cấp cho)
                        $userLevel->level_expried = strtotime($level->level_time_expried);
                    }
                }
                $userLevel->level_id = $level->level_id;
                $userLevel->save();
            }else{
                $userLevel = UserLevelModel::create([
                    'user_id' => $request->user_id,
                    'level_id' => $level->level_id,
                    'level_expried' => strtotime($level->level_time_expried),
                    'level_note' => 'Admin cung cấp',
                    'level_status' => 1,
                ]);
            }
        }
        PaymentModel::create($payment);
        if($payment['cen_add'] > 0) {
            $user->user_money = $user->user_money + $payment['cen_add'];
            $user->save();
        }
        // show a success message
        \Alert::success(trans('backpack::crud.insert_success'))->flash();

        return $this->performSaveAction($userLevel->id);
    }

    public function update(UpdateRequest $request)
    {
        return parent::updateCrud($request);
    }
}