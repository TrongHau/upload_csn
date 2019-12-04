<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class MusicFavouriteModel extends Model
{
    public $timestamps = false;
    protected $table = 'csn_music_favourite';
    protected $fillable = ['music_id', 'user_id'];
    public function music() {
        return $this->belongsTo('App\Models\MusicModel', 'music_id', 'music_id')->select('music_id', 'music_title_url', 'music_title', 'music_artist', 'music_artist_id', 'cat_id', 'cat_level', 'cat_sublevel', 'cat_custom', 'cover_id', 'music_download_time', 'music_last_update_time', 'music_title_url',
            'music_title_search', 'music_artist_search', 'music_album_search', 'music_composer', 'music_album', 'music_listen', 'music_track_id', 'music_filename', 'music_filename', 'music_width', 'music_height', 'music_bitrate');
    }
}
