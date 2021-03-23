<?php

namespace Tests\Unit;

use Tests\TestCase;

class BlogControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testBlogsIndexPage()
    {
        $response = $this->call('GET', 'blogs');

        $response->assertStatus(200);
    }
}
