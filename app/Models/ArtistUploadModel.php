<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use App\Library\Helpers;

class ArtistUploadModel extends Model
{
    use CrudTrait;

    public $timestamps = false;
    protected $table = 'csn_artist_upload';
    protected $primaryKey = 'artist_id';
    protected $fillable = ['artist_id', 'artist_nickname', 'artist_url', 'artist_birthday', 'artist_gender', 'artist_country', 'artist_avatar', 'artist_cover', 'artist_avatar_crop_x', 'artist_avatar_crop_y', 'artist_cover_crop_x', 'artist_cover_crop_y', 'last_update_user_id', 'last_update_time', 'last_edit_time', 'type', 'artist_id_suggest'];

    public function getPreviewAvt()
    {
        $urlImg = Helpers::file_path($this->artist_id, PUBLIC_AVATAR_ARTIST_PATH, true) . $this->artist_avatar;
        return '<a href="'.$urlImg.'" target="_blank">
                  <img src="'.$urlImg.'" style="
                      max-height: 25px;
                      width: auto;
                      border-radius: 3px;">
                </a>';
    }
    public function user() {
        return $this->belongsTo('App\Models\UserModel', 'last_update_user_id', 'user_id');
    }
}
