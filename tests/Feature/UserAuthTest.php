<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_user()
    {
        $data = [
            'email' => 'test@gmail.com',
            'name' => 'Test Abel',
            'password' => 'secret1234',
            'password_confirmation' => 'secret1234'
        ];
        User::where('email', 'test@gmail.com')->delete();
        $response = $this->json('POST', route('api.user.register'), $data);
        $response->assertStatus(200);
        $response->assertJsonPath('data.name', 'Test Abel');
        $this->assertArrayHasKey('data', $response->json());
        User::where('email', 'test@gmail.com')->delete();
    }

    public function test_login_user()
    {
        $userData = [
            'email' => 'test@gmail.com',
            'name' => 'Test Abel',
            'password' => bcrypt('secret1234')
        ];
        User::create($userData);
        $response = $this->json('POST', route('api.user.login'), [
            'email' => 'test@gmail.com',
            'password' => 'secret1234'

        ]);
        $response->assertStatus(200);
        $this->assertArrayHasKey('message',$response);
        $this->assertArrayHasKey('user', $response['data']);
        $this->assertArrayHasKey('token', $response['data']);
    }

    public function test_logged_user()
    {
        // create a user
        $userData = [
            'email' => 'test@gmail.com',
            'name' => 'Test Abel',
            'password' => bcrypt('secret1234')
        ];
        $user = User::create($userData);
        $this->actingAs($user);
        $response = $this->get('/api/me');
        $response->assertSuccessful();
        $this->assertArrayHasKey('user', $response);
    }
}
