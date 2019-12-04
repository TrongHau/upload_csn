<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class QrCodeTokenModel extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'csn_qr_code_token';
    protected $fillable = ['session_id', 'token', 'time_expired', 'user_id', 'status'];
}
