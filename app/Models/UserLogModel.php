<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class UserLogModel extends Model
{
    use CrudTrait;

    public $timestamps = false;
    protected $table = 'csn_user_log';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'log_date', 'type'];
    public function user()
    {
        return $this->belongsTo('App\Models\UserModel', 'user_id');
    }
}
