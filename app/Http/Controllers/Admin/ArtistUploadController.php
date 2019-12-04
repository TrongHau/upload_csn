<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8/17/2018
 * Time: 3:38 PM
 */
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request as Request;
use App\Repositories\Artist\ArtistRepository;
use App\Repositories\ArtistUpload\ArtistUploadEloquentRepository;
use App\Library\Helpers;
use App\Http\Requests;
use File;
use Illuminate\Support\Facades\Storage;
use Backpack\CRUD\app\Http\Controllers\CrudController;
// VALIDATION: change the requests to match your own file names if you need form validation
use Backpack\CRUD\app\Http\Requests\CrudRequest as StoreRequest;
use Backpack\CRUD\app\Http\Requests\CrudRequest as UpdateRequest;
use Illuminate\Support\Facades\Auth;
use App\Solr\Solarium;
use App\Http\Controllers\Sync\SolrSyncController;

class ArtistUploadController extends CrudController
{
    protected $artistRepository;
    protected $artistUploadRepository;
    protected $Solr;

    public function __construct(ArtistRepository $artistRepository, ArtistUploadEloquentRepository $artistUploadRepository, Solarium $Solr) {
        $this->artistRepository = $artistRepository;
        $this->artistUploadRepository = $artistUploadRepository;
        $this->Solr = $Solr;
        $this->middleware(function ($request, $next)
        {
            if(!backpack_user()->can('xet_duyet_ca_si_(list)')) {
                $this->crud->denyAccess(['list']);
            }
            if(!backpack_user()->can('xet_duyet_ca_si_(create)')) {
                $this->crud->denyAccess(['create']);
            }
            if(!backpack_user()->can('xet_duyet_ca_si_(update)')) {
                $this->crud->denyAccess(['update']);
            }
            if(!backpack_user()->can('xet_duyet_ca_si_(delete)')) {
                $this->crud->denyAccess(['delete']);
            }
            return $next($request);
        });
        parent::__construct();
    }
    public function setup()
    {
        $this->crud->setModel("App\Models\ArtistUploadModel");
        $this->crud->setEntityNameStrings('Upload Artist', 'Artist Upload');
        $this->crud->setRoute(config('backpack.base.route_prefix').'/artist_upload');
        $this->crud->denyAccess(['create']);
        $this->crud->orderBy('artist_id', 'asc');
//        $this->crud->denyAccess(['create', 'delete', 'update', 'list']);
//        $this->crud->allowAccess('reorder');
//        $this->crud->hasAccess('update');
//        $this->crud->enableReorder('name', 2);

        $this->crud->addFilter([ // dropdown filter
            'name' => 'type',
            'type' => 'dropdown',
            'label'=> 'Status'
        ], [
            0 => 'Chỉnh sửa',
            1 => 'Tạo',
        ], function($value) { // if the filter is active
             $this->crud->addClause('where', 'type', $value);
        });


        $this->crud->orderBy('artist_id', 'desc');
//        $this->crud->addClause('where', 'active', 1);
        $this->crud->setColumns([
            [
                'name'  => 'artist_id',
                'label' => 'ID',
            ],
            [
                'name'  => 'artist_nickname',
                'label' => 'Nghệ Danh',
            ],
            [ // n-n relationship (with pivot table)
                'label'     => 'User', // Table column heading
                'type'      => 'select',
                'name'      => 'last_update_user_id', // the method that defines the relationship in your Model
                'entity'    => 'user', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model'     => "App\Models\UserModel", // foreign key model
            ],
            [
                'name'  => 'type',
                'label' => 'Thể loại',
                'type' => 'closure',
                'function' => function($entry) {
                    return $entry->type == 0 ? '<span class="label label-default">Chỉnh sửa</span>' : '<span class="label label-success">Thêm mới</span>';
                },
            ],
            [
                'name'  => 'artist_avatar',
                'label' => 'Avatar',
                'type' => 'closure',
                'function' => function($entry) {
                    if(!$entry->artist_avatar)
                        return '-';
                    $urlImg = Helpers::file_path($entry->artist_id, PUBLIC_CACHE_AVATAR_ARTIST_PATH, true) . $entry->artist_avatar;
                    return '<a href="'.Helpers::artistUrl($entry->artist_id, $entry->artist_nickname).'" target="_blank">
                              <img src="'.$urlImg.'" style="
                                  max-height: 25px;
                                  width: auto;
                                  border-radius: 3px;">
                            </a>';
                },
//                'prefix' => PUBLIC_AVATAR_ARTIST_PATH,
//                'type' => 'image',
//                'type' => 'model_function',
//                'function_name' => 'getPreviewAvt',
            ],

            [
                'name'  => 'artist_cover',
                'label' => 'Cover',
//                'prefix' => PUBLIC_COVER_ARTIST_PATH,
//                'type' => 'image',
                'type' => 'closure',
                'function' => function($entry) {
                    if(!$entry->artist_cover)
                        return '-';
                    $urlImg = Helpers::file_path($entry->artist_id, PUBLIC_CACHE_COVER_ARTIST_PATH, true) . $entry->artist_cover;
                    return '<a href="/user/'.$entry->last_update_user_id.'" target="_blank">
                              <img src="'.$urlImg.'" style="
                                  max-height: 25px;
                                  width: auto;
                                  border-radius: 3px;">
                            </a>';
                },
            ],
        ]);

        $this->crud->addField([
            'name'  => 'artist_nickname',
            'label' => 'Nghệ Danh',
        ]);
        $this->crud->addField([
            'label' => 'Giới Tính',
            'type' => 'select_from_array',
            'name' => 'artist_gender',
            'options' => [0 => 'Nam', 1 => 'Nữ'],
            'allows_null' => false,
            'default' => 0,
        ]);

        $this->crud->addField([
            'name' => 'artist_birthday',
            'label' => 'Ngày Sinh',
            'type' => 'date',
        ], 'update');

        $this->crud->addField([
            'name'  => 'artist_avatar',
            'label' => 'Avatar',
        ]);

        $this->crud->addField([
            'name'  => 'artist_cover',
            'label' => 'Cover',
        ]);
        $this->crud->addField([
            'name'  => 'type',
            'type'  => 'hidden',
        ]);
        $this->crud->addField([
            'name'  => 'artist_id_suggest',
            'type'  => 'hidden',
        ]);

//        $this->crud->addField([
//            'label' => "Avatar",
//            'name' => "artist_avatar",
//            'type' => 'image',
//            'aspect_ratio' => 1,
//            'crop' => true,
//            'aspect_ratio' => 1,
//            'upload' => true,
//            'prefix' => PUBLIC_AVATAR_ARTIST_PATH,
//        ]);
//        $this->crud->addField([
//            'label' => "Cover",
//            'name' => "artist_cover",
//            'type' => 'image',
//            'aspect_ratio' => 1,
//            'crop' => true,
//            'aspect_ratio' => 1,
//            'upload' => true,
//            'prefix' => PUBLIC_COVER_ARTIST_PATH,
//        ]);

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
        $this->data['artist_exists'] = $this->artistRepository->getModel()::where('artist_id', $this->data['fields']['artist_id_suggest']['value'])->first();
        //

        // load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
        return view('vendor.backpack.upload_artist.edit', $this->data);

    }

