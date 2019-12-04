<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class ArticleViewModel extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'article_id';
    protected $table = 'csn_article_view';
    protected $fillable = ['article_id', 'article_view', 'article_view_fake', 'article_view_time', 'article_listen_ago', 'article_listen_today_0', 'article_listen_today_1', 'article_listen_today_2', 'article_listen_today_3', 'article_listen_today_4', 'article_listen_today_5', 'article_listen_today_6', 'article_listen_today_7', 'article_listen_this_week', 'article_listen_max_week'];

    public function hasOneArticle() {
        return $this->hasOne('Backpack\NewsCRUD\app\Models\Article', 'article_id');
    }
}
