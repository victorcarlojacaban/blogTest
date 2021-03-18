<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\BlogRepository;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    /**
     * @var BlogRepository
     */
    protected $blogRepo;

    /**
     * BlogController constructor
     * 
     * @param BlogRepository $blogRepo
     */
    public function __construct(BlogRepository $blogRepo)
    {
        $this->blogRepo = $blogRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = $this->blogRepo->getAll();

        return response()->json($blogs);
    }
}
