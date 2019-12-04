<?php
namespace App\Repositories\Session;

use App\Repositories\EloquentRepository;
use DB;
class SessionEloquentRepository extends EloquentRepository implements SessionRepositoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Session::class;
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

    public function getSessionById($id) {
        $result = $this->_model::where([['id', $id]])->first();
        return $result;
    }

}

