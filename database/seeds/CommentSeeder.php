<?php

use App\Comment;
use App\Blog;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $blog = Blog::first();

        $firstComment = Comment::create([
        	'commentor'   => 'John',
        	'content'     => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
        	'blog_id'     => $blog->id,
            'depth'       => 1,
        ]);

        $secondComment = Comment::create([
        	'parent_id'   => $firstComment->id,
        	'commentor'   => 'Paul',
        	'content'     => 'Ipsum dolor sit amet, consectetur elit',
        	'blog_id'     => $firstComment->blog->id,
            'depth'       => 2,
        ]);

        $thirdComment = Comment::create([
        	'parent_id'   => $secondComment->id,
        	'commentor'   => 'Matthew',
        	'content'     => 'Consectetur elit',
        	'blog_id'     => $secondComment->blog->id,
            'depth'       => 3,
        ]);
    }
}
