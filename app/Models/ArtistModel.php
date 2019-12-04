<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use DB;

class ArtistModel extends Model
{
    use CrudTrait;
    protected $table = 'csn_artist';
    protected $primaryKey = 'artist_id';
    protected $fillable = ['artist_id', 'artist_nickname', 'artist_realname', 'artist_url', 'artist_birthday', 'artist_gender', 'artist_country', 'artist_avatar', 'artist_cover', 'artist_desc', 'last_update_user_id', 'article_view_time'];

    public static function searchArtist($keyName)
    {
        $keyName = htmlspecialchars_decode(str_replace("'", "\'", $keyName), ENT_QUOTES);
        $query = "
          select artist_id as id, artist_nickname as name
            from csn_artist
            where LOWER(csn_artist.artist_nickname) like LOWER(N'%" . $keyName . "%')
            limit " . LIMIT_SEARCH_RESULT . "
        ";
        $result = DB::connection('mysql')->select($query);
        return $result;
    }
    public function user() {
        return $this->belongsTo('App\Models\UserModel', 'last_update_user_id', 'user_id');
    }
}
