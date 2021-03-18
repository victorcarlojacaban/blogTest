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
     * @var CommentLike
     */
    protected $model;

    /**
     * BlogRepository constructor.
     * 
     * @param CommentLike $commentLike
     */
    public function __construct(Blog $blog)
    {
        $this->model = $blog;
    }

    /**
     * Get all blogs with comments
     * 
     * @param  string|null $commentParent parent id of comment
     * 
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getAll($commentParent = null)
    {
        return $blogs = $this->model
            ->with(['comments' => function ($q) use ($commentParent) {
                $q->with('replies.replies')
                    ->where('parent_id', $commentParent)
                    ->orderBy('id', 'desc');
            }])->get();
    }
}
