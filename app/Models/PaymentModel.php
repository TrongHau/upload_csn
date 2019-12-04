<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use DB;

class PaymentModel extends Model
{
    use CrudTrait;
    protected $table = 'csn_payment';
    protected $primaryKey = 'payment_id';
    protected $fillable = ['payment_id', 'user_id', 'level_id', 'voucher_id', 'pay_cen_value', 'pay_cen_promotion', 'cen_current_user', 'note', 'status', 'cen_add', 'time_add_expired', 'pay_money_value', 'status', 'request_from', 'level_cen', 'level_money', 'pay_money_promotion'];
    public function level() {
        return $this->belongsTo('App\Models\LevelModel', 'level_id');
    }
    public function voucher() {
        return $this->belongsTo('App\Models\VoucherModel', 'voucher_id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\UserModel', 'user_id')->select('id', 'name', 'user_avatar', 'username');
    }
}
