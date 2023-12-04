<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_login_with_valid_credentials()
    {
        // Create a user (you may adjust this based on your user creation logic)
        $user = factory(\App\Models\User::class)->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // Attempt to log in
        $response = $this->post(route('login.authenticate'), [
            'username' => 'test@example.com', // Adjust to your login field name
            'password' => 'password',
        ]);

        // Assert that the login was successful and user redirected to the expected page
        $response->assertRedirect(route('dashboard')); // Adjust to your expected redirect route

        // Assert that the user is authenticated
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function user_cannot_login_with_invalid_credentials()
    {
        // Attempt to log in with invalid credentials
        $response = $this->post(route('login.authenticate'), [
            'username' => 'invalid@example.com', // Invalid username
            'password' => 'invalidpassword', // Invalid password
        ]);

        // Assert that the login failed and user redirected back to the login page
        $response->assertRedirect(route('login'));

        // Assert that the user is not authenticated
        $this->assertGuest();
    }
}