<?php
namespace App\Repositories\Comment;

use App\Repositories\EloquentRepository;
use DB;
class CommentEloquentRepository extends EloquentRepository implements CommentRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\CommentModel::class;
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
    public function create(array $attributes)
    {
        $attributes['comment_time'] = strtotime(date('Y/m/d H:i:s'));
        $attributes['comment_reply'] = 0;
        $result = $this->_model::firstOrCreate($attributes);
        return $result;
    }
    public function findByMusicId($musicId, $fillOrder, $typeOrder, $page)
    {
        $result = $this->_model::where('music_id', $musicId)->orderBy($fillOrder, $typeOrder)->with('user')->paginate($page);
        return $result;
    }

}

