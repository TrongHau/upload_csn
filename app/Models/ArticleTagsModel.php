<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class ArticleTagsModel extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'csn_article_tag';
    protected $fillable = ['id', 'article_id', 'tag_id'];

}
