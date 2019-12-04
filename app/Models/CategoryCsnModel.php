<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class CategoryCsnModel extends Model
{
    use CrudTrait;

    public $timestamps = false;
    protected $table = 'csn_category';
    protected $primaryKey = 'cat_id';
    protected $fillable = ['cat_level', 'cat_title', 'cat_short_title', 'cat_url', 'cat_music', 'cat_order', 'cat_last_hot_song'];

    public function parent()
    {
        return $this->belongsTo('App\Models\CategoryCsnModel', 'cat_level', 'cat_id');
    }
}
