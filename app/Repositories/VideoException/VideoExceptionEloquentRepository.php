<?php
namespace App\Repositories\VideoException;

use App\Repositories\EloquentRepository;
use DB;
class VideoExceptionEloquentRepository extends EloquentRepository implements VideoExceptionRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\VideoExceptionModel::class;
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
    public function findOnlyPublished($id)
    {
        $result = $this
            ->_model
            ->where('is_published', 1)
            ->first();

        return $result;
    }

    /**
     * Get post only published
     * @param $id int Post ID
     * @return mixed
     */


}

