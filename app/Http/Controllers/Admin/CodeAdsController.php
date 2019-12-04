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
use App\Models\CodeAdsModel;
// VALIDATION: change the requests to match your own file names if you need form validation
use Backpack\CRUD\app\Http\Requests\CrudRequest as StoreRequest;
use Backpack\CRUD\app\Http\Requests\CrudRequest as UpdateRequest;
use Illuminate\Support\Facades\Auth;

class CodeAdsController extends CrudController
{
    public function __construct()
    {
        $this->middleware(function ($request, $next)
        {
            if(!backpack_user()->can('code_ads(list)')) {
                $this->crud->denyAccess(['list']);
                $this->crud->denyAccess(['create']);
                $this->crud->denyAccess(['update']);
                $this->crud->denyAccess(['delete']);
            }
            if(!backpack_user()->can('code_ads(create)')) {
                $this->crud->denyAccess(['create']);
            }
            if(!backpack_user()->can('code_ads(delete)')) {
                $this->crud->denyAccess(['delete']);
            }
            if(!backpack_user()->can('code_ads(update)')) {
                $this->crud->denyAccess(['update']);
            }
            return $next($request);
        });
        parent::__construct();

    }
    public function setup()
    {
        $this->crud->setModel("App\Models\CodeAdsModel");
        $this->crud->setEntityNameStrings('Code quảng cáo CSN', 'Code quảng cáo CSN');
        $this->crud->setRoute(config('backpack.base.route_prefix').'/code_ads');
//        $this->crud->setEntityNameStrings('menu item', 'menu items');
        $this->crud->orderBy('updated_at', 'desc');

        $this->crud->addColumn([
            'name' => 'name',
            'label' => 'Tên',
        ]);
        $this->crud->addColumn([
            'name' => 'key',
            'label' => 'Key',
        ]);
        $this->crud->addColumn([
            'name' => 'type',
            'label' => 'Thể loại',
        ]);
        $this->crud->addColumn([
            'name' => 'description',
            'label' => 'Diễn giải',
        ]);
        $this->crud->addColumn([
            'name' => 'updated_at',
            'label' => 'Cập nhật',
            'type' => 'date',
            'format' => 'd/m H:i',
        ]);
        $this->crud->addColumn([
            'name'  => 'status',
            'label' => 'Tình Trạng',
            'type' => 'closure',
            'function' => function($entry) {
                return $entry->status == 1 ? '<span class="label label-success">Hoạt động</span>' : '<span class="label label-default">K.hoạt dộng</span>';
            },
        ]);


        $this->crud->addField([
            'name'  => 'name',
            'label' => 'Tên',
        ]);
        $this->crud->addField([
            'name' => 'key',
            'label' => 'Key (Tham số biến, file)',
        ]);
        $this->crud->addField([
            'name'  => 'description',
            'label' => 'Diễn giải',
            'type' => 'textarea',
        ]);
        $this->crud->addField([
            'label' => 'Tình trạng',
            'type' => 'select_from_array',
            'name' => 'status',
            'options' => [0 => 'Không hoạt động', 1 => 'Hoạt động'],
            'allows_null' => false,
            'default' => 1,
        ]);
        $this->crud->addField([
            'label' => 'Thể loại',
            'type' => 'select_from_array',
            'name' => 'type',
            'options' => ['CODE HTML' => 'CODE HTML', 'ARRAY LINK' => 'ARRAY LINK'],
            'allows_null' => false,
            'default' => 1,
        ]);
        $this->crud->addField([
            'name'  => 'code1',
            'label' => 'Nội dung code 1',
            'type' => 'textarea',
        ]);
        $this->crud->addField([
            'name'  => 'code2',
            'label' => 'Nội dung code 2',
            'type' => 'textarea',
        ]);
        $this->crud->addField([
            'name'  => 'code3',
            'label' => 'Nội dung code 3',
            'type' => 'textarea',
        ]);
        $this->crud->addField([
            'name'  => 'code4',
            'label' => 'Nội dung code 4',
            'type' => 'textarea',
        ]);
        $this->crud->addField([
            'name'  => 'code5',
            'label' => 'Nội dung code 5',
            'type' => 'textarea',
        ]);
        $this->crud->addField([
            'name'  => 'code6',
            'label' => 'Nội dung code 6',
            'type' => 'textarea',
        ]);
        $this->crud->addField([
            'name'  => 'code7',
            'label' => 'Nội dung code 7',
            'type' => 'textarea',
        ]);
        $this->crud->addField([
            'name'  => 'code8',
            'label' => 'Nội dung code 8',
            'type' => 'textarea',
        ]);
        $this->crud->addField([
            'name'  => 'code9',
            'label' => 'Nội dung code 9',
            'type' => 'textarea',
        ]);
        $this->crud->addField([
            'name'  => 'code10',
            'label' => 'Nội dung code 10',
            'type' => 'textarea',
        ]);

    }

