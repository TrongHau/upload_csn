<?php
namespace App\Repositories\UploadException;

interface UploadExceptionRepositoryInterface
{
    /**
     * Get all posts only published
     * @return mixed
     */
    public function getAllPublished();

    /**
     * Get post only published
     * @return mixed
     */
    public function findOnlyPublished($id);
}
