<?php
namespace App\Repositories\MusicFavourite;

use App\Repositories\EloquentRepository;
use DB;
class MusicFavouriteRepository extends EloquentRepository implements MusicFavouriteRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\MusicFavouriteModel::class;
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
    public function deleteFavouriteByMusicId($musicId)
    {
        $result = $this->_model::where('music_id', $musicId)->delete();
        return $result;
    }

    /**
     * Create
     * @return mixed
     */

}

