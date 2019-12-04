<?php
namespace App\Repositories\UserLevel;

use App\Repositories\EloquentRepository;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\UserLevelModel;

class UserLevelEloquentRepository extends EloquentRepository implements UserLevelRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\UserLevelModel::class;
    }
    /**
     * Get all posts only published
     * @return mixed
     */
    public function getAllPublished()
    {
        $result = $this->_model->where('is_published', 1)->get();

        return $result;
    }

    /**
     * Get post only published
     * @param $id int Post ID
     * @return mixed
     */
    public function findOnlyPublished($id)
    {
        $result = $this
            ->_model
            ->where('id', $id)
            ->where('is_published', 1)
            ->first();

        return $result;
    }
    public function upgradeUserLevel($user_id, $level) {
        $userLevel = UserLevelModel::where('user_id', $user_id)->with('level')->first();
        if($userLevel) {
            if($userLevel->level->level_packge != $level->level_packge) {
                // khác cấp (tự động reset hạn mức mới)
                if($userLevel->level->level_packge > $level->level_packge)
                    return ['success' => false, 'msg' => 'Gói hiện tại của bạn cao hơn gói vừa chọn'];
                $userLevel->level_expried = strtotime($level->level_time_expried);
            }else{
                // cùng cấp
                if($userLevel->level_expried > time()) {
                    // thêm gia hạn đã có (thêm hạn mức với hạn mức cũ)
                    $userLevel->level_expried = strtotime($level->level_time_expried, $userLevel->level_expried);
                }else{
                    // bắt đầu gia hạn mới (hiện tại + hạn mức cấp cho)
                    $userLevel->level_expried = strtotime($level->level_time_expried);
                }
            }
            $userLevel->level_id = $level->level_id;
            $userLevel->save();
        }else{
            $userLevel = UserLevelModel::create([
                'user_id' => $user_id,
                'level_id' => $level->level_id,
                'level_expried' => strtotime($level->level_time_expried),
                'level_note' => 'Admin cung cấp',
                'level_status' => 1,
            ]);
        }
        return ['success' => true, 'msg' => 'thành công'];
    }

}

