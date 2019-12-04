<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8/17/2018
 * Time: 3:38 PM
 */
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request as Request;
use App\Library\Helpers;
use App\Http\Requests;
use App\Models\MusicKaraokeModel;
use Illuminate\Support\Facades\Storage;
use Backpack\CRUD\app\Http\Controllers\CrudController;
// VALIDATION: change the requests to match your own file names if you need form validation
use Backpack\CRUD\app\Http\Requests\CrudRequest as StoreRequest;
use Backpack\CRUD\app\Http\Requests\CrudRequest as UpdateRequest;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Artist\ArtistRepository;
use App\Solr\Solarium;
use App\Models\MusicModel;
use App\Models\VideoModel;
use App\Http\Controllers\Sync\SolrSyncController;

class LyricKaraokeVideoController extends CrudController
{
    protected $artistRepository;
    protected $Solr;

    public function __construct(ArtistRepository $artistRepository, Solarium $Solr)
    {
        $this->artistRepository = $artistRepository;
        $this->Solr = $Solr;
        $this->middleware(function ($request, $next)
        {
            if(!backpack_user()->can('duyet_sua_nhac')) {
                $this->crud->denyAccess(['list']);
            }
            $this->crud->denyAccess(['create']);
            if(!backpack_user()->can('duyet_sua_nhac')) {
                $this->crud->denyAccess(['update']);
            }
            $this->crud->denyAccess(['delete']);
            return $next($request);
        });
        parent::__construct();
    }
    public function setup()
    {
        $this->crud->setModel("App\Models\VideoModel");
        $this->crud->setEntityNameStrings('Danh Sách Karaoke', 'Danh Sách Video Lyric Karaoke');
        $this->crud->setRoute(config('backpack.base.route_prefix').'/list_video_lyric_karaoke');
        $this->crud->orderBy('music_last_update_time', 'desc');
        $this->crud->orderBy('music_time', 'desc');
        $this->crud->denyAccess(['create']);



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
            'name'  => 'music_artist',
            'label' => 'Nghệ Danh',
//            'type' => 'closure',
//            'function' => function($entry) {
//                return Helpers::rawHtmlArtists($entry->music_artist_id, $entry->music_artist);
//            }
        ]);
        $this->crud->addField([
            'name' => 'music_shortlyric',
            'label' => 'Lời bài hát ngắn',
            'type' => 'textarea',
            'placeholder' => 'Nhập lời bài hát ngắn',
        ]);
        $this->crud->addField([    // WYSIWYG
            'name' => 'music_lyric',
            'label' => 'Lời bài hát',
            'type' => 'textarea',
            'placeholder' => 'Nhập lời bài hát đầy đủ.',
        ]);
    }

    public function destroy($id)
    {
        return $this->crud->delete($id);
    }
    public function store(StoreRequest $request)
    {
        return parent::storeCrud($request);
    }
    public function edit($id, $template = false)
    {
        $this->crud->hasAccessOrFail('update');
        $this->crud->setOperation('update');

        // get entry ID from Request (makes sure its the last ID for nested resources)
        $id = $this->crud->getCurrentEntryId() ?? $id;

        // get the info for that entry
        $this->data['entry'] = $this->crud->getEntry($id);
        $this->data['crud'] = $this->crud;
        $this->data['saveAction'] = $this->getSaveAction();
        $this->data['fields'] = $this->crud->getUpdateFields($id);
        $this->data['title'] = $this->crud->getTitle() ?? trans('backpack::crud.edit').' '.$this->crud->entity_name;

        $this->data['id'] = $id;

        // load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package

        return view('vendor.backpack.suggestion_lyric_karaoke.edit_music', $this->data);
    }
    public function update(UpdateRequest $request)
    {
        $per_kara = backpack_user()->can('duyet_sua_karaoke');
        $music =  VideoModel::where('music_id', $request->music_id)->first();
        if($per_kara) {
            $kara = MusicKaraokeModel::where('music_id', $request->music_id)->first();
            if($kara) {
                $kara->music_lyric_karaoke = $request->music_karaoke;
                $kara->music_update_time = time();
                $kara->save();
            }elseif($request->music_karaoke){
                MusicKaraokeModel::create([
                    'music_id' => $music->music_id,
                    'music_title' => $music->music_title,
                    'music_time' => time(),
                    'music_lyric_karaoke' => $request->music_karaoke,
                ]);
            }
        }
        if(backpack_user()->can('duyet_sua_nhac')) {
            $music->update([
                'music_shortlyric' => $request->music_shortlyric ?? '',
                'music_lyric' => $request->music_lyric ?? '',
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

}