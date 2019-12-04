<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Sync\ArticleCategoryController;
use App\Repositories\Article\ArticleRepository;
use App\Repositories\ArticleTags\ArticleTagsRepository;
use App\Repositories\Tag\TagRepository;
use App\Repositories\ArticleView\ArticleViewRepository;
use App\Repositories\CategoryNews\CategoryNewsEloquentRepository;

class ArticleSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync_news:type {type?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync News';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $articleRepository;
    protected $articleViewRepository;
    protected $categoryNewsRepository;
    protected $tagArticleRepository;
    protected $tagRepository;

    public function __construct(ArticleRepository $articleRepository, ArticleViewRepository $articleViewRepository, CategoryNewsEloquentRepository $categoryNewsRepository, ArticleTagsRepository $tagArticleRepository, TagRepository $tagRepository)
    {
        $this->articleRepository = $articleRepository;
        $this->articleViewRepository = $articleViewRepository;
        $this->categoryNewsRepository = $categoryNewsRepository;
        $this->tagArticleRepository = $tagArticleRepository;
        $this->tagRepository = $tagRepository;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $News = new ArticleCategoryController($this->articleRepository, $this->articleViewRepository, $this->categoryNewsRepository, $this->tagArticleRepository, $this->tagRepository);
        if($this->argument('type') == 'cat_popular_new') {
            $News->popularNewsCategory();
        }elseif($this->argument('type') == 'popular_news') {
            $News->popularPost();
        }elseif($this->argument('type') == 'new_news') {
            $News->newPost();
        }elseif($this->argument('type') == 'new') {
            $News->syncArticlePOSE();
            $News->syncArticleSHELIKES();
        }
    }
}
