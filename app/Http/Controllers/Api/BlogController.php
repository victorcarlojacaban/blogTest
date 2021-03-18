<?php

namespace App\Http\Controllers\Api;

use App\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::with(['comments' => function ($q) {
            $q->with('replies.replies')
                ->where('parent_id', null)
                ->orderBy('id', 'desc');
        }])->get();

        return response()->json($blogs);
    }
}
