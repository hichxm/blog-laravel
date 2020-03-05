<?php

namespace Tests\Feature\Post;

use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostShowTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function check_it_good_post_passed_to_view()
    {
        $this->createPost($this->createUser(), [], 9);

        $post = $this->createPost($this->createUser());

        $this->assertModelCount(10, Post::class);
        $this->get(route('web.post.show', [
            'slug' => $post->slug,
            'post' => $post->id,
        ]))
            ->assertSuccessful()
            ->assertViewHas('post', $post);
    }

}
