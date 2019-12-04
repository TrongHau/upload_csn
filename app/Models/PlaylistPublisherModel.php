<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Backpack\CRUD\CrudTrait;

class PlaylistPublisherModel extends Model
{
    use CrudTrait;
    public $timestamps = false;
    protected $table = 'csn_playlist_publisher';
    protected $primaryKey = 'playlist_id';
    protected $fillable = ['playlist_cat_id', 'playlist_cat_level', 'playlist_artist', 'playlist_cover', 'playlist_music_total', 'user_id', 'playlist_status', 'playlist_title', 'playlist_desc', 'playlist_time', 'playlist_listen', 'approval_user_id', 'playlist_by_id', 'playlist_artist_id', 'playlist_artist_name'];

    public function playlist_music() {
        return $this->hasMany('App\Models\PlaylistMusicPublisherModel', 'playlist_id', 'playlist_id')->with('music');
    }
    public function playlist_arr_ids() {
        return $this->hasMany('App\Models\PlaylistMusicPublisherModel', 'playlist_id', 'playlist_id')->orderBy('playlist_order', 'asc');
    }
    public function music() {
        return $this->hasManyThrough(
            'App\Models\MusicModel',
            'App\Models\PlaylistMusicPublisherModel',
            'playlist_id',
            'music_id',
            'playlist_id',
            'music_id'
        )->orderBy('playlist_order', 'asc')
            ->select('csn_music.music_id', 'csn_music.music_title_url', 'csn_music.music_title', 'csn_music.music_artist', 'csn_music.music_artist_id', 'csn_music.cat_id', 'csn_music.cat_level', 'csn_music.cat_sublevel', 'csn_music.cat_custom', 'csn_music.cover_id', 'csn_music.music_download_time',
            'csn_music.music_last_update_time', 'csn_music.music_title_url', 'csn_music.music_title_search', 'csn_music.music_artist_search', 'csn_music.music_album_search', 'csn_music.music_composer', 'csn_music.music_album', 'csn_music.music_listen', 'csn_music.music_track_id', 'csn_music.music_filename', 'csn_music.music_bitrate');
    }
    public function video() {
        return $this->hasManyThrough(
            'App\Models\VideoModel',
            'App\Models\PlaylistMusicPublisherModel',
            'playlist_id',
            'music_id',
            'playlist_id',
            'music_id'
        )->select('csn_video.music_id', 'csn_video.music_title_url', 'csn_video.music_title', 'csn_video.music_artist', 'csn_video.music_artist_id', 'csn_video.cat_id', 'csn_video.cat_level', 'csn_video.cat_sublevel', 'csn_video.cat_custom', 'csn_video.cover_id', 'csn_video.music_download_time',
            'csn_video.music_last_update_time', 'csn_video.music_title_url', 'csn_video.music_title_search', 'csn_video.music_artist_search', 'csn_video.music_album_search', 'csn_video.music_composer', 'csn_video.music_album', 'csn_video.music_listen', 'csn_video.music_track_id', 'csn_video.music_filename', 'csn_video.music_bitrate');
    }
    public function playlist_category_cat_id() {
        return $this->belongsTo('App\Models\CategoryPlaylistModel', 'playlist_cat_id', 'cat_id');
    }
    public function playlist_category_cat_level() {
        return $this->belongsTo('App\Models\CategoryPlaylistModel', 'playlist_cat_level', 'cat_level');
    }
    public function playlist_user() {
        return $this->belongsTo('App\Models\UserModel', 'user_id');
    }
    static function getPlayListCategoryByUserId($id)
    {
        $query = 'select `csn_playlist_publisher`.*, csn_playlist_publisher.cat_title, csn_playlist_publisher.cat_url, DATE_FORMAT(FROM_UNIXTIME(`playlist_time`), \'%d-%m-%Y\') as "playlist_date"
                from `csn_playlist_publisher` left join `csn_playlist_publisher` on `csn_playlist_publisher`.`playlist_cat_id` = `csn_playlist_publisher`.`cat_id` 
                and `csn_playlist_publisher`.`playlist_cat_level` = `csn_playlist_publisher`.`cat_level` 
                where `user_id` = '.$id;
        $result = DB::connection('mysql')->select($query);
        return $result;
    }

}
