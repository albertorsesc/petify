<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_cannot_login()
    {
        $this->get(route('login'));

        $response = $this->post(route('login'), $this->make(User::class)->toArray());
        $response->assertStatus(302);
        $response->assertRedirect('login');
    }

    /** @test */
    public function registered_user_can_login()
    {
        $this->signIn()
             ->get(route('home'))
             ->assertSuccessful();
    }

    /** @test */
    public function user_cannot_login_without_his_email()
    {
        $this->post(route('login'), [
            'email' => null,
            'password' => 'password',
        ])->assertSessionHasErrors('email');
    }

    /** @test */
    public function user_cannot_login_without_his_password()
    {
        $this->post(route('login'), [
            'email' => 'arosas@houseify.com',
            'password' => null,
        ])->assertSessionHasErrors('password');
    }
}
