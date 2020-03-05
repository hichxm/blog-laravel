<?php

namespace Tests\Feature\Post;

use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class PostUpdateTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function check_it_update()
    {
        $this->connectUser($user = $this->createUser());
        $post = $this->createPost($user);

        $this->patch(route('web.post.update', [
            'slug' => $post->slug,
            'post' => $post->id,
        ]), [
            'title' => $title = 'Salut à tous !',
            'content' => factory(Post::class)->make()->content,
        ])
            ->assertRedirect();

        $this->assertSame(Post::all()->first()->title, $title);
    }

    /** @test */
    public function check_it_redirect_to_good_post()
    {
        $this->connectUser($user = $this->createUser());
        $post = $this->createPost($user);

        $this->patch(route('web.post.update', [
            'slug' => $post->slug,
            'post' => $post->id,
        ]), [
            'title' => $title = 'Salut à tous !',
            'content' => factory(Post::class)->make()->content,
        ])
            ->assertRedirect(route('web.post.show', [
                'slug' => Str::slug($title),
                'post' => $post->id,
            ]));

        $this->assertSame(Post::all()->first()->title, $title);
    }

    /** @test */
    public function check_it_not_update_with_bad_inputs()
    {
        $this->connectUser($user = $this->createUser());
        $post = $this->createPost($user);

        $this->patch(route('web.post.update', [
            'slug' => $post->slug,
            'post' => $post->id,
        ]), [
            'title' => '',
            'content' => '',
        ])
            ->assertSessionHasErrors([
                'title', 'content'
            ]);
    }

    /** @test */
    public function check_it_unauthorized_to_edit()
    {
        $post = $this->createPost($this->createUser());

        $this->connectUser($this->createUser());

        $this->patch(route('web.post.update', [
            'slug' => $post->slug,
            'post' => $post->id,
        ]), [
            'title' => 'new title',
            'content' => factory(Post::class)->make()->content,
        ])
            ->assertStatus(403);
    }

}
