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
use App\Repositories\DeleteVideo\DeleteVideoEloquentRepository;
use App\Repositories\Video\VideoEloquentRepository;

class VideoController extends CrudController
{
    protected $deleteVideoRepository;
    protected $videoRepository;
    public function __construct(DeleteVideoEloquentRepository $deleteVideoRepository, VideoEloquentRepository $videoRepository)
    {
        $this->deleteVideoRepository = $deleteVideoRepository;
        $this->videoRepository = $videoRepository;
        $this->middleware(function ($request, $next)
        {
            if(!backpack_user()->can('duyet_sua_nhac') && !backpack_user()->can('duyet_sua_karaoke')) {
                $this->crud->denyAccess(['list']);
            }
            if(!backpack_user()->can('xoa_nhac')) {
                $this->crud->denyAccess(['delete']);
            }
            return $next($request);
        });
        parent::__construct();
    }

    public function setup()
    {

        $this->crud->setModel("App\Models\VideoModel");
        $this->crud->setEntityNameStrings('Video CSN', 'Video CSN');
        $this->crud->setRoute(config('backpack.base.route_prefix').'/video');
//        $this->crud->setEntityNameStrings('menu item', 'menu items');
        $this->crud->orderBy('music_last_update_time', 'desc');
//        $this->crud->enableBulkActions();
//        $this->crud->addBulkDeleteButton();

//        $this->crud->allowAccess('reorder');
//        $this->crud->enableReorder('name', 2);
        $this->crud->addColumn([
            'name' => 'music_id',
            'label' => 'ID',
        ]);
        $this->crud->addColumn([
            'name'  => 'music_title',
            'label' => 'Tên video',
//            'type' => 'closure',
//            'function' => function($entry) {
//                return '<a target="_blank" href="'.Helpers::listen_url($entry->toArray()).'" >'.$entry->music_title.'</a>';
//            }
        ]);
        $this->crud->addColumn([
            'name'  => 'music_artist',
            'label' => 'Nghệ Danh',
//            'type' => 'closure',
//            'function' => function($entry) {
//                return Helpers::rawHtmlArtists($entry->music_artist_id, $entry->music_artist);
//            }
        ]);




        $this->crud->addField([
            'name' => 'music_title',
            'label' => 'Tên video',
        ]);
        $this->crud->addColumn([
            'name'  => 'music_id2',
            'label' => 'Thumbnail',
            'type' => 'closure',
            'function' => function($entry) {
                return '<a target="_blank" href="'.Helpers::listen_url($entry->toArray()).'" ><img style="
                                  max-height: 25px;
                                  width: auto;
                                  border-radius: 3px;" src="'.Helpers::thumbnail_url($entry->toArray()).'"/></a>';
            }
        ]);

        $this->crud->addColumn([
            'name' => 'music_listen',
            'label' => 'lượt xem',
            'type' =>'number'
        ]);

        $this->crud->addColumn([
            'name' => 'music_downloads',
            'label' => 'lượt tải',
            'type' =>'number'
        ]);

        $this->crud->addColumn([
            'name' => 'music_search_result',
            'label' => 'Tìm kiếm',
            'type' =>'number'
        ]);

        $this->crud->addField([
            'name' => 'music_composer',
            'label' => 'Sáng tác',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6',
            ],
        ]);
        $this->crud->addField([
            'name' => 'music_production',
            'label' => 'Sản Xuất',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6',
            ],
        ]);
        $this->crud->addField([
            'name' => 'music_album_id',
            'label' => 'Mã đĩa',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6',
            ],
        ]);
        $this->crud->addField([
            'name' => 'music_year',
            'label' => 'Năm phát hành',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6',
            ],
        ]);
        $this->crud->addField([
            'name' => 'music_shortlyric',
            'label' => 'Lời bài hát ngắn',
            'type' => 'textarea',
            'placeholder' => 'Nhập lời bài hát ngắn',
            // 'disabled' => 'disabled'
        ]);
        $this->crud->addField([    // WYSIWYG
            'name' => 'music_lyric',
            'label' => 'Lời bài hát',
            'type' => 'textarea',
            'placeholder' => 'Nhập lời bài hát đầy đủ.',
        ]);
        $this->crud->addField([
            'name' => 'music_note',
            'label' => 'Ghi chú',
        ]);
        $this->crud->addField([
            'name' => 'music_source_url',
            'label' => 'Nguồn',
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
    public function destroy($id)
    {
        $this->crud->hasAccessOrFail('delete');

        // get entry ID from Request (makes sure its the last ID for nested resources)
        $id = $this->crud->getCurrentEntryId() ?? $id;
        $music = $this->videoRepository->getModel()::where('music_id', $id)->first();
        $this->deleteVideoRepository->create($music->toArray());
        return $this->crud->delete($id);
    }
}