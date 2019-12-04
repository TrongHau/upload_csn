<?php
namespace App\Repositories\Level;

use App\Repositories\EloquentRepository;
use Illuminate\Support\Facades\Auth;
use DB;
class LevelEloquentRepository extends EloquentRepository implements LevelRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\LevelModel::class;
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

}

