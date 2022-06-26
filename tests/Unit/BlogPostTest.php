<?php

namespace Tests\Unit;

use App\Models\BlogPost;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BlogPostTest extends TestCase
{
    use RefreshDatabase;

    public function test_relation_with_user()
    {
        $post = BlogPost::factory()->create(); 

        $this->assertEquals($post->user_id, $post->user->id);
    }

    public function test_create_post()
    {
        $user = User::factory()->create();
        $post = BlogPost::create((['title' => 'title 1', 'body' => 'body 1', 'user_id' => $user->id])); 

        $this->assertEquals($post->user_id, $user->id);
        $this->assertEquals($post->title, 'title 1');
        $this->assertEquals($post->body, 'body 1');
    }


    public function test_user_posts()
    {
        $user = User::factory()->create();
        $user1 = User::factory()->create();
        $post1 = BlogPost::create((['title' => 'title 1', 'body' => 'body 1', 'user_id' => $user->id]));
        $post2 = BlogPost::create((['title' => 'title 2', 'body' => 'body 2', 'user_id' => $user1->id]));
        $post3 = BlogPost::create((['title' => 'title 3', 'body' => 'body 3', 'user_id' => $user->id]));
        $post4 = BlogPost::create((['title' => 'title 4', 'body' => 'body 4', 'user_id' => $user->id]));

        $post = new BlogPost();
        $this->be($user);

        $this->assertCount(3, $post->getUserPosts());
    }
}