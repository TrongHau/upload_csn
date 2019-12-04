<?php
namespace App\Repositories\MusicSearchResult;

use App\Repositories\EloquentRepository;
use Carbon\Carbon;
use DB;

class MusicSearchResultEloquentRepository extends EloquentRepository implements MusicSearchResultRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\MusicSearchResultModel::class;
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
    public function createSearch($music)
    {
        $result = $this
            ->_model->where('music_id', $music->music_id)
            ->whereDate('created_at', Carbon::today())
            ->first();
        if(!$result) {
            $result = $this->_model->create($music->toArray());
        }else {
            $result->music_search_count = $result->music_search_count + 1;
            $result->save();
        }
        return $result;
    }

}

