<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class MailTokenModel extends Model
{
    public $timestamps = false;
    protected $table = 'csn_mail_token';
    protected $fillable = ['email', 'token', 'created_at'];

    public static function deleteToken($email) {
        $q = "DELETE FROM csn_mail_token where email = '" . $email . "'";
        $result = DB::connection('mysql')->select($q);
        return $result;
    }

}
