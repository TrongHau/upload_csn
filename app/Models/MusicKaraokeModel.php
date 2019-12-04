<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class MusicKaraokeModel extends Model
{
    use CrudTrait;
    public $timestamps = false;
    protected $table = 'csn_music_karaoke';
    protected $primaryKey = 'music_id';
    protected $fillable =
        [
            'music_id' ,'music_title', 'music_artist', 'music_downloads_this_week', 'music_time', 'music_lyric_karaoke', 'user_id', 'music_update_time'
        ];
    public function user()
    {
        return $this->belongsTo('App\Models\UserModel', 'user_id')->select('id', 'name', 'user_avatar', 'username');
    }
}
