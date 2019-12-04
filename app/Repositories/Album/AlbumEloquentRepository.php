<?php
namespace App\Repositories\Album;

use App\Repositories\EloquentRepository;
use DB;
class AlbumEloquentRepository extends EloquentRepository implements AlbumRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\AlbumModel::class;
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

    public function findAlbumByUser($userId, $fillOrder, $typeOrder, $page)
    {
        $result = $this->_model::where('user_id', $userId)
            ->orderBy($fillOrder, $typeOrder)
            ->paginate($page);
        return $result;
    }
    public function findAlbum($userId, $id)
    {
        $result = $this
            ->_model
            ->where('album_id', $id)
            ->where('user_id', $userId)
            ->first();

        return $result;
    }
    public function create(array $attributes)
    {
        $result = $this->_model::firstOrCreate($attributes);
        return $result;
    }


    /**
     * Create
     * @return mixed
     */

}

