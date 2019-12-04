<?php
namespace App\Repositories\MusicListen;

use App\Repositories\EloquentRepository;
use DB;
class MusicListenEloquentRepository extends EloquentRepository implements MusicListenRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    protected $_selectMusic = ['csn_music.music_downloads_today', 'csn_music.music_id', 'csn_music.music_title_url', 'csn_music.music_title', 'csn_music.music_artist', 'csn_music.music_artist_id', 'csn_music.cat_id', 'csn_music.cat_level', 'csn_music.cat_sublevel', 'csn_music.cat_custom', 'csn_music.cover_id', 'csn_music.music_download_time', 'csn_music.music_last_update_time', 'csn_music.music_title_url',
        'csn_music.music_title_search', 'csn_music.music_artist_search', 'csn_music.music_album_search', 'csn_music.music_composer', 'csn_music.music_album', 'csn_music.music_listen', 'csn_music.music_track_id', 'csn_music.music_track_id', 'csn_music.music_filename', 'csn_music.music_bitrate', 'csn_music.music_shortlyric', 'csn_music.music_last_update_time', 'csn_music.music_deleted'];
    protected $_selectVideo = ['csn_video.music_downloads_today', 'csn_video.music_id', 'csn_video.music_title_url', 'csn_video.music_title', 'csn_video.music_artist', 'csn_video.music_artist_id', 'csn_video.cat_id', 'csn_video.cat_level', 'csn_video.cat_sublevel', 'csn_video.cat_custom', 'csn_video.cover_id', 'csn_video.music_download_time', 'csn_video.music_last_update_time', 'csn_video.music_title_url', 'csn_video.music_deleted',
        'csn_video.music_title_search', 'csn_video.music_artist_search', 'csn_video.music_album_search', 'csn_video.music_composer', 'csn_video.music_album', 'csn_video.music_listen', 'csn_video.music_track_id', 'csn_video.music_track_id', 'csn_video.music_filename', 'csn_video.music_bitrate', 'csn_video.music_shortlyric', 'csn_video.music_last_update_time', 'csn_video.music_length', 'csn_video.music_width', 'csn_video.music_height', 'music_downloads_this_week'];
    public function getModel()
    {
        return \App\Models\MusicListenModel::class;
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

    public function incrementListen($id)
    {
        $result = $this
            ->_model->where('music_id', $id)
            ->first();
        if(!$result){
            $this
                ->_model
                ->create([
                'music_id' => $id,
                'music_listen' => 1,
                'music_listen_today_0' => 1,
                'music_listen_time' => time(),
            ]);
        }else{
            $result->update([
                    'music_listen' => DB::raw('music_listen + 1'),
                    'music_listen_today_0' => DB::raw('music_listen_today_0 + 1'),
                    'music_listen_time' => time(),
                ]);
        }
        return $result;
    }

    /**
     * Create
     * @return mixed
     */

    /**
     * Get post only published
     * @return mixed
     */
    public function findOnlyPublished($id)
    {
        // TODO: Implement findOnlyPublished() method.
    }
    public function bxhHotTodayCategoryMusic($idCategory)
    {
//        $result = $this->_model->join('csn_music', 'csn_music_listen.music_id', 'csn_music.music_id')
        $result = \App\Models\MusicModel::where('csn_music.cat_id', $idCategory)
            ->where('cat_id', '!=', CAT_VIDEO)
            ->where('music_time', '>', time() - DEFAULT_TIME_QUERY_BXH * 86400) // 90 ngày trở lên
            ->where(function ($query) {
                $query->where('music_year', '>', intval(date('Y')) - 2)
                    ->orWhere('music_year', 0);
            })
            ->orderBy('csn_music.music_downloads_today', 'desc')
            ->orderBy('csn_music.music_downloads_this_week', 'desc')
            ->select($this->_selectMusic)
            ->whereNotIn('music_id', function($query) {
                $query->select('music_id')
                    ->from('csn_music_exception');
            })
            ->whereNotIn('music_artist_id', function($query) {
                $query->select('artist_id')
                    ->from('csn_artist_exception');
            })
            ->limit(20)
            ->get();
        return $result;
    }
    public function bxhHotTodayCategoryVideo($idCategory)
    {
        $result = \App\Models\VideoModel::where('csn_video.cat_id', CATEGORY_ID_VIDEO)
            ->where('csn_video.cat_level', $idCategory)
            ->where('music_time', '>', time() - DEFAULT_TIME_QUERY_BXH * 86400) // 90 ngày trở lên
            ->where(function ($query) {
                $query->where('music_year', '>', intval(date('Y')) - 2)
                    ->orWhere('music_year', 0);
            })
            ->orderBy('csn_video.music_downloads_today', 'desc')
            ->orderBy('csn_video.music_downloads_this_week', 'desc')
            ->orderBy('csn_video.music_listen', 'desc')
            ->select($this->_selectVideo)
            ->whereNotIn('music_id', function($query) {
                $query->select('music_id')
                    ->from('csn_video_exception');
            })
            ->whereNotIn('music_artist_id', function($query) {
                $query->select('artist_id')
                    ->from('csn_artist_exception');
            })
            ->limit(20)
            ->get();
        return $result;
    }
    public function bxhWeekCategoryMusic($idCategory)
    {
        $result = \App\Models\MusicModel::where('csn_music.cat_id', $idCategory)
            ->where('cat_id', '!=', CAT_VIDEO)
            ->orderBy('csn_music.music_downloads_this_week', 'desc')
            ->orderBy('csn_music.music_downloads_max_week', 'desc')
            ->select($this->_selectMusic)
            ->limit(20)
            ->get();
        return $result;
    }
    public function bxhWeekCategoryVideo($idCategory)
    {
        $result = \App\Models\VideoModel::where('csn_video.cat_id', CATEGORY_ID_VIDEO)
            ->where('csn_video.cat_level', $idCategory)
            ->orderBy('csn_video.music_downloads_this_week', 'desc')
            ->orderBy('csn_video.music_downloads_max_week', 'desc')
            ->select($this->_selectVideo)
            ->limit(20)
            ->get();
        return $result;
    }
    public function bxhYearCategoryMusic($idCategory, $year)
    {
        $result = \App\Models\MusicModel::where('csn_music.cat_id', $idCategory)
            ->where('cat_id', '!=', CAT_VIDEO)
            ->where('csn_music.music_year', $year)
            ->orderBy('csn_music.music_downloads_this_week', 'desc')
            ->select($this->_selectMusic)
            ->limit(20)
            ->get();
        return $result;
    }
    public function bxhYearCategoryVideo($idCategory, $year)
    {
        $result = \App\Models\VideoModel::where('csn_video.cat_id', CATEGORY_ID_VIDEO)
            ->where('csn_video.cat_level', $idCategory)
            ->where('csn_video.music_year', $year)
            ->orderBy('csn_video.music_downloads_this_week', 'desc')
            ->select($this->_selectVideo)
            ->limit(20)
            ->get();
        return $result;
    }

    public function bxhMonthCategoryMusic($idCategory, $firstDate, $lastDate, $year)
    {
        $result = \App\Models\MusicModel::where('csn_music.cat_id', $idCategory)
            ->where('cat_id', '!=', CAT_VIDEO)
            ->where('csn_music.music_year', $year)
            ->where('csn_music.music_time', '>=', $firstDate)
            ->where('csn_music.music_time', '<=', $lastDate)
            ->orderBy('csn_music.music_downloads_this_week', 'desc')
            ->select($this->_selectMusic)
            ->limit(20)
            ->get();
        return $result;
    }
    public function bxhMonthCategoryVideo($idCategory, $firstDate, $lastDate, $year)
    {
        $result = \App\Models\VideoModel::where('csn_video.cat_id', CATEGORY_ID_VIDEO)
            ->where('csn_video.cat_level', $idCategory)
            ->where('csn_video.music_year', $year)
            ->where('csn_video.music_time', '>=',$firstDate)
            ->where('csn_video.music_time', '<=', $lastDate)
            ->orderBy('csn_video.music_downloads_this_week', 'desc')
            ->select($this->_selectVideo)
            ->limit(20)
            ->get();
        return $result;
    }
}

