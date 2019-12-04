<?php
namespace App\Repositories\Artist;

use App\Repositories\EloquentRepository;
use DB;
class ArtistRepository extends EloquentRepository implements ArtistRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\ArtistModel::class;
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
            ->where('artist_id', $id)
            ->first();

        return $result;
    }

    public function createArtist($attributes)
    {
        $result = $this->_model::firstOrCreate([
            'artist_nickname' => $attributes->artist_nickname,
            'artist_realname' => $attributes->artist_realname ?? '',
            'artist_url' => $attributes->artist_url,
            'artist_birthday' => $attributes->artist_birthday,
            'artist_gender' => $attributes->artist_gender,
            'artist_country' => $attributes->artist_country,
            'artist_avatar' => $attributes->artist_avatar,
            'artist_cover' => $attributes->artist_cover,
            'artist_desc' => $attributes->artist_desc,
            'artist_id_source' => $attributes->artist_id
        ]);
        return $result;
    }

    /**
     * Create
     * @return mixed
     */

}

