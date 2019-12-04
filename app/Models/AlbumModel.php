<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class AlbumModel extends Model
{
    public $timestamps = false;
    protected $table = 'csn_album';
    protected $primaryKey = 'album_id';
    protected $fillable = ['album_id', 'album_name', 'album_production', 'album_code', 'album_year', 'cover_filename', 'album_music_total', 'user_id'];
    public function uploadFile() {
        return $this->hasMany('App\Models\UploadModel', 'album_id', 'album_id')->get();
    }
}
