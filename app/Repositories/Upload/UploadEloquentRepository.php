<?php
namespace App\Repositories\Upload;

use App\Repositories\EloquentRepository;
use DB;
class UploadEloquentRepository extends EloquentRepository implements UploadRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\UploadModel::class;
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

    /**
     * Get post only published
     * @param $id int Post ID
     * @return mixed
     */
    public function findOnlyPublished($id)
    {
        $result = $this
            ->_model
            ->where('music_id', $id)
            ->first();

        return $result;
    }
    public function findMusicStatus($userId, $id, $stageArr = [])
    {
        $result = $this
            ->_model
            ->where('music_id', $id);
        if($userId != 'permission_duyet_csn') {
            $result = $result->where('music_user_id', $userId);
        }
        if($stageArr) {
            $result = $result->whereIn('music_state', $stageArr);
        }
        return $result->first();
    }
    /**
     * Create
     * @return mixed
     */
    public function create(array $attributes)
    {
        $attributes['music_time'] = time();
        $result = $this->_model::firstOrCreate($attributes);
        return $result;
    }
    public function musicByUser($userId, $stageArr, $fillOrder, $typeOrder, $page)
    {
        $result = $this->_model::select('music_id', 'cat_id', 'cat_level', 'cover_id', 'music_title', 'music_artist', 'music_artist_id', 'music_album_id', 'music_bitrate', 'music_filename', 'music_updated', 'music_last_update_time', 'music_note')
            ->where('music_user_id', $userId)
            ->whereIn('music_state', $stageArr)
            ->orderBy($fillOrder, $typeOrder)
            ->paginate($page);
        return $result;
    }
    public function musicByStage($stageArr, $fillOrder, $typeOrder, $page, $user = null)
    {
        $result = $this->_model::select('music_id', 'cat_id', 'cat_level', 'cover_id', 'music_title', 'music_artist', 'music_artist_id', 'music_album_id', 'music_bitrate', 'music_filename', 'music_updated', 'music_last_update_time', 'music_note')
            ->whereIn('music_state', $stageArr);
        if($user) {
            $result = $result->where('music_last_update_by', $user);
        }
        $result = $result->orderBy($fillOrder, $typeOrder)
            ->paginate($page);
        return $result;
    }
}

