<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use DB;

class KaraokeSuggestionModel extends Model
{
    use CrudTrait;
    public $timestamps = false;
    protected $table = 'csn_music_karaoke_suggestion';
    protected $primaryKey = 'id';
    protected $fillable = ['music_id', 'music_title', 'music_artist', 'music_downloads_this_week', 'music_time', 'music_length', 'music_lyric_karaoke', 'user_id'];
    public function user()
    {
        return $this->belongsTo('App\Models\UserModel', 'user_id')->select('id', 'name', 'user_avatar', 'username');
    }
}
