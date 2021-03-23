<?php

namespace App\Repositories;

use App\Blog;

/**
 * Class BlogRepository
 * 
 * @package App\Repositories
 */
class BlogRepository
{
    /**
     * @var Blog
     */
    protected $model;

    /**
     * BlogRepository constructor.
     * 
     * @param Blog $blog
     */
    public function __construct(Blog $blog)
    {
        $this->model = $blog;
    }

    /**
     * Get all blogs with comments
     * 
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getAll()
    {
        return $this->model->all();
    }
}
