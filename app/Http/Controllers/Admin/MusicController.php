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
use App\Models\MusicKaraokeModel;
use Backpack\CRUD\app\Http\Controllers\CrudController;
// VALIDATION: change the requests to match your own file names if you need form validation
use Backpack\CRUD\app\Http\Requests\CrudRequest as StoreRequest;
use Backpack\CRUD\app\Http\Requests\CrudRequest as UpdateRequest;
use Illuminate\Support\Facades\Auth;
use App\Repositories\DeleteMusic\DeleteMusicEloquentRepository;
use App\Repositories\Music\MusicEloquentRepository;
use App\Models\MusicModel;

class MusicController extends CrudController
{
    protected $deleteMusicRepository;
    protected $musicRepository;
    public function __construct(DeleteMusicEloquentRepository $deleteMusicRepository, MusicEloquentRepository $musicRepository)
    {
        $this->deleteMusicRepository = $deleteMusicRepository;
        $this->musicRepository = $musicRepository;
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
        $this->crud->setModel("App\Models\MusicModel");
        $this->crud->setEntityNameStrings('Nhạc CSN', 'Nhạc CSN');
        $this->crud->setRoute(config('backpack.base.route_prefix').'/music');
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
            'label' => 'Tên bài hát',
//            'type' => 'closure',
//            'function' => function($entry) {
//                return '<a target="_blank" href="'.Helpers::listen_url($entry->toArray()).'" >'.$entry->music_title.'</a>';
//            }
        ]);
        $this->crud->addColumn([
            'name'  => 'music_id2',
            'label' => 'Ảnh cover',
            'type' => 'closure',
            'function' => function($entry) {
                return '<a target="_blank" href="'.Helpers::listen_url($entry->toArray()).'" ><img style="
                                  max-height: 25px;
                                  width: auto;
                                  border-radius: 3px;" src="'.Helpers::cover_url($entry->cover_id).'"/></a>';
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
            'label' => 'Tên bài hát',
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
            'name'  => 'cat_id',
            'type'  => 'hidden',
        ]);
        $this->crud->addField([
            'name'  => 'cat_level',
            'type'  => 'hidden',
        ]);
        $this->crud->addField([
            'name'  => 'cat_sublevel',
            'type'  => 'hidden',
        ]);
        $this->crud->addField([
            'name'  => 'cat_custom',
            'type'  => 'hidden',
        ]);
    }

    public function store(StoreRequest $request)
    {
        return parent::storeCrud($request);
    }
    public function edit($id, $template = false)
    {
        $this->crud->hasAccessOrFail('update');

        // get entry ID from Request (makes sure its the last ID for nested resources)
        $id = $this->crud->getCurrentEntryId() ?? $id;

        // get the info for that entry
        $this->data['entry'] = $this->crud->getEntry($id);
        $this->data['crud'] = $this->crud;
        $this->data['saveAction'] = $this->getSaveAction();
        $this->data['fields'] = $this->crud->getUpdateFields($id);
        $this->data['title'] = trans('backpack::crud.edit').' '.$this->crud->entity_name;
        $this->data['id'] = $id;

        return view('vendor.backpack.music.edit', $this->data);
    }
    public function update(UpdateRequest $request)
    {
        $per_kara = backpack_user()->can('duyet_sua_karaoke');
        if($per_kara) {
            $kara = MusicKaraokeModel::where('music_id', $request->music_id)->first();
            if($kara) {
                $kara->music_lyric_karaoke = $request->music_karaoke;
                $kara->music_update_time = time();
                $kara->save();
            }elseif($request->music_karaoke){
                MusicKaraokeModel::create([
                    'music_id' => $request->music_id,
                    'music_title' => $request->music_title,
                    'music_time' => time(),
                    'music_lyric_karaoke' => $request->music_karaoke,
                ]);
            }
        }
        if(backpack_user()->can('duyet_sua_nhac')) {
            MusicModel::where('music_id', $request->music_id)->update([
                'music_title' => $request->music_title ?? '',
                'music_composer' => $request->music_composer ?? '',
                'music_production' => $request->music_production ?? '',
                'music_album_id' => $request->music_album_id ?? '',
                'music_year' => $request->music_year ?? '',
                'music_shortlyric' => $request->music_shortlyric ?? '',
                'music_lyric' => $request->music_lyric ?? '',
                'music_note' => $request->music_note ?? '',
                'cat_id' => $request->cat_id ?? '',
                'cat_level' => $request->cat_level ?? '',
                'cat_sublevel' => $request->cat_sublevel ?? '',
                'cat_custom' => $request->cat_custom ?? '',
                'music_last_update_time' => time()
            ]);
            \Alert::success(trans('backpack::crud.update_success'))->flash();

            // save the redirect choice for next time
            $this->setSaveAction();

            return $this->performSaveAction($request->music_id);
            return parent::updateCrud($request);
        }
        if($per_kara) {
            \Alert::success(trans('backpack::crud.update_success'))->flash();
            return $this->performSaveAction($request->music_id);
        }
        $this->crud->denyAccess(['update']);
        $this->crud->hasAccessOrFail('update');

    }
    public function destroy($id)
    {
        $this->crud->hasAccessOrFail('delete');

        // get entry ID from Request (makes sure its the last ID for nested resources)
        $id = $this->crud->getCurrentEntryId() ?? $id;
        $music = $this->musicRepository->getModel()::where('music_id', $id)->first();
        $this->deleteMusicRepository->create($music->toArray());
        return $this->crud->delete($id);
    }

}