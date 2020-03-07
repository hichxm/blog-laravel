<?php

namespace Tests\Feature\Post;

use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class PostIndexTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function check_it_work_and_return_15_last_post()
    {

        $this->createPost($this->createUser(), [], 30);
        $this->createPost($this->createUser(), [
            'title' => 'Title test for test',
            'created_at' => now()->addSeconds(5),
            'updated_at' => now()->addSeconds(5),
        ]);

        DB::enableQueryLog();

        $posts = $this->get(route('web.post.index'))
            ->assertSuccessful()
            ->viewData('posts');

        /*
        * First query => Count post
        * Secon query => Get post
        * Third query => Get users
        */
        $this->assertCount(3, DB::getQueryLog());
        $this->assertSame($posts[0]->title, 'Title test for test');
    }

}
