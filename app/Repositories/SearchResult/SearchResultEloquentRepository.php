<?php
namespace App\Repositories\SearchResult;

use App\Repositories\EloquentRepository;
use DB;
class SearchResultEloquentRepository extends EloquentRepository implements SearchResultRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\SearchResultModel::class;
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

    public function createAnalytics($ref, $key, $id = '', $type) {
        $result = $this->_model->where('key_search', $key)->where('type', $type)->first();
        if($result) {
            $result->count = $result->count + 1;
            $result->save();
        }else{
            $this->_model::firstOrCreate([
                'key_search' => $key,
                'type_id' => $id,
                'type' => $type,
                'count' => 1,
            ]);
        }
        return true;
    }
}

