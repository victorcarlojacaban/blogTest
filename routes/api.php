<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CommentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/blogs', [BlogController::class, 'index'])->name('blog.index');
Route::get('/getCommentsByBlogId/{blogId}', [CommentController::class, 'getCommentsByBlogId'])->name('comment.get_comment_by_blog');
Route::post('create_comment', [CommentController::class, 'store'])->name('comment.store');	
Route::post('reply_comment', [CommentController::class, 'replyComment'])->name('comment.reply');	