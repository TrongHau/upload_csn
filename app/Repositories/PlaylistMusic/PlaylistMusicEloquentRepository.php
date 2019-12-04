<?php
namespace App\Repositories\PlaylistMusic;

use App\Repositories\EloquentRepository;
use DB;
class PlaylistMusicEloquentRepository extends EloquentRepository implements PlaylistMusicRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\PlaylistMusicModel::class;
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
            ->where('id', $id)
            ->where('is_published', 1)
            ->first();

        return $result;
    }

    public function getList()
    {
        $result = $this->_model::where('cat_level', '!=', 0)->orderBy('cat_order', 'asc')->get();
        return $result;
    }
    public function getMusicId($musicId)
    {
        $result = $this->_model::where('music_id', $musicId)->get();
        return $result;
    }
    public function getPlaylistId($playlistId)
    {
        $result = $this->_model::where('playlist_id', $playlistId)->get();
        return $result;
    }
    public function deletePlaylistByMusicId($musicId)
    {
        $result = $this->_model::where('music_id', $musicId)->delete();
        return $result;
    }
    public function getCategory()
    {
        $result = $this->_model::where('cat_level', 0)->orderBy('cat_order', 'asc')->get();
        return $result;
    }

}

