<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use DB;

class SearchResultModel extends Model
{
    use CrudTrait;
    protected $table = 'csn_search_result';
    protected $primaryKey = 'id';
    protected $fillable = ['key_search', 'count', 'type', 'type_id'];
}
