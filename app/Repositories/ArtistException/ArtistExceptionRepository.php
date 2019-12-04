<?php
namespace App\Repositories\ArtistException;

use App\Repositories\EloquentRepository;
use DB;
class ArtistExceptionRepository extends EloquentRepository implements ArtistExceptionRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\ArtistExceptionModel::class;
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
            ->where('artist_id', $id)
            ->first();

        return $result;
    }
    public function getArrIds()
    {
        $result = $this->_model->select('artist_id')->get();
        $arr = [];
        foreach ($result as $item) {
            $arr[] = $item->artist_id;
        }
        return $arr;
    } public function getArrNames()
    {
        $result = $this->_model->select('artist_nickname')->get();
        $arr = [];
        foreach ($result as $item) {
            $arr[] = $item->artist_nickname;
        }
        return $arr;
    }


    /**
     * Create
     * @return mixed
     */

}

