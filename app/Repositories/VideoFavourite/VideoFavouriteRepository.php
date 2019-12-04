<?php
namespace App\Repositories\VideoFavourite;

use App\Repositories\EloquentRepository;
use DB;
class VideoFavouriteRepository extends EloquentRepository implements VideoFavouriteRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\VideoFavouriteModel::class;
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

    /**
     * Create
     * @return mixed
     */

}

