<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Backpack\CRUD\CrudTrait;
class CommentModel extends Model
{
    use CrudTrait;
    public $timestamps = false;
    protected $table = 'csn_comment';
    protected $primaryKey = 'comment_id';
    protected $fillable = ['music_id', 'user_id', 'username', 'comment_text', 'comment_time', 'comment_reply', 'comment_jw_postion', 'comment_delete', 'comment_delete_by'];

    public function user()
    {
        return $this->belongsTo('App\Models\UserModel', 'user_id')->select('id', 'name', 'user_avatar', 'username');
    }
    public function music()
    {
        return $this->belongsTo('App\Models\MusicModel', 'music_id');
    }
    public function video()
    {
        return $this->belongsTo('App\Models\VideoModel', 'music_id');
    }
}
