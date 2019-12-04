<?php
namespace App\Repositories\Cover;

use App\Repositories\EloquentRepository;
use DB;
use App\Solr\Solarium;

class CoverEloquentRepository extends EloquentRepository implements CoverRepositoryInterface
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
        return \App\Models\CoverModel::class;
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

    /**
     * Create
     * @return mixed
     */
    public function getCoverNew($orderBy = 'album_last_updated')
    {
        $result = $this->_model::select('csn_cover.cover_id', 'csn_cover.music_album', 'csn_cover.album_artist_id_1', 'csn_cover.album_artist_1', 'csn_cover.album_artist_id_2', 'csn_cover.album_artist_2', 'csn_cover.music_year')
            ->where('csn_cover.music_year', CURRENT_YEAR)
            ->where('csn_cover.album_music_total', '>', 0)
            ->join('csn_music', 'csn_music.cover_id', 'csn_cover.cover_id')
//            ->with('music')
            ->groupBy('csn_cover.cover_id', 'csn_cover.music_album', 'csn_cover.album_artist_id_1', 'csn_cover.album_artist_1', 'csn_cover.album_artist_id_2', 'csn_cover.album_artist_2', 'csn_cover.music_year')
            ->orderBy($orderBy, 'desc')->limit(20)->get();
        return $result;
    }
    public function findCover($id, $userId = null)
    {
        $result = $this
            ->_model
            ->where('cover_id', $id);
        if($userId){
            $result = $result->where('user_id', $userId);
        }
        return $result->first();
;
    }
    public function getCoverNew2()
    {
        $result = $this->_model::select('csn_cover.cover_id', 'csn_cover.music_album', 'csn_cover.album_artist_id_1', 'csn_cover.album_artist_1', 'csn_cover.album_artist_id_2', 'csn_cover.album_artist_2', 'csn_cover.music_year')
            ->where('csn_cover.music_year', '<', CURRENT_YEAR)
            ->where('csn_cover.album_music_total', '>', 0)
            ->join('csn_music', 'csn_music.cover_id', 'csn_cover.cover_id')
//            ->with('music')
            ->groupBy('csn_cover.cover_id', 'csn_cover.music_album', 'csn_cover.album_artist_id_1', 'csn_cover.album_artist_1', 'csn_cover.album_artist_id_2', 'csn_cover.album_artist_2', 'csn_cover.music_year')
            ->orderBy('csn_cover.cover_id', 'desc')->limit(20)->get();
        return $result;
    }
    public function getCoverHot()
    {
        $result = $this->_model::where('music_year', CURRENT_YEAR)->with('music')->orderBy('cover_id', 'desc')->limit(20)->get();
        return $result;
    }
    public function getCoverMusicById($id) {
//        $result = $this->_model::where('cover_id', $id)->with('music', 'video')->first();
        $result = $this->_model::where('cover_id', $id)->first();
        return $result;
    }
    public function getCategoryCover($catId, $catLevel, $year = null, $bitrate = null, $fillOrder, $typeOrder, $page)
    {
        $arrWhereCat[] = ['csn_cover.album_cat_id_1', $catId];
        $arrWhereCat2[] = ['csn_cover.album_cat_id_2', $catId];
        if($catLevel != 0) {
            $arrWhereCat[] = ['csn_cover.album_cat_level_1', $catLevel];
            $arrWhereCat2[] = ['csn_cover.album_cat_level_2', $catLevel];
        }
        $arrWhere[] = ['csn_cover.cover_id',  '>', 0];
        if($year) {
            $arrWhere[] = $year;
        }
        if($bitrate) {
            $arrWhere[] = ['csn_cover.music_bitrate', $bitrate];
        }
        $result = $this->_model::select('csn_cover.cover_id', 'csn_cover.music_album', 'csn_cover.album_artist_id_1', 'csn_cover.album_artist_1', 'csn_cover.album_artist_id_2', 'csn_cover.album_artist_2', 'csn_cover.music_year', 'csn_cover.music_bitrate')
            ->where(function($q) use ($arrWhereCat, $arrWhereCat2) {
                $q->where($arrWhereCat)
                    ->orWhere($arrWhereCat2);
            })
            ->where($arrWhere)
            ->where('csn_cover.album_music_total', '>', 0)
            ->join('csn_music', 'csn_music.cover_id', 'csn_cover.cover_id')
            ->groupBy('csn_cover.cover_id', 'csn_cover.music_album', 'csn_cover.album_artist_id_1', 'csn_cover.album_artist_1', 'csn_cover.album_artist_id_2', 'csn_cover.album_artist_2', 'csn_cover.music_year', 'csn_cover.music_bitrate')
            ->orderBy($fillOrder, $typeOrder)
            ->paginate($page);
        return $result;
    }
    public function getCategoryCoverSolr($catId, $catLevel, $year = null, $bitrate = null, $fillOrder, $typeOrder, $perPage) {
        if($catLevel == 0) {
            $searchSolarium['album_cat'] = $catId.'_*';
        }else{
            $searchSolarium['album_cat'] = $catId.'_'.$catLevel;
        }
        if($year) {
            $searchSolarium['album_cat'] = $searchSolarium['album_cat'].' AND album_music_year:'.$year[1];
        }
        if($bitrate) {
            $searchSolarium['album_cat'] = $searchSolarium['album_cat'].' AND album_bitrate:'.$bitrate;
        }
        return $this->Solr->search($searchSolarium, $_GET['page'] ?? 1, $perPage, array('score' => 'desc', $fillOrder => $typeOrder));
    }
    public function findAlbumByArtist($artist, $fillOrder, $typeOrder, $page)
    {
        $result = $this
            ->_model::where(function($q) use ($artist) {
                $q->where('album_artist_id_1', $artist)
                    ->orWhere('album_artist_id_2', $artist);
            })
            ->orderBy($fillOrder, $typeOrder)
            ->paginate($page);
        return $result;
    }
    public function findCoverByUser($userId, $fillOrder, $typeOrder, $page)
    {
        $result = $this->_model::where('user_id', $userId)
            ->orderBy($fillOrder, $typeOrder)
            ->paginate($page);
        return $result;
    }
    public function coverNews($fillOrder, $typeOrder, $page)
    {
        $result = $this
            ->_model
            ->orderBy($fillOrder, $typeOrder)
            ->paginate($page);
        return $result;
    }
    public function coverNewSolr($fillOrder, $typeOrder, $perPage) {
        $searchSolarium['id'] = 'cover_*';
        return $this->Solr->search($searchSolarium, $_GET['page'] ?? 1, $perPage, array('score' => 'desc', $fillOrder => $typeOrder));
    }
}

