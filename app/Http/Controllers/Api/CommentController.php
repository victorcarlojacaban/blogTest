<?php

namespace App\Http\Controllers\Api;

use App\Comment;
use App\Http\Requests\Comment\StoreRequest;
use App\Http\Controllers\Controller;
use App\Repositories\CommentRepository;

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
