<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class CoverModel extends Model
{
    public $timestamps = false;
    protected $table = 'csn_cover';
    protected $primaryKey = 'cover_id';
    protected $fillable = ['music_album', 'music_production', 'music_year', 'cover_filename', 'user_id', 'last_user_id', 'album_artist_1', 'album_artist_id_1', 'album_artist_2', 'album_artist_id_2', 'album_cat_id_1', 'album_cat_level_1', 'album_cat_id_2', 'album_cat_level_2', 'music_bitrate', 'album_last_updated', 'album_music_total', 'album_listen', 'album_avg'];

    public function music() {
        return $this->hasMany('App\Models\MusicModel', 'cover_id', 'cover_id')->select('music_id', 'music_title_url', 'music_title', 'music_artist', 'music_artist_id', 'cat_id', 'cat_level', 'cat_sublevel', 'cat_custom', 'cover_id', 'music_download_time', 'music_last_update_time', 'music_title_url',
            'music_title_search', 'music_artist_search', 'music_album_search', 'music_composer', 'music_album', 'music_listen', 'music_track_id', 'music_track_id', 'music_filename', 'music_bitrate', 'music_length', 'music_time', 'music_width', 'music_height')->where('music_deleted', '<=', 0)->orderBy('music_track_id', 'asc')->orderBy('music_id', 'asc');
    }
    public function musicDownload() {
        return $this->hasMany('App\Models\MusicModel', 'cover_id', 'cover_id')->select('music_id', 'music_title', 'music_artist', 'music_filename', 'music_32_filesize', 'music_filesize', 'music_320_filesize', 'music_m4a_filesize', 'music_lossless_filesize')->where('music_deleted', '<=', 0)->orderBy('music_track_id', 'asc')->orderBy('music_id', 'asc');
    }
    public function upload() {
        return $this->hasMany('App\Models\UploadModel', 'cover_id', 'cover_id');
    }
    public function video() {
        return $this->hasMany('App\Models\VideoModel', 'cover_id', 'cover_id')->select('music_id', 'music_title_url', 'music_title', 'music_artist', 'music_artist_id', 'cat_id', 'cat_level', 'cat_sublevel', 'cat_custom', 'cover_id', 'music_download_time', 'music_last_update_time', 'music_title_url',
            'music_title_search', 'music_artist_search', 'music_album_search', 'music_composer', 'music_album', 'music_listen', 'music_track_id', 'music_track_id', 'music_filename', 'music_bitrate', 'music_length', 'music_time', 'music_width', 'music_height')->where('music_deleted', '<=', 0)->orderBy('music_track_id', 'asc')->orderBy('music_id', 'asc');
    }
    public function uploadFile() {
        return $this->hasMany('App\Models\UploadModel', 'cover_id', 'cover_id')->orderBy('music_track_id', 'asc')->get();
    }

}
