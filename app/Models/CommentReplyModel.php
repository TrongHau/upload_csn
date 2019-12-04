<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Backpack\CRUD\CrudTrait;

class CommentReplyModel extends Model
{
    use CrudTrait;
    public $timestamps = false;
    protected $table = 'csn_comment_reply';
    protected $primaryKey = 'comment_reply_id';
    protected $fillable = ['comment_id', 'user_id', 'username', 'comment_text', 'comment_time', 'comment_jw_postion', 'comment_delete', 'comment_delete_by', 'music_id'];
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
