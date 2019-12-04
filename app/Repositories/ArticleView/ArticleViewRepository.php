<?php
namespace App\Repositories\ArticleView;

use App\Repositories\EloquentRepository;
use DB;
class ArticleViewRepository extends EloquentRepository implements ArticleViewRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\ArticleViewModel::class;
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

    public function incrementView($id)
    {
        $result = $this
            ->_model->where('article_id', $id)
            ->first();
        if(!$result){
            $this
                ->_model
                ->create([
                    'article_id' => $id,
                    'article_view' => 1,
                    'article_view_today_0' => 1,
                    'article_view_time' => time(),
                ]);
        }else{
            $result->update([
                'article_view' => DB::raw('article_view + 1'),
                'article_view_today_0' => DB::raw('article_view_today_0 + 1'),
                'article_view_time' => time(),
            ]);
        }
        return $result;
    }

    /**
     * Create
     * @return mixed
     */

}

