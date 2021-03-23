<?php

namespace App\Repositories;

use App\Comment;
use Illuminate\Support\Facades\DB;

/**
 * Class CommentRepository
 * @package App\Repositories
 */
class CommentRepository
{
    /**
     * @var Comment
     */
    protected $model;

    /**
     * CommentRepository constructor.
     * 
     * @param Comment $comment
     */
    public function __construct(Comment $comment)
    {
        $this->model = $comment;
    }

    /**
     * Create comment
     * 
     * @param array $requestData requestData
     *
     * @return mix
     */
    public function create($requestData)
    {
        try {
            return DB::transaction(function () use ($requestData) {
                if (!empty($requestData['parent_id'])) {
                    $parentComment = $this->model->find($requestData['parent_id']);

                    if ($parentComment) {
                        // from parent comment, down to the child comment
                        $requestData['depth']   = $parentComment->parents_count + 1;
                        $requestData['blog_id'] = $parentComment->blog_id;
                    }
                }

                $comment = $this->model->create($requestData);

                if (!empty($comment)) {
                    $comment = $this->findById($comment->id);
                }

                return $comment;
            });
        } catch (\Exception $e) {
            // log error
            \Log::error(__METHOD__ . '@' . $e->getLine() . ': ' . $e->getMessage());
            
            return [
                'msg' => $e->getMessage(),
                'err' => true
            ];
        }
    }

    /**
     * Find resource by id
     * 
     * @param  integer $commentId comment id
     * 
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findById($commentId)
    {
        return $this->model->with('replies')
                    ->findOrFail($commentId);
    }

    /**
     * Fetch commments by blog Id
     * 
     * @param  integer $blogId blog id
     * 
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function fetchByBlogId($blogId)
    {
        return $this->model
                ->where('blog_id', $blogId)
                ->with('replies.replies')
                ->where('parent_id', null)
                ->orderBy('id', 'desc')
                ->get();
    }
}