    public function store(StoreRequest $request)
    {
        return parent::storeCrud();
    }

    public function update(UpdateRequest $request)
    {
        $this->crud->hasAccessOrFail('update');

        // fallback to global request instance
        if (is_null($request)) {
            $request = \Request::instance();
        }
        // replace empty values with NULL, so that it will work with MySQL strict mode on
        foreach ($request->input() as $key => $value) {
            if (empty($value) && $value !== '0') {
                $request->request->set($key, null);
            }
        }
        if(strlen($request->input('artist_avatar')) > 100) {
            $typeImageAvatar = array_last(explode('.', $_FILES['choose_artist_avatar']['name']));
            $fileNameAvt = Helpers::saveBase64ImageJpg($request->input('artist_avatar'), Helpers::file_path($request->input('artist_id'), CACHE_AVATAR_ARTIST_CROP_PATH, true), $request->artist_id, $typeImageAvatar);
            Helpers::copySourceImage($request->file('choose_artist_avatar'), Helpers::file_path($request->input('artist_id'), AVATAR_ARTIST_SOURCE_PATH, true), $request->artist_id, $typeImageAvatar);
            $request->request->set('artist_avatar', $fileNameAvt);
        }
        if(strlen($request->input('artist_cover')) > 100) {
            $typeImageCover = array_last(explode('.', $_FILES['choose_artist_cover']['name']));
            $fileNameCover = Helpers::saveBase64ImageJpg($request->input('artist_cover'), Helpers::file_path($request->input('artist_id'), CACHE_COVER_ARTIST_CROP_PATH, true), $request->artist_id, $typeImageCover);
            Helpers::copySourceImage($request->file('choose_artist_cover'), Helpers::file_path($request->input('artist_id'), COVER_ARTIST_SOURCE_PATH, true), $request->artist_id, $typeImageCover);
            $request->request->set('artist_cover', $fileNameCover);
        }

        // update the row in the db
        $item = $this->crud->update($request->get($this->crud->model->getKeyName()),
            $request->except('save_action', '_token', '_method', 'current_tab'));
        $this->data['entry'] = $this->crud->entry = $item;

        // show a success message
        \Alert::success(trans('backpack::crud.update_success'))->flash();

        // save the redirect choice for next time
        $this->setSaveAction();

        return $this->performSaveAction($item->getKey());
    }
    public function destroy($id)
    {
        $this->crud->hasAccessOrFail('delete');

        // get entry ID from Request (makes sure its the last ID for nested resources)
        $id = $this->crud->getCurrentEntryId() ?? $id;
        $artistUpload = $this->artistUploadRepository->findOnlyPublished($id);
        Storage::disk('public')->delete(Helpers::file_path($artistUpload->artist_id, CACHE_AVATAR_ARTIST_CROP_PATH, true).$artistUpload->artist_avatar);
        Storage::disk('public')->delete(Helpers::file_path($artistUpload->artist_id, CACHE_COVER_ARTIST_CROP_PATH, true).$artistUpload->artist_cover);
        return $this->crud->delete($id);
    }
    public function approvalArtistUpload(StoreRequest $request, $id) {
        $artistUpload = $this->artistUploadRepository->findOnlyPublished($id);
        $nameExist = $this->artistRepository->getModel()::where('artist_nickname', $artistUpload->artist_nickname)->first();
        // check save if you get approval article
        if($artistUpload->artist_nickname != $request->artist_nickname || $artistUpload->artist_gender != $request->artist_gender || date_create_from_format("d-m-Y", $artistUpload->artist_birthday) != date_create_from_format("d-m-Y", $request->artist_birthday)
            || strlen($request->input('artist_avatar')) > 100 || strlen($request->input('artist_cover')) > 100) {

            \Alert::error('Đã có sự thay đổi, bạn cần lưu trước khi xác nhận ca sĩ này.')->flash();
            return redirect()->back();
        }
        if($nameExist) {
            \Alert::error('Tên Ca sĩ đã tồn tại.')->flash();
            return redirect()->back();
        }
        $result = $this->artistRepository->createArtist($artistUpload);
        if($artistUpload->artist_avatar){
            Storage::disk('public')->move(Helpers::file_path($artistUpload->artist_id, CACHE_AVATAR_ARTIST_CROP_PATH, true).$artistUpload->artist_avatar, Helpers::file_path($result->artist_id, AVATAR_ARTIST_CROP_PATH, true).$result->artist_avatar);
        }
        if($artistUpload->artist_cover){
            Storage::disk('public')->move(Helpers::file_path($artistUpload->artist_id, CACHE_COVER_ARTIST_CROP_PATH, true).$artistUpload->artist_cover, Helpers::file_path($result->artist_id, COVER_ARTIST_CROP_PATH, true).$result->artist_cover);
        }
        // update search solr
        $Solr = new SolrSyncController($this->Solr);
        $Solr->syncArtist(null, $result);

        $this->artistUploadRepository->delete($id);
        \Alert::success('Xác nhận ca sĩ thành công.')->flash();
        return \Redirect::to($this->crud->route);
    }
    public function preview(StoreRequest $request, $id) {
        $artist = $this->artistUploadRepository->find($id);
        if(!$artist)
            return view('errors.404');
        $musicHtml = '';
        $artistFavourite = '';
        $artistUrl = '';
        $previewArtist = true;
        return view('web.artist.index', compact('artist', 'musicHtml', 'artistFavourite', 'artistUrl', 'previewArtist'));
    }
    public function suggest(StoreRequest $request, $id) {
        $artistUpload = $this->artistUploadRepository->findOnlyPublished($id);
        $artistExist = $this->artistRepository->getModel()::where('artist_id', $artistUpload->artist_id_suggest)->first();
        if(!$artistExist) {
            \Alert::error('Ca sĩ không đã tồn tại.')->flash();
            return redirect()->back();
        }
        // check save if you get approval article
        if($artistUpload->artist_gender != $request->artist_gender || date_create_from_format("d-m-Y", $artistUpload->artist_birthday) != date_create_from_format("d-m-Y", $request->artist_birthday)
            || strlen($request->input('artist_avatar')) > 100 || strlen($request->input('artist_cover')) > 100) {

            \Alert::error('Đã có sự thay đổi, hãy chỉnh sửa lại và lưu trước khi xác nhận ca sĩ này.')->flash();
            return redirect()->back();
        }
        if($artistUpload->artist_avatar){
            $filePath = Helpers::file_path($artistExist->artist_id, AVATAR_ARTIST_CROP_PATH, true);
            if ($artistExist->artist_avatar && Storage::disk('public')->exists($filePath.$artistExist->artist_avatar)) {
                Storage::disk('public')->delete($filePath.$artistExist->artist_avatar);
            }
            $fileName = $artistExist->artist_id.'.'.last(explode('.', $artistUpload->artist_avatar));
            Storage::disk('public')->move(Helpers::file_path($artistUpload->artist_id, CACHE_AVATAR_ARTIST_CROP_PATH, true).$artistUpload->artist_avatar, $filePath.$fileName);
            $artistExist->artist_avatar = $fileName;
        }
        if($artistUpload->artist_cover){
            $filePath = Helpers::file_path($artistExist->artist_id, COVER_ARTIST_CROP_PATH, true);
            if ($artistExist->artist_cover && Storage::disk('public')->exists($filePath.$artistExist->artist_cover)) {
                Storage::disk('public')->delete($filePath.$artistExist->artist_cover);
            }
            $fileName = $artistExist->artist_id.'.'.last(explode('.', $artistUpload->artist_cover));
            Storage::disk('public')->move(Helpers::file_path($artistUpload->artist_id, CACHE_COVER_ARTIST_CROP_PATH, true).$artistUpload->artist_cover, $filePath.$fileName);
            $artistExist->artist_cover = $fileName;
        }
        $artistExist->artist_id_source = $artistUpload->artist_id;
        $artistExist->last_update_user_id = $artistUpload->last_update_user_id;
        if( $artistUpload->artist_birthday)
            $artistExist->artist_birthday = $artistUpload->artist_birthday;
        if($artistUpload->artist_gender)
            $artistExist->artist_gender = $artistUpload->artist_gender;
        if($artistUpload->artist_country)
            $artistExist->artist_country = $artistUpload->artist_country;
        $artistExist->save();

        $Solr = new SolrSyncController($this->Solr);
        $Solr->syncArtist(null, $artistExist);

        $this->artistUploadRepository->delete($id);
        \Alert::success('Chỉnh sửa ca sĩ thành công.')->flash();
        return \Redirect::to($this->crud->route);
    }
}