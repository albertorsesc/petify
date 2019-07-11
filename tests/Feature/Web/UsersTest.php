<?php

namespace Tests\Feature\Web;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    /**
     *   @test
     *   @throws \Throwable
     */
    public function guest_can_not_visit_users_index()
    {
        $response = $this->get(route('web.users.index'));
        $response->assertStatus(302);
        $response->assertRedirect('login');
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function authenticated_user_can_visit_users_index()
    {
        $this->signIn();

        $response = $this->get(route('web.users.index'));
        $response->assertOk();
        $response->assertViewIs('users.index');
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function authenticated_user_can_visit_a_user_profile()
    {
        $this->signIn();

        $response = $this->get(route('web.users.show', $this->create(User::class)));
        $response->assertOk();
        $response->assertViewIs('users.show');
        $response->assertViewHas('user');
    }
}
