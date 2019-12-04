<?php
namespace App\Repositories\Article;

use App\Repositories\EloquentRepository;
use DB;
class ArticleRepository extends EloquentRepository implements ArticleRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \Backpack\NewsCRUD\app\Models\Article::class;
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

    public function getCategory($id) {
        $result = $this
            ->_model
            ->select('id', 'category_id', 'title', 'slug', 'short_content', 'image', 'date_publish', 'featured', 'views', 'article_by_user_name', 'article_by_user_id', 'article_by_user_id_update', 'tags_name', 'tags_slug', 'tags_id')
            ->where('category_id', $id)
            ->whereDate('date_publish', '<=', date("Y-m-d h:i"))
            ->where('status', STATUS_PUBLISHED)
            ->orderBy('date_publish', 'desc');
        return $result;
    }
    public function getTags($tag) {
        $result = $this
            ->_model
            ->join("csn_article_tag","csn_article_tag.article_id","=","csn_articles.id")
            ->join("csn_tags","csn_article_tag.tag_id","=","csn_tags.id")
            ->select('csn_articles.id', 'csn_articles.category_id', 'csn_articles.title', 'csn_articles.slug', 'csn_articles.short_content', 'csn_articles.image', 'csn_articles.date_publish', 'csn_articles.featured', 'csn_articles.views', 'csn_articles.article_by_user_name', 'csn_articles.article_by_user_id', 'csn_articles.article_by_user_id_update', 'csn_articles.tags_name', 'csn_articles.tags_slug', 'csn_articles.tags_id')
            ->where('csn_tags.slug', $tag)
            ->whereDate('csn_articles.date_publish', '<=', date("Y-m-d h:i"))
            ->where('csn_articles.status', STATUS_PUBLISHED)
            ->orderBy('csn_articles.date_publish', 'desc');
        return $result;
    }

    /**
     * Create
     * @return mixed
     */

}

