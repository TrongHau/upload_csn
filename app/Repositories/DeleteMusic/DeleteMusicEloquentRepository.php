<?php
namespace App\Repositories\DeleteMusic;

use App\Repositories\EloquentRepository;
use DB;
class DeleteMusicEloquentRepository extends EloquentRepository implements DeleteMusicRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\DeleteMusicModel::class;
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
     * Create
     * @return mixed
     */

    /**
     * Get post only published
     * @return mixed
     */
    public function findOnlyPublished($id)
    {
        // TODO: Implement findOnlyPublished() method.
    }
}

