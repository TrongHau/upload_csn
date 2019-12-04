<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8/13/2018
 * Time: 2:10 PM
 */
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Notifications\Notifiable;
use DB;
use Illuminate\Support\Facades\Config;
use Backpack\CRUD\CrudTrait;
use Spatie\Permission\Traits\HasRoles;

class UserModel extends Authenticatable
{
//    use EntrustUserTrait, Notifiable;
    use Notifiable;
    use CrudTrait;
    use EntrustUserTrait;
//    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'csn_users';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_active', 'username', 'password', 'user_identity', 'name', 'user_level', 'user_session_time', 'user_session_page', 'user_lastvisit',
        'user_regdate', 'user_music', 'user_comments', 'user_money', 'user_money_upload', 'user_money_download', 'user_login_tries', 'user_last_login_try', 'user_allow_viewonline', 'user_avatar',
        'email', 'user_phone_number', 'user_interests', 'user_actkey', 'user_birthday', 'user_gender', 'user_favourite', 'remember_token', 'user_fb_identity', 'user_music_recent'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roleUser()
    {
        return $this->belongsTo('App\Models\RoleUserModel', 'user_id');
    }
    public function rolesCSNRoleName()
    {
        $relationship = $this->belongsToMany(Config::get('entrust.role'), Config::get('entrust.role_user_table'), Config::get('entrust.user_foreign_key'), Config::get('entrust.role_foreign_key'))->first();
        if(!$relationship)
            return DEFAULT_ROLE_NAME_EMPTY;
        return $relationship->name;
    }
    public function level() {
        return $this->belongsTo('App\Models\UserLevelModel', 'user_id')->first();
    }

}