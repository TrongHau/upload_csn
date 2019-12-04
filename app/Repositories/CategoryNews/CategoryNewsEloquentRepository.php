<?php
namespace App\Repositories\CategoryNews;

use App\Repositories\EloquentRepository;
use DB;
class CategoryNewsEloquentRepository extends EloquentRepository implements CategoryNewsRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \Backpack\NewsCRUD\app\Models\Category::class;
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
    public function getAllParentCategory($level, $whereExt = array())
    {
        $result = $this
            ->_model
            ->where('cat_level', $level);
        if($whereExt) {
            $result->where($whereExt);
        }
        return $result->orderBy('cat_order', 'asc')
            ->select('cat_id', 'cat_level', 'cat_title', 'cat_short_title', 'cat_url')
            ->get();
    }
    public function getAllCatId($id, $whereExt = array())
    {
        $result = $this
            ->_model
            ->where('cat_id', $id);
        if($whereExt) {
            $result->where($whereExt);
        }
        return $result->orderBy('cat_order', 'asc')
            ->select('cat_id', 'cat_level', 'cat_title', 'cat_short_title', 'cat_url')
            ->get();
    }
    public function getCategoryParentByUrl($url)
    {
        $result = $this
            ->_model
            ->where('cat_url', $url)
            ->where('cat_level', 0)
            ->first();
        return $result;
    }
    public function getCategoryParent()
    {
        $result = $this
            ->_model
            ->where('cat_level', 0)
            ->get();
        return $result;
    }
    public function getCategorySub($idParent, $url)
    {
        $result = $this
            ->_model
            ->where('cat_id', $idParent)
            ->where('cat_url', $url)
            ->first();
        return $result;
    }
    public function getCategoryUrl($url)
    {
        $result = $this
            ->_model
            ->where('cat_url', $url)
            ->first();
        return $result;
    }

}

