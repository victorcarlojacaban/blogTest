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
                return $this->model->create($requestData);
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
}
