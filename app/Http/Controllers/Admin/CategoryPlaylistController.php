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



class CategoryPlaylistController extends CrudController
{
    public function __construct()
    {
        $this->middleware(function ($request, $next)
        {
            if(!backpack_user()->can('danh_muc_playlist_(list)')) {
                $this->crud->denyAccess(['list']);
            }
            if(!backpack_user()->can('danh_muc_playlist_(create)')) {
                $this->crud->denyAccess(['create']);
            }
            if(!backpack_user()->can('danh_muc_playlist_(update)')) {
                $this->crud->denyAccess(['update']);
            }
            if(!backpack_user()->can('danh_muc_playlist_(delete)')) {
                $this->crud->denyAccess(['delete']);
            }
            return $next($request);
        });
        parent::__construct();
    }

    public function setup()
    {
        $this->crud->setModel("App\Models\CategoryPlaylistModel");
        $this->crud->setEntityNameStrings('Category Playlist', 'Category Playlist');
        $this->crud->setRoute(config('backpack.base.route_prefix').'/category_playlist');
        $this->crud->orderBy('cat_id', 'desc');
//        $this->crud->setEntityNameStrings('menu item', 'menu items');

//        $this->crud->allowAccess('reorder');
//        $this->crud->enableReorder('name', 2);

        $this->crud->addColumn([
            'name' => 'cat_id',
            'label' => 'ID',
        ]);
        $this->crud->addColumn([
            'name' => 'cat_level',
            'label' => 'Level',
        ]);
        $this->crud->addColumn([
            'name' => 'cat_title',
            'label' => 'Title',
        ]);
        $this->crud->addColumn([
            'name' => 'cat_short_title',
            'label' => 'Short Title',
        ]);
        $this->crud->addColumn([
            'name' => 'cat_url',
            'label' => 'url',
        ]);

        $this->crud->addField([
            'name' => 'cat_title',
            'label' => 'Title',
        ]);
        $this->crud->addField([
            'name' => 'cat_short_title',
            'label' => 'Short Title',
        ]);
        $this->crud->addField([
            'name' => 'cat_url',
            'label' => 'url',
        ]);
        $this->crud->addField([
            'name' => 'cat_id',
            'label' => 'ID',
        ]);
        $this->crud->addField([
            'name' => 'cat_level',
            'label' => 'Level',
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