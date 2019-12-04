<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use DB;

class LevelModel extends Model
{
    use CrudTrait;
    protected $table = 'csn_level';
    protected $primaryKey = 'level_id';
    protected $fillable = ['level_id', 'level_name', 'level_time_expired', 'level_status', 'level_cen'];
}
