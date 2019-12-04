<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8/21/2018
 * Time: 4:29 PM
 */
namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class MusicSearchResultReportModel extends Model
{
    use CrudTrait;
    protected $table = 'csn_music_search_result_report';
    protected $primaryKey = 'id';
    protected $fillable =
        [
            'music_id', 'music_title', 'music_artist', 'music_artist_id', 'music_album', 'music_year', 'music_search_count', 'cat_id'
        ];

    public function getTotalSum()
    {
        return self::where([
            ['music_id', $this->music_id],
//            ['created_at', '>=', date('Y-m-d', time())],
        ])->selectRaw('sum(music_search_count) as music_search_count')
            ->groupBy(['music_id'])
            ->value('music_search_count') ?: 0;
    }
}
