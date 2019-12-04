<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use DB;

class ArtistExceptionModel extends Model
{
    use CrudTrait;
    protected $table = 'csn_artist_exception';
    protected $primaryKey = 'artist_id';
    protected $fillable = ['artist_id', 'artist_nickname', 'artist_realname', 'artist_url', 'artist_birthday', 'artist_gender', 'artist_country', 'artist_avatar', 'artist_cover', 'artist_desc', 'last_update_user_id'];
    public function user() {
        return $this->belongsTo('App\Models\UserModel', 'last_update_user_id', 'user_id');
    }
   
}
