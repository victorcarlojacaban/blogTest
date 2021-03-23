<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Comment\StoreRequest;
use App\Http\Controllers\Controller;
use App\Repositories\CommentRepository;
use App\Comment;

class CommentController extends Controller
{
    /**
     * @var CommentRepository
     */
    protected $commentRepo;

    /**
     * CommentController constructor
     * 
     * @param CommentRepository $commentRepo
     */
    public function __construct(CommentRepository $commentRepo)
    {
        $this->commentRepo = $commentRepo;
    }

    /**
     * Get comments by blog id
     * 
     * @param  integer $blogId blog id
     * 
     * @return \Illuminate\Http\Response
     */
    public function getCommentsByBlogId($blogId)
    {
        $comments = $this->commentRepo->fetchByBlogId($blogId);

        return response()->json($comments);
    }

	/**
	 * Store resource
	 * 
	 * @return \Illuminate\Http\Response
	 */
    public function store(StoreRequest $request)
    {
        $comment = $this->commentRepo->create($request->all());

        return response()->json($comment);
    }
}
