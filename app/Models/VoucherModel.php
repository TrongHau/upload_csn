<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use DB;

class VoucherModel extends Model
{
    use CrudTrait;
    protected $table = 'csn_voucher';
    protected $primaryKey = 'voucher_id';
    protected $fillable = ['gift_value_cen', 'voucher_name', 'level_id', 'voucher_note', 'voucher_status', 'voucher_pay_cen'];
    public function level() {
        return $this->belongsTo('App\Models\LevelModel', 'level_id');
    }
    public function levelEnable() {
        $contracts = \App\Models\LevelModel::where('level_status', 1)->get();
        return $contracts;
    }
    public function levelEnableRow() {
        return $this->belongsTo('App\Models\LevelModel', 'level_id')->where('level_status', 1);
    }
}
