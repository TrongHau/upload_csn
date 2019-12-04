<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class MusicListenModel extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'music_id';
    protected $table = 'csn_music_listen';
    protected $fillable = ['music_id', 'music_listen', 'music_listen_time', 'music_listen_today', 'music_listen_ago', 'music_listen_today_0', 'music_listen_today_1', 'music_listen_today_2', 'music_listen_today_3', 'music_listen_today_4', 'music_listen_today_5', 'music_listen_today_6', 'music_listen_today_7', 'music_listen_this_week', 'music_listen_max_week'];

    public function hasOneMusic() {
        return $this->hasOne('App\Models\MusicModel', 'music_id');
    }
    public function hasOneVideo() {
        return $this->hasOne('App\Models\VideoModel', 'music_id');
    }
}
