<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

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
        	'commentor' => request('commentor')
        ]);
    }
}
