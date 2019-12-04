<?php
namespace App\Repositories\QrCodeToken;

use App\Repositories\EloquentRepository;
use DB;
use App\Library\Helpers;

class QrCodeTokenRepository extends EloquentRepository implements QrCodeTokenInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\QrCodeTokenModel::class;
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
    public function createQrCode($sessionId, $userId)
    {
        $this
            ->_model->where(['user_id' => $userId])->delete();
        $result = $this
            ->_model->create([
                'session_id' => $sessionId,
                'token' => Helpers::generateRandomString(50),
                'time_expired' => strtotime(TIME_EXPIRED_QR_CODE),
                'user_id' => $userId,
                'status' => 'open'
            ]);
        return $result;
    }

    /**
     * Create
     * @return mixed
     */

}

