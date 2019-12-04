<?php
namespace App\Repositories\PlaylistPublisher;

use App\Repositories\EloquentRepository;
use DB;
class PlaylistPublisherEloquentRepository extends EloquentRepository implements PlaylistPublisherRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\PlaylistPublisherModel::class;
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

    public function getMusicByUserId($id)
    {
        $result = $this->_model::where('user_id', $id)->orderBy('playlist_title', 'desc')->with('playlist_music')->get();
        return $result;
    }
    public function getMusicByPlaylistId($id)
    {
        $result = $this->_model::where('playlist_id', $id)->orderBy('playlist_title', 'desc')->with('music', 'video')->first();
        return $result;
    }
    public function getByUser($userId, $idPlaylist = null)
    {
        $result = $this->_model::where('user_id', $userId);
        if($idPlaylist) {
            $result = $result->where('playlist_id', $idPlaylist);
        }
        return $result->orderBy('playlist_id', 'desc');
    }
    public function getMusicVideo($playlisMusicVideoIds) {
        if($playlisMusicVideoIds){
            $q1 = \App\Models\MusicModel::WhereIn('music_id', $playlisMusicVideoIds)->select('music_id', 'cat_id', 'cat_level', 'cover_id', 'music_title_url', 'music_title', 'music_artist', 'music_artist_id', 'music_album_id', 'music_listen', 'music_bitrate', 'music_filename');
            $q2 = \App\Models\VideoModel::WhereIn('music_id', $playlisMusicVideoIds)->select('music_id', 'cat_id', 'cat_level', 'cover_id', 'music_title_url', 'music_title', 'music_artist', 'music_artist_id', 'music_album_id', 'music_listen', 'music_bitrate', 'music_filename');
            return $q2->union($q1)->orderBy(\DB::raw("FIELD(music_id, ".implode(',', $playlisMusicVideoIds).")"))->get();
        }
        return [];

    }
    public function updatePlaylist($where, array $attributes)
    {
        $result = $this->_model::where($where)
            ->update($attributes);
        return $result;
    }
    public function create(array $attributes)
    {
        return $this->_model->create($attributes);
    }
    public function getPlaylistPageByArtist($artistId, $fillOrder, $typeOrder, $page)
    {
        $result = $this->_model::where('playlist_artist_id', $artistId)
            ->orderBy($fillOrder, $typeOrder)
            ->paginate($page);
        return $result;
    }

}

