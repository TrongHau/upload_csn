<?php namespace App\Models;

use Zizaco\Entrust\EntrustRole;

class RoleUser extends EntrustRole
{
  protected $table = 'csn_role_user';
  protected $fillable =
    [
      'user_id',
      'role_id'
    ];
}
