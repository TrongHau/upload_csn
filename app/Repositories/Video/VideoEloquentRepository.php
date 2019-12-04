<?php
namespace App\Repositories\Video;

use App\Repositories\EloquentRepository;
use DB;
use App\Library\Helpers;
use App\Solr\Solarium;
use App\Models\DeleteVideoModel;

class VideoEloquentRepository extends EloquentRepository implements VideoRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    protected $Solr;

    public function __construct(Solarium $Solr) {
        parent::__construct();
        $this->Solr = $Solr;
    }

    public function getModel()
    {
        return \App\Models\VideoModel::class;
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
    public function getQueryPublished()
    {
        return $result = $this->_model
            ->where('music_deleted', '<', 1);

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
            ->where('music_deleted', '<', 1)
            ->first();

        return $result;
    }
    public function deleteSafe($video)
    {
        $result = $this
            ->_model
            ->find($video->music_id);
        if($result) {
            $result->delete();
            $videoDelete = DeleteVideoModel::find($video->music_id);
            if($videoDelete)
                $videoDelete->delete();
            DeleteVideoModel::create(array_merge($video->toArray(), ['music_delete_time' => time()]));
        }

        return $result;
    }
    public function findOnlyMusicUrl($url)
    {
        $result = $this
            ->_model
            ->where('music_title_url', $url)
            ->where('music_deleted', '<', 1)
            ->first();

        return $result;
    }
    public function findOnlyMusicId($id)
    {
        $result = $this
            ->_model
            ->where('music_id', $id)
            ->with('musicKara');
        $result->where('music_deleted', '<', 1);
        return $result->first();
    }
    public function findMusicIds($ids)
    {
        $result = $this
            ->_model
            ->whereIn('music_id', $ids)
            ->where('music_deleted', '<', 1)
            ->get();

        return $result;
    }
    public function incrementCol($id, $field)
    {
        $result = $this
            ->_model
            ->where('music_id', $id)
            ->where('music_deleted', '<', 1)
            ->Increment($field);
        return $result;
    }
    public function getCategoryVideo($catId, $catLevel, $year = null, $fillOrder, $typeOrder, $page)
    {
        $arrWhere[] = ['cat_id', $catId];
        if($catLevel != 0) {
            $arrWhere[] = ['cat_level', $catLevel];
        }
        if($year) {
            $arrWhere[] = $year;
        }
        $result = $this->_model::where($arrWhere)
            ->where('music_deleted', '<', 1)
            ->orderBy($fillOrder, $typeOrder)
            ->paginate($page);
        return $result;
    }
    public function getCategoryVideoSolr($catId, $catLevel, $year = null, $fillOrder, $typeOrder, $perPage)
    {
        if($catId) {
            $searchSolarium['video_cat_id'] = $catId;
        }else {
            $searchSolarium['id'] = 'video_*';
        }
        if($catLevel != 0)
            $searchSolarium['video_cat_level'] = $catLevel;
        $result = $this->Solr->search($searchSolarium, $_GET['page'] ?? 1, $perPage, array('score' => 'desc', $fillOrder => $typeOrder));
        return $result;
    }
    public function videoNews($fillOrder, $typeOrder, $page)
    {
        $result = $this
            ->_model
            ->select('music_id', 'cat_id', 'cat_level', 'cover_id', 'music_title_url', 'music_title', 'music_artist', 'music_artist_id', 'music_album_id', 'music_listen', 'music_bitrate', 'music_filename', 'music_length')
            ->where('music_deleted', '<', 1)
            ->orderBy($fillOrder, $typeOrder)
            ->paginate($page);
        return $result;
    }
    public function videoNewsSolr($fillOrder, $typeOrder, $perPage)
    {
        $searchSolarium['id'] = 'video_*';
        $result = $this->Solr->search($searchSolarium, $_GET['page'] ?? 1, $perPage, array('score' => 'desc', $fillOrder => $typeOrder));
        return $result;
    }
    public function findVideoByArtist($artist_id, $fillOrder, $typeOrder, $page)
    {
        $result = $this
            ->_model
            ->select('music_id', 'cat_id', 'cat_level', 'cover_id', 'music_title_url', 'music_title', 'music_artist', 'music_artist_id', 'music_album_id', 'music_listen', 'music_bitrate', 'music_filename', 'music_length', 'music_width', 'music_height')
            ->where('music_artist_id', 'like', $artist_id)
            ->orWhere('music_artist_id', 'like', $artist_id.';%')
            ->orWhere('music_artist_id', 'like', '%;'.$artist_id)
            ->orWhere('music_artist_id', 'like', '%;'.$artist_id.';%')
            ->where('music_deleted', '<', 1)
            ->orderBy($fillOrder, $typeOrder)
            ->paginate($page);
        return $result;
    }

}

