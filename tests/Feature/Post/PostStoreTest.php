<?php

namespace Tests\Feature\Post;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class PostStoreTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function check_it_work()
    {
        $this->connectUser($this->createUser());

        $this->assertModelIsEmpty(Post::class);

        $this->post(route('web.post.store'), [
            'title' => 'Mon super article !',
            'content' => factory(Post::class)->make()->content
        ]);

        $this->assertModelIsNotEmpty(Post::class);
        $this->assertModelCount(1, Post::class);
    }

    /** @test */
    public function check_it_not_work_with_bad_inputs()
    {
        $this->connectUser($this->createUser());

        $this->assertModelIsEmpty(Post::class);

        $this->post(route('web.post.store'), [
            'title' => '',
            'content' => '',
        ])
            ->assertSessionHasErrors([
                'title', 'content'
            ]);

        $this->assertModelIsEmpty(Post::class);
    }

    /** @test */
    public function check_is_unautorized_if_not_login()
    {
        $this->assertModelIsEmpty(Post::class);

        $this->post(route('web.post.store'), [
            'title' => factory(Post::class)->make()->title,
            'content' => factory(Post::class)->make()->content
        ])
            ->assertStatus(403);

        $this->assertModelIsEmpty(Post::class);
    }

    /** @test */
    public function check_it_redirect_to_good_route()
    {
        $this->withoutExceptionHandling();
        $this->connectUser($this->createUser());

        $this->assertModelIsEmpty(Post::class);

        $this->post(route('web.post.store'), [
            'title' => $title = factory(Post::class)->make()->title,
            'content' => factory(Post::class)->make()->content
        ])
            ->assertRedirect(route('web.post.show',  [
                'slug' => Str::slug($title),
                'post' => Post::all()->first()->id,
            ]));

        $this->assertModelIsNotEmpty(Post::class);
    }

}
