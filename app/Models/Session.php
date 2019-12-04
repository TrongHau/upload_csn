<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use DB;

class Session extends Model
{
    use CrudTrait;
    public $timestamps = false;
    protected $table = 'sessions';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'ip_address', 'user_agent', 'payload', 'last_activity'];
}
