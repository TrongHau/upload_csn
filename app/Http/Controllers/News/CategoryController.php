<?php

namespace App\Http\Controllers\News;

use Illuminate\Http\Request;
use App\Library\Helpers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Repositories\Article\ArticleRepository;

class CategoryController extends Controller
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
    public function index()
    {
        return view('news.category.index');
    }
    public function categorySao_viet(Request $request) {
        return $this->category($request, 2);
    }
    public function categorySao_han(Request $request) {
        return $this->category($request, 3);
    }
    public function categorySao_au_my(Request $request) {
        return $this->category($request, 4);
    }
    public function category($request, $idCategory) {
        $list = $this->articleRepository->getCategory($idCategory)->paginate(PAGE_CATEGORY);
        if($request->tab == 'ajax_page')
            return view('news.category.category_item', compact('list'));
        $firstCategory = view('news.category.category_item', compact('list'));
        return view('news.category.index', compact('firstCategory', 'idCategory'));
    }
    public function NewsPost(Request $request) {
        return view('news.category.news_post');
    }
    public function Popular(Request $request) {
        return view('news.category.popular_post');
    }
}
