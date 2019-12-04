<?php
namespace App\Repositories\User;

use App\Repositories\EloquentRepository;
use DB;
class UserEloquentRepository extends EloquentRepository implements UserRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\UserModel::class;
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

    public function findOnlyPublished($id)
    {
        $result = $this->_model::where([['id', $id], ['user_active', ACTIVE_USER]]);
        return $result;
    }

    public function getUserById($id) {
        $result = $this->_model::where([['id', $id]]);
        return $result;
    }
    public function incrementCol($id, $field)
    {
        $result = $this
            ->_model
            ->where('id', $id)
            ->Increment($field);
        return $result;
    }
    public function decrementCol($id, $field)
    {
        $result = $this
            ->_model
            ->where('id', $id)
            ->decrement($field);
        return $result;
    }
}

