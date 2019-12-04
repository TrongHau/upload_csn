<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use DB;

class ArtistFavouriteModel extends Model
{
    public $timestamps = false;
    protected $table = 'csn_artist_favourite';
    protected $fillable = ['artist_id', 'user_id'];
    public function artist() {
        return $this->belongsTo('App\Models\ArtistModel', 'artist_id', 'artist_id');
    }
}
