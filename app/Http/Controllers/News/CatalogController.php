<?php

namespace App\Http\Controllers\News;

use Illuminate\Http\Request;
use App\Library\Helpers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Repositories\Article\ArticleRepository;

class CatalogController extends Controller
{
    protected $articleRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ArticleRepository $artistRepository)
    {
        $this->articleRepository = $artistRepository;
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function tag(Request $request, $tag) {
        $list = $this->articleRepository->getTags($tag)->paginate(PAGE_CATEGORY);
        if($request->tab == 'ajax_page')
            return view('news.category.category_item', compact('list'));
        $firstCategory = view('news.category.category_item', compact('list'));
        return view('news.catalog.tag', compact('firstCategory', 'tag'));
    }
}
