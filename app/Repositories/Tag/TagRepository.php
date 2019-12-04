<?php
namespace App\Repositories\Tag;

use App\Repositories\EloquentRepository;
use DB;
class TagRepository extends EloquentRepository implements TagRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \Backpack\NewsCRUD\app\Models\Tag::class;
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
            ->whereDate('date_publish', '<=', date("Y-m-d h:i"))
            ->where('status', STATUS_PUBLISHED)
            ->first();

        return $result;
    }


    /**
     * Create
     * @return mixed
     */

}

