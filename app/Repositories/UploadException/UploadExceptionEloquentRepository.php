<?php
namespace App\Repositories\UploadException;

use App\Repositories\EloquentRepository;
use DB;
class UploadExceptionEloquentRepository extends EloquentRepository implements UploadExceptionRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\UploadExceptionModel::class;
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
            ->where('music_id', $id)
            ->first();

        return $result;
    }
    public function checkExist($title, $artist) {
        $result = $this
            ->_model
            ->where('music_title', $title)
            ->where('music_artist', $artist)
            ->where(function($q) {
                $q->where('date_expirted', null)
                    ->orWhere('date_expirted', '>', time());
            })
            ->first();

        return $result;
    }
}

