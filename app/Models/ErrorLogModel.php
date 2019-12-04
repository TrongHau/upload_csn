<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class ErrorLogModel extends Model
{
    protected $table = 'csn_error_log';
    protected $primaryKey = 'id';
    protected $fillable = ['request', 'type', 'url', 'view', 'message', 'parameter', 'note', 'user_id', 'ip_address', 'count_request', 'device_display'];
}
