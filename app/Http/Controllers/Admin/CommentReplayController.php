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
use App\Repositories\Music\MusicEloquentRepository;
use App\Repositories\User\UserEloquentRepository;

class CommentReplayController extends CrudController
{
    protected $deleteMusicRepository;
    protected $musicRepository;
    protected $userRepository;

    public function __construct(MusicEloquentRepository $musicRepository, UserEloquentRepository $userRepository)
    {
        $this->musicRepository = $musicRepository;
        $this->userRepository = $userRepository;
        $this->middleware(function ($request, $next)
        {
            if(!backpack_user()->can('comment_(list)')) {
                $this->crud->denyAccess(['list']);
            }
            if(!backpack_user()->can('comment_(edit)')) {
                $this->crud->denyAccess(['update']);
            }
            if(!backpack_user()->can('comment_(delete)')) {
                $this->crud->denyAccess(['delete']);
            }
            return $next($request);
        });
        parent::__construct();

    }
    public function setup()
    {

        $this->crud->setModel("App\Models\CommentReplyModel");
        $this->crud->setEntityNameStrings('Trả lời bình luận', 'Trả lời bình luận');
        $this->crud->setRoute(config('backpack.base.route_prefix').'/comment_replay');
//        $this->crud->setEntityNameStrings('menu item', 'menu items');
        $this->crud->orderBy('comment_reply_id', 'desc');
        $this->crud->denyAccess(['create']);

        $this->crud->addFilter([ // daterange filter
            'type' => 'date_range',
            'name' => 'from_to',
            'label'=> 'Hiển thị theo thời gian'
        ],
            false,
            function($value) {
                $dates = json_decode(htmlspecialchars_decode($value, ENT_QUOTES));
                $this->crud->addClause('where', 'comment_time', '>=', strtotime($dates->from . ' 00:00'));
                $this->crud->addClause('where', 'comment_time', '<=', strtotime($dates->to . ' 23:59'));
//                $this->crud->removeColumns(['created_at']);
            });

        $this->crud->addColumn([
            'name'  => 'comment_reply_id',
            'label' => 'ID',
            'type' => 'closure',
            'function' => function($entry) {
                return '<a href="/user/music_uploaded/redirect/'.$entry->music_id.'" target="_blank">'.$entry->comment_reply_id.'</a>';
            },
        ]);
        $this->crud->addColumn([
            'name' => 'comment_time',
            'label' => 'Ngày tạo',
            'type' => 'date',
        ]);
        $this->crud->addColumn([
            'name' => 'comment_text',
            'label' => 'Nội dung bình luận',
        ]);
        $this->crud->addColumn([
            'name' => 'comment_delete',
            'label' => 'Blocked',
            'type' => 'check',
        ]);
        $this->crud->addColumn([
            'label' => 'Người tạo',
            'type' => 'select',
            'name' => 'user_id',
            'entity' => 'user',
            'attribute' => 'name',
            'model' => "App\User",
        ]);
        $this->crud->addColumn([
            'label' => 'Bài hát/Video',
            'type' => 'closure',
            'name' => 'music_id',
            'entity' => 'music',
            'attribute' => 'music_title',
            'model' => "App\Models\MusicModel",
            'function' => function($entry) {
                $music = $entry->music()->first();
                if($music) {
                    return '<a target="_blank" href="'.Helpers::listen_url($music->toArray()).'" >'.$music->music_title.'</a>';
                }else{
                    $music = $entry->video()->first();
                    if($music)
                        return '<a target="_blank" href="'.Helpers::listen_url($music->toArray()).'" >'.$music->music_title.'</a>';
                    return '-';
                }
            },
        ]);
//        $this->crud->addColumn([
//            'label' => 'Bài hát',
//            'type' => 'select',
//            'name' => 'music_id',
//            'entity' => 'music',
//            'attribute' => 'music_title',
//            'model' => "App\Models\MusicModel",
//        ]);

//        $this->crud->addColumn([
//            'name'  => 'user_id',
//            'label' => 'User',
//            'type' => 'closure',
//            'function' => function($entry) {
//                $user = $entry->user()->first();
//                if($user) {
//                    return '<a href="/user/'.$user->id.'" target="_blank">'.$user->name.'</a>';
//                }
//                return '<a href="/user/'.$entry->id.'" target="_blank">'.$entry->name.'</a>';
//            },
//        ]);

        $this->crud->addField([
            'name' => 'comment_text',
            'type' => 'textarea',
            'label' => 'Nội dung bình luận',
        ]);
        $this->crud->addField([    // CHECKBOX
            'name' => 'comment_delete',
            'label' => 'Tình trạng xóa',
            'type' => 'checkbox',
        ]);
    }

    public function store(StoreRequest $request)
    {
        return parent::storeCrud();
    }
    public function destroy($id)
    {
        $this->crud->hasAccessOrFail('delete');

        // get entry ID from Request (makes sure its the last ID for nested resources)
        $id = $this->crud->getCurrentEntryId() ?? $id;
        $comment = $this->crud->getModel()::where('comment_reply_id', $id)->first();
        $this->musicRepository->decrementCol($comment->music_id, 'music_comment');
        $this->userRepository->decrementCol($comment->user_id, 'user_comments');
        return $this->crud->delete($id);
    }
    public function update(UpdateRequest $request)
    {
        return parent::updateCrud();
    }
}