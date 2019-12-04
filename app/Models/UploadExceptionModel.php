<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8/17/2018
 * Time: 9:49 AM
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class UploadExceptionModel extends Model
{
    use CrudTrait;
    protected $table = 'csn_upload_copyright';
    protected $primaryKey = 'music_id';
    protected $fillable = ['music_id', 'cat_id', 'cat_level', 'cat_sublevel', 'cat_custom', 'cover_id', 'music_title', 'music_artist', 'music_artist_id', 'music_composer', 'music_album', 'music_production', 'music_album_id', 'music_track_id', 'music_year', 'music_code_1', 'music_code_2',
         'music_time', 'music_bitrate', 'music_length', 'music_filename', 'music_filename_upload', 'music_32_filesize', 'music_filesize', 'music_320_filesize', 'music_m4a_filesize', 'music_lossless_filesize', 'music_width', 'music_height', 'music_thumbs_time', 'music_user_id', 'music_username',
         'music_original_id', 'music_note', 'music_lyric', 'music_security_code', 'music_last_update_time', 'music_last_update_by', 'music_bitrate_fixed_time', 'music_bitrate_fixed_by', 'music_metadata', 'music_spectrum', 'music_bitrate_fixed', 'music_state', 'music_dmca', 'music_deleted', 'music_updated', 'music_source_url', 'date_expirted'];
}
