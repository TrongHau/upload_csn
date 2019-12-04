<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class MusicDownloadModel extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'music_id';
    protected $table = 'csn_music_download';
    protected $fillable = ['music_id', 'music_downloads', 'music_downloads_time', 'music_downloads_ago', 'music_downloads_today', 'music_downloads_today_0', 'music_downloads_today_1', 'music_downloads_today_2', 'music_downloads_today_3', 'music_downloads_today_4', 'music_downloads_today_5', 'music_downloads_today_6', 'music_downloads_today_7', 'music_downloads_this_week', 'music_downloads_max_week'];

    public function hasOneMusic() {
        return $this->hasOne('App\Models\MusicModel', 'music_id');
    }
}
