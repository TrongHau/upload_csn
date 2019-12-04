<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class ErrorBugSlowModel extends Model
{
    protected $table = 'csn_error_bug_slow';
    protected $primaryKey = 'id';
    protected $fillable = ['type', 'link', 'device_display', 'time_load', 'ip_address'];
}
