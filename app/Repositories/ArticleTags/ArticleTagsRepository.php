<?php
namespace App\Repositories\ArticleTags;

use App\Repositories\EloquentRepository;
use DB;
class ArticleTagsRepository extends EloquentRepository implements ArticleTagsRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\ArticleTagsModel::class;
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



    /**
     * Create
     * @return mixed
     */

}

