<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8/21/2018
 * Time: 4:29 PM
 */
namespace App\Models;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class DeleteVideoModel extends Model
{
    use CrudTrait;
    public $timestamps = false;
    protected $table = 'csn_delete_video';
    protected $primaryKey = 'music_id';
    protected $fillable =
        [
            'music_id' ,'cat_id', 'cat_level', 'cat_sublevel', 'cat_custom', 'cover_id', 'music_download_time', 'music_last_update_time', 'music_title_url', 'music_title_search', 'music_artist_search',
            'music_album_search', 'music_title', 'music_artist', 'music_artist_id', 'music_composer', 'music_album', 'music_production', 'music_album_id', 'music_track_id', 'music_year', 'music_code_1', 'music_code_2',
            'music_shortlyric', 'music_listen', 'music_downloads', 'music_downloads_today', 'music_downloads_today_0', 'music_downloads_this_week', 'music_downloads_max_week', 'music_time', 'music_bitrate',
            'music_length', 'music_filename', 'music_32_filesize', 'music_filesize', 'music_320_filesize', 'music_width', 'music_height', 'music_thumbs_time', 'music_user_id', 'music_username', 'music_spectrum',
            'music_bitrate_fixed_by', 'music_lyric', 'music_note', 'music_deleted', 'music_dmca', 'music_download_ip', 'music_comment'
        ];
    public function musicListen() {
        return $this->belongsTo('App\Models\MusicListenModel', 'music_id', 'music_id');
    }
    public function musicKara() {
        return $this->belongsTo('App\Models\MusicKaraokeModel', 'music_id', 'music_id');
    }
}
