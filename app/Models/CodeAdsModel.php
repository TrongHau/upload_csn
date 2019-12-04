<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class CodeAdsModel extends Model
{
    use CrudTrait;

    protected $table = 'csn_code_ads';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'key', 'description', 'status', 'type', 'code1', 'code2', 'code3', 'code4', 'code5', 'code6', 'code7', 'code8', 'code9', 'code10'];

}
