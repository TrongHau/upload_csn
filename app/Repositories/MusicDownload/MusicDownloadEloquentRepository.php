<?php
namespace App\Repositories\MusicDownload;

use App\Repositories\EloquentRepository;
use DB;
class MusicDownloadEloquentRepository extends EloquentRepository implements MusicDownloadRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    protected $_selectMusic = ['csn_music.music_downloads_today', 'csn_music.music_id', 'csn_music.music_title_url', 'csn_music.music_title', 'csn_music.music_artist', 'csn_music.music_artist_id', 'csn_music.cat_id', 'csn_music.cat_level', 'csn_music.cat_sublevel', 'csn_music.cat_custom', 'csn_music.cover_id', 'csn_music.music_download_time', 'csn_music.music_last_update_time', 'csn_music.music_title_url',
        'csn_music.music_title_search', 'csn_music.music_artist_search', 'csn_music.music_album_search', 'csn_music.music_composer', 'csn_music.music_album', 'csn_music.music_listen', 'csn_music.music_track_id', 'csn_music.music_track_id', 'csn_music.music_filename', 'csn_music.music_bitrate', 'csn_music.music_shortlyric', 'csn_music.music_last_update_time', 'csn_music.music_deleted'];

    public function getModel()
    {
        return \App\Models\MusicDownloadModel::class;
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
    public function bxhCategoryMusic($idCategory, $order, $year = '', $firstDate = '', $lastDate = '')
    {
        $result = $this->_model
            ->join('csn_music', 'csn_music_download.music_id', 'csn_music.music_id')
            ->where('csn_music.cat_id', $idCategory)
            ->where('csn_music.music_deleted', '<', 1)
            ->where('csn_music.cat_id', '!=', CAT_VIDEO)

            ->select($this->_selectMusic)
            ->whereNotIn('csn_music.music_title', function($query) {
                $query->select('music_title')
                    ->from('csn_music_copyright');
            })
            ->whereNotIn('csn_music.music_artist', function($query) {
                $query->select('artist_nickname')
                    ->from('csn_artist_exception');
            })
            ;
        if($year) {
            $result = $result->where('csn_music.music_year', $year);
        }else{
            // today
            $result = $result->where('csn_music.music_time', '>', time() - DEFAULT_TIME_QUERY_BXH * 86400) // 90 ngày trở lên
                                ->where(function ($query) {
                                    $query->where('csn_music.music_year', '>', intval(date('Y')) - 2)
                                        ->orWhere('csn_music.music_year', 0);
                                });
        }
        if($firstDate && $lastDate) {
            $result = $result->where('csn_music.music_time', '>=', $firstDate)
                            ->where('csn_music.music_time', '<=', $lastDate);
        }
        if($order) {
            foreach($order as $key => $type) {
                $result = $result->orderBy($key, $type);
            }
        }
        return $result->limit(20)->get();
    }
}

