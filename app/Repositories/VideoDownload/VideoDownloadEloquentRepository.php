<?php
namespace App\Repositories\VideoDownload;

use App\Repositories\EloquentRepository;
use DB;
class VideoDownloadEloquentRepository extends EloquentRepository implements VideoDownloadRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    protected $_selectVideo = ['csn_video.music_downloads_today', 'csn_video.music_id', 'csn_video.music_title_url', 'csn_video.music_title', 'csn_video.music_artist', 'csn_video.music_artist_id', 'csn_video.cat_id', 'csn_video.cat_level', 'csn_video.cat_sublevel', 'csn_video.cat_custom', 'csn_video.cover_id', 'csn_video.music_download_time', 'csn_video.music_last_update_time', 'csn_video.music_title_url', 'csn_video.music_deleted',
        'csn_video.music_title_search', 'csn_video.music_artist_search', 'csn_video.music_album_search', 'csn_video.music_composer', 'csn_video.music_album', 'csn_video.music_listen', 'csn_video.music_track_id', 'csn_video.music_track_id', 'csn_video.music_filename', 'csn_video.music_bitrate', 'csn_video.music_shortlyric', 'csn_video.music_last_update_time', 'csn_video.music_length', 'csn_video.music_width', 'csn_video.music_height', 'music_downloads_this_week'];

    public function getModel()
    {
        return \App\Models\VideoDownloadModel::class;
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

    public function incrementDownload($id)
    {
        $result = $this
            ->_model->where('music_id', $id)
            ->first();
        if(!$result){
            $this
                ->_model
                ->create([
                    'music_id' => $id,
                    'music_downloads' => 1,
                    'music_downloads_today_0' => 1,
                    'music_downloads_time' => time(),
                ]);
        }else{
            $result->update([
                'music_downloads' => DB::raw('music_downloads + 1'),
                'music_downloads_today_0' => DB::raw('music_downloads_today_0 + 1'),
                'music_downloads_time' => time(),
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
    public function bxhHotTodayCategoryVideo($idCategory)
    {
        $result = $this->_model->join('csn_video', 'csn_video_download.music_id', 'csn_video.music_id')
            ->where('csn_video.cat_id', $idCategory)
            ->where('csn_video.cat_id', '!=', CAT_VIDEO)
            ->where('csn_video.music_time', '>', time() - DEFAULT_TIME_QUERY_BXH * 86400) // 90 ngày trở lên
            ->where(function ($query) {
                $query->where('music_year', '>', intval(date('Y')) - 2)
                    ->orWhere('music_year', 0);
            })
            ->orderBy('csn_video_download.music_downloads_this_week', 'desc')
            ->select($this->_selectMusic)
            ->whereNotIn('csn_video.music_id', function($query) {
                $query->select('music_id')
                    ->from('csn_music_exception');
            })
            ->whereNotIn('csn_video.music_artist_id', function($query) {
                $query->select('artist_id')
                    ->from('csn_artist_exception');
            })
            ->limit(20)
            ->get();
        return $result;
    }
}

