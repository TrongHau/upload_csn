<?php
/**
 * @author peter.nguyen
 * @email peter.it85@gmail.com
 * @todo
 * @created 10/13/17 11:08 AM
 */

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Zizaco\Entrust\EntrustPermission;
use Spatie\Permission\Models\Permission as OriginalPermission;

class PermissionUserModel extends OriginalPermission
{
    use CrudTrait;

    protected $table = 'csn_permission_user';
    protected $fillable = ['user_id', 'permission_id'];
}