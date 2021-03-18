<?php

namespace App\Http\Controllers\Api;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
	/**
	 * Store resource
	 * 
	 * @return \Illuminate\Http\Response
	 */
    public function store(Request $request)
    {
        $this->validate($request, [
            'content'   => 'required|string|max:500',
            'commentor' => 'required|string|max:50'
        ]);

        return Comment::create([
        	'blog_id'   => request('blog_id'),
        	'content'   => request('content'),
        	'commentor' => request('commentor'),
        	'parent_id' => request('parent_id')
        ]);
    }
}
