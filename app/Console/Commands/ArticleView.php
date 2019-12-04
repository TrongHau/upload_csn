<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Sync\ArticleViewController;
use App\Repositories\Article\ArticleRepository;
use App\Repositories\ArticleTags\ArticleTagsRepository;
use App\Repositories\Tag\TagRepository;
use App\Repositories\ArticleView\ArticleViewRepository;
use App\Repositories\CategoryNews\CategoryNewsEloquentRepository;

class ArticleView extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'article_view:type {type?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync article view';

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
        $articleView = new ArticleViewController($this->articleRepository, $this->articleViewRepository, $this->categoryNewsRepository, $this->tagArticleRepository, $this->tagRepository);
        if($this->argument('type') == 'real') {
            $articleView->realArticleView();
        }elseif($this->argument('type') == 'today') {
            $articleView->syncArticleView();
        }
    }
}
