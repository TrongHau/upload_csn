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
use Backpack\CRUD\app\Http\Controllers\CrudController;
// VALIDATION: change the requests to match your own file names if you need form validation
use Backpack\CRUD\app\Http\Requests\CrudRequest as StoreRequest;
use Backpack\CRUD\app\Http\Requests\CrudRequest as UpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Playlist\PlaylistEloquentRepository;
use App\Repositories\PlaylistPublisher\PlaylistPublisherEloquentRepository;
use App\Repositories\PlaylistMusic\PlaylistMusicEloquentRepository;
use App\Repositories\PlaylistMusicPublisher\PlaylistMusicPublisherEloquentRepository;
use App\Models\PlaylistMusicModel;
use App\Models\PlaylistModel;
use App\Models\PlaylistPublisherModel;
use File;

class PlaylistUserController extends CrudController
{
    protected $artistRepository;
    protected $artistUploadRepository;
    protected $playlistMusicRepository;
    protected $playlistRepository;
    protected $playlistPublisherRepository;
    protected $playlistMusicPublisherRepository;

    public function __construct(ArtistRepository $artistRepository, ArtistUploadEloquentRepository $artistUploadRepository, PlaylistMusicEloquentRepository $playlistMusicRepository,
                                PlaylistEloquentRepository $playlistRepository, PlaylistPublisherEloquentRepository $playlistPublisherRepository, PlaylistMusicPublisherEloquentRepository $playlistMusicPublisherRepository)
    {
        $this->artistRepository = $artistRepository;
        $this->artistUploadRepository = $artistUploadRepository;
        $this->playlistMusicRepository = $playlistMusicRepository;
        $this->playlistRepository = $playlistRepository;
        $this->playlistPublisherRepository = $playlistPublisherRepository;
        $this->playlistMusicPublisherRepository = $playlistMusicPublisherRepository;
        $this->middleware(function ($request, $next)
        {
            if(!backpack_user()->can('playlist_user_(list)')) {
                $this->crud->denyAccess(['list']);
            }
            if(!backpack_user()->can('playlist_user_(create)')) {
                $this->crud->denyAccess(['create']);
            }
            if(!backpack_user()->can('playlist_user_(update)')) {
                $this->crud->denyAccess(['update']);
            }
            if(!backpack_user()->can('playlist_user_(delete)')) {
                $this->crud->denyAccess(['delete']);
            }
            return $next($request);
        });
        parent::__construct();

    }
    public function setup()
    {
        $this->crud->setModel("App\Models\PlaylistModel");
        $this->crud->setEntityNameStrings('Playlist User', 'Playlist User');
        $this->crud->setRoute(config('backpack.base.route_prefix').'/playlist_user');
        $this->crud->denyAccess(['create']);
        $this->crud->orderBy('playlist_id', 'desc');


        $this->crud->addFilter([ // daterange filter
            'type' => 'date_range',
            'name' => 'from_to',
            'label'=> 'Hiển thị theo thời gian'
        ],
            false,
            function($value) {
                $dates = json_decode(htmlspecialchars_decode($value, ENT_QUOTES));
                $this->crud->addClause('whereDate', 'created_at', '>=', $dates->from);
                $this->crud->addClause('whereDate', 'created_at', '<=', $dates->to);
            });

//        $this->crud->addClause('where', 'active', 1);
        $this->crud->setColumns([
            [
                'name'  => 'playlist_id',
                'label' => 'ID',
                'type' => 'closure',
                'function' => function($entry) {
                    return '<a href="'.Helpers::playlist_url($entry->toArray()).'" target="_blank">'.$entry->playlist_id.'</a>';
                },
            ],
//            [
//                'name'  => 'playlist_time',
//                'label' => 'Create date',
//                'type' => 'date',
//            ],
            [
                'name'  => 'playlist_title',
                'label' => 'Tên Playlist',
            ],
            [
                'name'  => 'playlist_listen',
                'label' => 'Lượt nghe',
            ],
            [
                'name'  => 'playlist_music_total',
                'label' => 'Số bài hát',
            ],

            [
                'name'  => 'playlist_cover',
                'label' => 'Cover',
                'type' => 'closure',
                'function' => function($entry) {
                    if($entry->playlist_cover) {
                        $urlImg = Helpers::file_path($entry->playlist_id, env('DATA_URL').MUSIC_PLAYLIST_PATH, true) . $entry->playlist_id.'.jpg';
                    }else{
                        return '-';
                    }
                    return '<a href="'.$urlImg.'" target="_blank">
                              <img src="'.$urlImg.'" style="
                                  max-height: 25px;
                                  width: auto;
                                  border-radius: 3px;">
                            </a>';
                },
            ],
            [ // n-n relationship (with pivot table)
                'label'     => 'User', // Table column heading
                'type'      => 'select',
                'name'      => 'user_id', // the method that defines the relationship in your Model
                'entity'    => 'playlist_user', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model'     => "App\Models\RoleUser", // foreign key model
            ],
//            [
//                'name'  => 'user_id',
//                'label' => 'User',
//                'type' => 'closure',
//                'function' => function($entry) {
//                    $user = $entry->playlist_user()->first();
//                    if($user) {
//                        return '<a href="/user/'.$user->id.'" target="_blank">'.$user->name.'</a>';
//                    }
//                    return '<a href="/user/'.$entry->id.'" target="_blank">'.$entry->name.'</a>';
//                },
//            ],
            [
                'name'  => 'playlist_artist',
                'label' => 'Top Ca sĩ',
                'type' => 'closure',
                'function' => function($entry) {
                    if($entry->playlist_artist) {
                        $artistPlaylist = unserialize($entry->playlist_artist);
                        $artistNames = [];
                        $artistIds = [];
                        $i = 0;
                        foreach($artistPlaylist as $key => $item) {
                            $artistNames[] = $item['name'];
                            $artistIds[] = $key;
                            if(++$i == 2)
                                break;
                        }
                        return Helpers::rawHtmlArtists(implode(';', $artistIds), implode(';', $artistNames));
                    }
                },
            ],
        ]);

//        $this->crud->addColumn([
//            'label' => 'User',
//            'type' => 'select',
//            'name' => 'user_id',
//            'entity' => 'playlist_user',
//            'attribute' => 'name',
//            'model' => "App/Models/PlaylistModel",
//        ]);
        $this->crud->enableBulkActions();
        $this->crud->addBulkDeleteButton();

        $this->crud->addField([
            'name'  => 'playlist_id',
            'type'  => 'hidden',
        ]);
        $this->crud->addField([
            'name'  => 'playlist_cover',
            'type'  => 'hidden',
        ]);
        $this->crud->addField([
            'name'  => 'playlist_title',
            'label' => 'Tên Playlist',
        ]);
        $this->crud->addField([
            'name' => 'playlist_cat_id',
            'label' => 'Danh Mục',
        ]);
        $this->crud->addField([
            'name' => 'playlist_cat_level',
            'label' => 'Danh Mục Level',
        ]);
        $this->crud->addField([
            'label' => 'Tình trạng',
            'type' => 'select_from_array',
            'name' => 'playlist_status',
            'options' => [0 => 'Không hoạt động', 1 => 'Hoạt động'],
            'allows_null' => false,
            'default' => 0,
        ]);

        $this->crud->addField([
            'name' => 'playlist_desc',
            'label' => 'Sắp xếp theo',
        ]);

//        $this->crud->addField([
//            'name'  => 'playlist_artist',
//            'label' => 'Json playlist artist',
//        ]);

        $this->crud->addField([
            'name'  => 'artist_cover',
            'label' => 'Cover',
        ]);
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
        $listMusicVideo = $this->playlistRepository->getMusicVideo(array_column($this->data['entry']->playlist_arr_ids->toArray(), 'music_id'));
        $this->data['list_music_video'] = $listMusicVideo;
        // load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
        return view('vendor.backpack.playlist.edit_user', $this->data);

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
        if(strlen($request->input('playlist_value_cover')) > 100) {
            $fileNameCover = Helpers::saveBase64ImageJpg($request->input('playlist_value_cover'), Helpers::file_path($request->input('playlist_id'), MUSIC_PLAYLIST_PATH, true), $request->input('playlist_id'));
            $request->request->set('playlist_cover', SET_ACTIVE);
        }
        $playlist = PlaylistModel::where('playlist_id', $request->input('playlist_id'))->first();
        // remove music, update count
        if($request->input('remove_music')) {
            $arrMusic = explode(',', substr($request->input('remove_music'), 1));
            $countRemove = PlaylistMusicModel::where('playlist_id', $request->input('playlist_id'))->whereIn('music_id', $arrMusic)->delete();
            $update['playlist_music_total'] = $playlist->playlist_music_total - $countRemove;
            $removeArtist = str_replace(';', ',', substr($request->input('remove_artist'), 1));
            $removeArtistId = str_replace(';', ',', substr($request->input('remove_artist_id'), 1));
            $artistRemove = explode(',', $removeArtist);
            $artistIdRemove = explode(',', $removeArtistId);
            $artistOld = unserialize($playlist->playlist_artist);
            foreach ($artistIdRemove as $key => $val) {
                $keyExits = $val == -1 ? urlencode($artistRemove[$key]): $val;
                if(isset($artistOld[$keyExits])) {
                    if($artistOld[$keyExits]['order'] == 0){
                        unset($artistOld[$keyExits]);
                    }else{
                        $artistOld[$keyExits]['order'] = $artistOld[$keyExits]['order'] - 1;
                    }
                }
            }
            arsort($artistOld);
            $request->request->set('playlist_artist', serialize($artistOld));

        }
        // order music
        if($request->input('order_music')) {
            $arrMusic = explode(',', substr($request->input('order_music'), 1));
            foreach ($arrMusic as $key => $item) {
                $this->playlistMusicRepository->getModel()::where('music_id', $item)->update(['playlist_order' => $key]);
            }
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
    public function preview(StoreRequest $request, $id) {
        $artist = $this->artistUploadRepository->find($id);
        if(!$artist)
            return view('errors.404');
        return view('artist.index', compact('artist'));
    }
    public function destroy($id)
    {
        $this->crud->hasAccessOrFail('delete');

        // get entry ID from Request (makes sure its the last ID for nested resources)
        $id = $this->crud->getCurrentEntryId() ?? $id;

        if(Storage::exists('public' . Helpers::file_path($id, MUSIC_PLAYLIST_PATH, true) . $id.'.jpg'))
            Storage::delete('public' . Helpers::file_path($id, MUSIC_PLAYLIST_PATH, true) . $id.'.jpg');
        return $this->crud->delete($id);
    }
    public function approvalArtistUpload($id) {
        $artistUpload = $this->artistUploadRepository->findOnlyPublished($id);
        $nameExist = $this->artistRepository->getModel()::where('artist_nickname', $artistUpload->artist_nickname)->first();
        if($nameExist) {
            \Alert::error('Tên Ca sĩ đã tồn tại.')->flash();
            return redirect()->back();
        }
        $result = $this->artistRepository->createArtist($artistUpload);
        $this->artistUploadRepository->delete($id);
        \Alert::success('Xác nhận ca sĩ thành công.')->flash();
        return \Redirect::to($this->crud->route);
    }
    public function approvalPublisher($id) {
        $playlist = PlaylistModel::where('playlist_id', $id)->with('playlist_arr_ids')->first();
        $result = $this->playlistPublisherRepository->create([
            'user_id' => $playlist->user_id,
            'approval_user_id' => Auth::user()->id,
            'playlist_time' => time(),
            'playlist_cat_id' => $playlist->playlist_cat_id,
            'playlist_cat_level' => $playlist->playlist_cat_level,
            'playlist_by_id' => $playlist->playlist_id,
            'playlist_cover' => $playlist->playlist_cover,
            'playlist_artist' => $playlist->playlist_artist,
            'playlist_artist_id' => $playlist->playlist_artist_id,
            'playlist_music_total' => $playlist->playlist_music_total,
            'playlist_status' => DEFAULT_APPROVAL_PUBLISHER,
            'playlist_title' => $playlist->playlist_title
        ]);
        if($playlist->playlist_cover)
            File::copy(Helpers::file_path($playlist->playlist_id, $_SERVER['DOCUMENT_ROOT'].env('DATA_URL').MUSIC_PLAYLIST_PATH, true).$playlist->playlist_id.'.jpg', Helpers::file_path($result->playlist_id, $_SERVER['DOCUMENT_ROOT'].PUBLIC_MUSIC_PLAYLIST_PUBLISHER_PATH, true).$result->playlist_id.'.jpg');
        if(!$result)
            return view('errors.404');
        foreach($playlist->playlist_arr_ids as $item) {
            $this->playlistMusicPublisherRepository->create([
                'playlist_id' => $result->playlist_id,
                'music_id' => $item->music_id,
                'playlist_order' => $item->playlist_order,
            ]);
        }
        \Alert::success('Publisher playlist \<b>'.$playlist->playlist_title.'\</b> thành công.')->flash();
        return \Redirect::to($this->crud->route);
//        return redirect('/admin/playlist_publisher');
    }
}