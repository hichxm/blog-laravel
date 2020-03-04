<?php

namespace Tests\Feature\Post;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostDestroyTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function check_it_work()
    {
        $this->withoutExceptionHandling();

        $user = $this->createUser();

        $this->connectUser($user);
        $post = $this->createPost($user);

        $this->assertModelIsNotEmpty(Post::class);

        $this->delete(route('web.post.destroy', [
            'slug' => $post->slug,
            'post' => $post->id,
        ]));

        $this->assertModelIsEmpty(Post::class);
    }

    /** @test */
    public function check_it_not_work_with_invalid_user()
    {
        $post = $this->createPost($this->createUser());

        $this->assertModelCount(1, Post::class);

        $this->connectUser($this->createUser());
        $this->delete(route('web.post.destroy', [
            'slug' => $post->slug,
            'post' => $post->id,
        ]));

        $this->assertModelCount(1, Post::class);
    }

    /** @test */
    public function check_it_redirect()
    {
        $user = $this->createUser();

        $this->connectUser($user);
        $post = $this->createPost($user);

        $this->assertModelIsNotEmpty(Post::class);

        $this->delete(route('web.post.destroy', [
            'slug' => $post->slug,
            'post' => $post->id,
        ]))
            ->assertRedirect(route('web.post.index'));

        $this->assertModelIsEmpty(Post::class);
    }

}
