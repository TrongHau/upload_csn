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

class ArticleCategoryController extends Controller
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
    public function popularNewsCategory() {

        $categories = [2, 3, 4];
        foreach ($categories as $item) {
            $result[$item] = $this->articleViewRepository->getModel()::join("csn_articles","csn_articles.id","=","csn_article_view.article_id")
                ->select(DB::raw('csn_articles.id, csn_articles.category_id, csn_articles.title, csn_articles.slug, csn_articles.date_publish, csn_articles.short_content, csn_articles.image, csn_articles.article_by_user_name, csn_articles.article_by_user_id'))
                ->where('csn_articles.status', 'PUBLISHED')
                ->where('csn_articles.category_id', $item)
                ->whereDate('date_publish', '<=', date("Y-m-d h:i"))
                ->orderBy('csn_article_view.article_view_today_0', 'desc')
                ->orderBy('csn_article_view.article_view_today_1', 'desc')
                ->orderBy('csn_article_view.article_view_this_week', 'desc')
                ->orderBy('csn_article_view.article_view', 'desc')
                ->orderBy('csn_article_view.article_id', 'desc')
                ->limit(7)
                ->get()
                ->toArray();
        }
        $pathDir = resource_path() . '/views/cache/news/';
        file_put_contents($pathDir.'popular_category.blade.php',
            '<?php 
if ( !ENV(\'IN_PHPBB\') )
{
    die(\'Hacking attempt\');
    exit;
}
global $popular_category;
$popular_category = ' . var_export($result, true) . ';
?>');
        return response(['Ok']);
    }
    public function popularPost() {
        // tin nỗi bật
        $result = $this->articleViewRepository->getModel()::join("csn_articles","csn_articles.id","=","csn_article_view.article_id")
            ->select(DB::raw('csn_articles.id, csn_articles.category_id, csn_articles.title, csn_articles.slug, csn_articles.date_publish, csn_articles.short_content, csn_articles.image, csn_articles.article_by_user_name, csn_articles.article_by_user_id'))
            ->where('csn_articles.status', 'PUBLISHED')
            ->whereDate('date_publish', '<=', date("Y-m-d h:i"))
            ->orderBy('csn_article_view.article_view_today_0', 'desc')
            ->orderBy('csn_article_view.article_view_today_1', 'desc')
            ->orderBy('csn_article_view.article_view_this_week', 'desc')
            ->orderBy('csn_article_view.article_id', 'desc')
            ->limit(15)
            ->get()
            ->toArray();
        $pathDir = resource_path() . '/views/cache/news/';
        file_put_contents($pathDir.'popular_post.blade.php',
            '<?php 
if ( !ENV(\'IN_PHPBB\') )
{
    die(\'Hacking attempt\');
    exit;
}
global $popular_post;
$popular_post = ' . var_export($result, true) . ';
?>');

        return response(['Ok']);
    }
    public function newPost() {

        // tin mới nhất
        $result = $this->articleRepository->getModel()::select(DB::raw('csn_articles.id, csn_articles.category_id, csn_articles.title, csn_articles.slug, csn_articles.date_publish, csn_articles.short_content, csn_articles.image, csn_articles.article_by_user_name, csn_articles.article_by_user_id'))
            ->where('csn_articles.status', 'PUBLISHED')
            ->whereDate('date_publish', '<=', date("Y-m-d h:i"))
            ->orderBy('csn_articles.date_publish', 'desc')
            ->limit(15)
            ->get()
            ->toArray();
        $pathDir = resource_path() . '/views/cache/news/';
        file_put_contents($pathDir.'news_post.blade.php',
            '<?php 
if ( !ENV(\'IN_PHPBB\') )
{
    die(\'Hacking attempt\');
    exit;
}
global $news_post;
$news_post = ' . var_export($result, true) . ';
?>');
        return response(['Ok']);
    }
    public function syncArticlePOSE() {
        $client = new \GuzzleHttp\Client();
        $arrCat = [77320, 77318];
        foreach ($arrCat as $cat_id) {
            $url = 'https://api.pose.com.vn/wp-json/wp/v2/posts/?categories='.$cat_id.'&_embed&page=1&per_page=3&offset=1&_embed';
            $option = [
                'headers' => [
                    'accept' => 'application/json',
                ],
                'form_params'=> [
                ]
            ];
            // Âm nhạc: 12
            // Âu mỹ: 77320
            // Châu Á: 77319
            // Nhạc Việt: 77318
            $category_id = $cat_id == 77320 ? 4 : ($cat_id == 77318 ? 2 : ($cat_id == 77318 ? 2 : 77320));
            $response = $client->request('GET', $url, $option);
            $result = json_decode($response->getBody());
            $wp_featuredmedia = 'wp:featuredmedia';
            $wp_term = 'wp:term';
            foreach ($result as $item) {
                if(!$this->articleRepository->getModel()::where('slug', $item->slug)->first()) {
                    $tag_name = [];
                    $tag_slug = [];
                    $tag_id = [];
                    if(isset($item->_embedded->$wp_term[1])) {
                        foreach($item->_embedded->$wp_term[1] as $item_tag) {
                            $tag_name[] = $item_tag->name;
                            $tag_slug[] = $item_tag->slug;
                            $tag = $this->tagRepository->getModel()::where('slug', $item_tag->slug)->first();
                            if(!$tag) {
                                $tag = $this->tagRepository->getModel()::create([
                                    'name' => $item_tag->name,
                                    'slug' => $item_tag->slug
                                ]);
                            }
                            $tag_id[] = $tag->id;
                        }
                    }
                    $article = $this->articleRepository->getModel()::create([
                        'category_id' => $category_id,
                        'title' => $item->title->rendered,
                        'slug' => $item->slug,
                        'date_publish' => str_replace('T', ' ', $item->date),
                        'short_content' => strip_tags($item->excerpt->rendered),
                        'content' => $item->content->rendered,
                        'image' => $item->_embedded->$wp_featuredmedia[0]->media_details->sizes->medium->source_url,
                        'status' => 'PUBLISHED',
                        'featured' => 0,
                        'views' => 0,
                        'article_by_user_name' => 'Tony Trần',
                        'article_by_user_id' => 997917,
                        'tags_name' => implode(';', $tag_name),
                        'tags_id' => implode(';', $tag_id),
                        'tags_slug' => implode(';', $tag_slug),
                    ]);
                    if($tag_name) {
                        foreach ($tag_id as $item_tag_id) {
                            $this->tagArticleRepository->getModel()::create([
                                'article_id' => $article->id,
                                'tag_id' => $item_tag_id,
                            ]);
                        }
                    }
                }
            }
        }
        return response(['Ok']);
    }
    public function syncArticleSHELIKES() {
        $client = new \GuzzleHttp\Client();
        $arrCat = [74, 58];
        foreach ($arrCat as $cat_id) {
            $url = 'http://shelikes.asia/wp-json/wp/v2/posts/?categories='.$cat_id.'&_embed&_embed&page=1&per_page=3&offset=1&_embed';
            $option = [
                'headers' => [
                    'accept' => 'application/json',
                ],
                'form_params'=> [
                ]
            ];
            // Âm nhạc: 12
            // Âu mỹ: 74
            // Châu Á: 59
            // Nhạc Việt: 58
            $category_id = $cat_id == 74 ? 4 : ($cat_id == 58 ? 2 : ($cat_id == 58 ? 2 : 74));
            $response = $client->request('GET', $url, $option);
            $result = json_decode($response->getBody());
            $wp_featuredmedia = 'wp:featuredmedia';
            $wp_term = 'wp:term';
            foreach ($result as $item) {
                if(!$this->articleRepository->getModel()::where('slug', $item->slug)->first()) {
                    $tag_name = [];
                    $tag_slug = [];
                    $tag_id = [];
                    if(isset($item->_embedded->$wp_term[1])) {
                        foreach($item->_embedded->$wp_term[1] as $item_tag) {
                            $tag_name[] = $item_tag->name;
                            $tag_slug[] = $item_tag->slug;
                            $tag = $this->tagRepository->getModel()::where('slug', $item_tag->slug)->first();
                            if(!$tag) {
                                $tag = $this->tagRepository->getModel()::create([
                                    'name' => $item_tag->name,
                                    'slug' => $item_tag->slug
                                ]);
                            }
                            $tag_id[] = $tag->id;
                        }
                    }
                    $article = $this->articleRepository->getModel()::create([
                        'category_id' => $category_id,
                        'title' => $item->title->rendered,
                        'slug' => $item->slug,
                        'date_publish' => str_replace('T', ' ', $item->date),
                        'short_content' => strip_tags($item->excerpt->rendered),
                        'content' => $item->content->rendered,
                        'image' => $item->_embedded->$wp_featuredmedia[0]->media_details->sizes->medium->source_url,
                        'status' => 'PUBLISHED',
                        'featured' => 0,
                        'views' => 0,
                        'article_by_user_name' => 'Tony Trần',
                        'article_by_user_id' => 997917,
                        'tags_name' => implode(';', $tag_name),
                        'tags_id' => implode(';', $tag_id),
                        'tags_slug' => implode(';', $tag_slug),
                    ]);
                    if($tag_name) {
                        foreach ($tag_id as $item_tag_id) {
                            $this->tagArticleRepository->getModel()::create([
                                'article_id' => $article->id,
                                'tag_id' => $item_tag_id,
                            ]);
                        }
                    }
                }
            }
        }
        return response(['Ok']);
    }
}