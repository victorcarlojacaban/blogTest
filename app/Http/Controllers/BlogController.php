<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;

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
