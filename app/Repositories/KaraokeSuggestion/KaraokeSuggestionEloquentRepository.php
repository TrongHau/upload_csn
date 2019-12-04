<?php
namespace App\Repositories\KaraokeSuggestion;

use App\Repositories\EloquentRepository;
use DB;
class KaraokeSuggestionEloquentRepository extends EloquentRepository implements KaraokeSuggestionRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\KaraokeSuggestionModel::class;
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

