<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    public function test_new_users_can_register()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
 
        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_user_can_view_a_login_form()
    {
        $response = $this->get('/login');

        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    public function test_user_can_login_with_correct_credentials()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'i-love-laravel'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_cannot_login_with_incorrect_password()
    {
        $user = User::factory()->create([
            'password' => bcrypt('i-love-laravel'),
        ]);
        
        $response = $this->from('/login')->post('/login', [
            'email' => $user->email,
            'password' => 'invalid-password',
        ]);
        
        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    public function test_remember_me_functionality()
    {
        $user = User::factory()->create([
            'id' => random_int(1, 100),
            'password' => bcrypt($password = 'i-love-laravel'),
        ]);
        
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
            'remember' => 'on',
        ]);
        
        $response->assertRedirect('/home');
        // cookie assertion goes here
        $this->assertAuthenticatedAs($user);
    }

    public function test_unauthrorize_access_new_post()
    {
        $response = $this->get('/blog/create/post');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_unauthorised_user_post()
    {
        $user = User::factory()->create();
        $user1 = User::factory()->create();
        $post = BlogPost::create((['title' => 'title 1', 'body' => 'body 1', 'user_id' => $user->id]));

        $this->be($user1);

        $response = $this->get('/blog/'. $post->id .'/edit');
        $response->assertStatus(403);
    }

    public function test_authorised_user_post()
    {
        $user = User::factory()->create();
        $post = BlogPost::create((['title' => 'title 1', 'body' => 'body 1', 'user_id' => $user->id]));

        $this->be($user);

        $response = $this->get('/blog/'. $post->id .'/edit');
        $response->assertStatus(200);
        $response->assertSuccessful();
        $response->assertViewIs('blog.edit');
    }

    public function test_unauthrorize_access_create_post()
    {
        $response = $this->post('/blog/create/post');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }
}