    public function store(StoreRequest $request)
    {
        $this->crud->hasAccessOrFail('create');
        $this->crud->setOperation('create');
        $this->validate($request, [
            'key' => 'required|unique:csn_code_ads,key,'.\Request::get('id'),
            'name' => 'required',
            'description' => 'required',
            'code1' => 'required',
        ]);

        // fallback to global request instance
        if (is_null($request)) {
            $request = \Request::instance();
        }

        // insert item in the db
        $item = $this->crud->create($request->except(['save_action', '_token', '_method', 'current_tab', 'http_referrer']));
        $this->data['entry'] = $this->crud->entry = $item;

        // show a success message
        \Alert::success(trans('backpack::crud.insert_success'))->flash();
        $this->renderCode($item);
        // save the redirect choice for next time
        $this->setSaveAction();
        return $this->performSaveAction($item->getKey());
    }

    public function update(UpdateRequest $request)
    {
        $this->crud->hasAccessOrFail('update');
        $this->crud->setOperation('update');
        $this->validate($request, [
            'key' => 'required|unique:csn_code_ads,key,'.\Request::get('id'),
            'name' => 'required',
            'description' => 'required',
            'code1' => 'required',
        ]);
        // fallback to global request instance
        if (is_null($request)) {
            $request = \Request::instance();
        }

        // update the row in the db
        $item = $this->crud->update($request->get($this->crud->model->getKeyName()),
            $request->except('save_action', '_token', '_method', 'current_tab', 'http_referrer'));
        $this->data['entry'] = $this->crud->entry = $item;
        $this->renderCode($item);
        // show a success message
        \Alert::success(trans('backpack::crud.update_success'))->flash();
        // save the redirect choice for next time
        $this->setSaveAction();


        return $this->performSaveAction($item->getKey());
    }
    public function destroy($id)
    {
        $this->crud->hasAccessOrFail('delete');
        $codeAds = CodeAdsModel::where('id', $id)->first();
        // get entry ID from Request (makes sure its the last ID for nested resources)
        $id = $this->crud->getCurrentEntryId() ?? $id;
        unlink(resource_path().'/views/cache/code_ads/'.$codeAds->key.'.blade.php');
        return $this->crud->delete($id);
    }
    public function renderCode($codeContent) {
//        ($codeContent->status == 1 ? $codeContent->code : '')

        if($codeContent->type == 'CODE HTML') {
            file_put_contents(resource_path().'/views/cache/code_ads/'.$codeContent->key.'.blade.php', '<?php 
    $randNum = rand(1, 10);
        switch ($randNum)
        {
            case 1:
                echo '.($codeContent->status == 1 ? "'".str_replace("'", "\\'", $codeContent->code1)."'" : '').';
                break;
            case 2:
                echo '.($codeContent->status == 1 ? "'".str_replace("'", "\\'", $codeContent->code2)."'" : '').';
                break;
            case 3:
                echo '.($codeContent->status == 1 ? "'".str_replace("'", "\\'", $codeContent->code3)."'" : '').';
                break;
            case 4:
                echo '.($codeContent->status == 1 ? "'".str_replace("'", "\\'", $codeContent->code4)."'" : '').';
                break;
            case 5:
                echo '.($codeContent->status == 1 ? "'".str_replace("'", "\\'", $codeContent->code5)."'" : '').';
                break;
            case 6:
                echo '.($codeContent->status == 1 ? "'".str_replace("'", "\\'", $codeContent->code6)."'" : '').';
                break;
            case 7:
                echo '.($codeContent->status == 1 ? "'".str_replace("'", "\\'", $codeContent->code7)."'" : '').';
                break;
            case 8:
                echo '.($codeContent->status == 1 ? "'".str_replace("'", "\\'", $codeContent->code8)."'" : '').';
                break;
            case 9:
                echo '.($codeContent->status == 1 ? "'".str_replace("'", "\\'", $codeContent->code9)."'" : '').';
                break;
            case 10:
                echo '.($codeContent->status == 1 ? "'".str_replace("'", "\\'", $codeContent->code10)."'" : '').';
                break;
            default:
                echo "";
        }
?>');
        }elseif ($codeContent->type == 'ARRAY LINK') {
            $result = [];
            ($codeContent->code1 ? ( $result[] = $codeContent->code1) : null);
            ($codeContent->code2 ? ( $result[] = $codeContent->code2) : null);
            ($codeContent->code3 ? ( $result[] = $codeContent->code3) : null);
            ($codeContent->code4 ? ( $result[] = $codeContent->code4) : null);
            ($codeContent->code5 ? ( $result[] = $codeContent->code5) : null);
            ($codeContent->code6 ? ( $result[] = $codeContent->code6) : null);
            ($codeContent->code7 ? ( $result[] = $codeContent->code7) : null);
            ($codeContent->code8 ? ( $result[] = $codeContent->code8) : null);
            ($codeContent->code9 ? ( $result[] = $codeContent->code9) : null);
            ($codeContent->code10 ? ( $result[] = $codeContent->code10) : null);
            file_put_contents(resource_path().'/views/cache/code_ads/'.$codeContent->key.'.blade.php', '<?php 
global $'.$codeContent->key.';
    
$'.$codeContent->key.' = ' . var_export($result, true) . ';
?>');
        }

    }
}