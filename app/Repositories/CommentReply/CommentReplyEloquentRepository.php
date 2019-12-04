<?php
namespace App\Repositories\CommentReply;

use App\Repositories\EloquentRepository;
use DB;
class CommentReplyEloquentRepository extends EloquentRepository implements CommentReplyRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\CommentReplyModel::class;
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
        $result = $this->_model::firstOrCreate($attributes);
        return $result;
    }

    public function getCommentByCommentId(array $arrId, $fillOrder, $typeOrder)
    {
        $result = $this->_model::whereIn('comment_id', $arrId)->orderBy($fillOrder, $typeOrder)->with('user')->get();
        return $result;
    }

}

