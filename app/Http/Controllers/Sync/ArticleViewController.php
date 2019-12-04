<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8/17/2018
 * Time: 3:38 PM
 */
namespace App\Http\Controllers\Sync;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request as Request;
use Illuminate\Support\Facades\Auth;
use App\Library\Helpers;
use App\Repositories\Article\ArticleRepository;
use App\Repositories\ArticleTags\ArticleTagsRepository;
use App\Repositories\Tag\TagRepository;
use App\Repositories\ArticleView\ArticleViewRepository;
use App\Repositories\CategoryNews\CategoryNewsEloquentRepository;
use Illuminate\Support\Facades\Storage;
use DB;
use File;

class ArticleViewController extends Controller
{
    protected $articleRepository;
    protected $articleViewRepository;
    protected $categoryNewsRepository;
    protected $tagArticleRepository;
    protected $tagRepository;

    public function __construct(ArticleRepository $articleRepository, ArticleViewRepository $articleViewRepository, CategoryNewsEloquentRepository $categoryNewsRepository, ArticleTagsRepository $tagArticleRepository, TagRepository $tagRepository) {
        $this->articleRepository = $articleRepository;
        $this->articleViewRepository = $articleViewRepository;
        $this->categoryNewsRepository = $categoryNewsRepository;
        $this->tagArticleRepository = $tagArticleRepository;
        $this->tagRepository = $tagRepository;
    }
    public function syncArticleView() {
        $query  = "UPDATE csn_article_view SET article_view_this_week = (article_view_today_7 + article_view_today_6 + article_view_today_5 + article_view_today_4 + article_view_today_3 + article_view_today_2 + article_view_today_1), article_view_today_7 = article_view_today_6,
                        article_view_today_6 = article_view_today_5, article_view_today_5 = article_view_today_4, article_view_today_4 = article_view_today_3, article_view_today_3 = article_view_today_2, article_view_today_2 = article_view_today_1, article_view_today_1 = article_view_today_0, 
                        article_view_ago = article_view_today_0, article_view_today = article_view_today / 2, article_view_today_0 = 0, article_view_max_week = IF(article_view_this_week > article_view_max_week, article_view_this_week, article_view_max_week)";
        $result = DB::connection( 'mysql' )->select( $query );
        return response(['Ok']);
    }

    public function realArticleView(){
        $query  = "UPDATE csn_article_view AS v, csn_articles AS a 
                        SET a.views = v.article_view, a.article_view_time = v.article_view_time
                        WHERE v.article_view_time > ".strtotime(TIME_EXPIRED_UPLOAD_LISTEN_DOWNLOAD)."
                            AND a.id = v.article_id";
        $result = DB::connection( 'mysql' )->select( $query );

//        $Solr = new SolrSyncController($this->Solr);
//        $Solr->syncMusic(null, null, strtotime(TIME_EXPIRED_UPLOAD_LISTEN_DOWNLOAD), 'article_view_time');
        return response(['Ok']);
    }
}