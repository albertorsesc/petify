<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    /**
     *   @test
     *   @throws \Throwable
     *  @endpoint ['GET', '/api/users']
     */
    public function get_all_user()
    {
        $user = $this->create(User::class);

        $response = $this->getJson(route('users.index'));
        $response->assertOk();
        $response->assertJson([
            'data' => [
                [
                    'id' => $user->id,
                    'fullName' => $user->fullName(),
                    'firstName' => $user->first_name,
                    'lastName' => $user->last_name,
                    'userType' => [
                        'id' => $user->userType->id,
                    ],
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'status' => $user->status,
                ],
            ],
        ]);
    }

    /**
     *   @test
     *   @throws \Throwable
     *  @endpoint ['POST', '/api/users']
     */
    public function store_a_user()
    {
        $userData = $this->make(User::class);
        $request = [
            'first_name' => $userData->first_name,
            'last_name' => $userData->last_name,
            'user_type_id' => $userData->user_type_id,
            'email' => $userData->email,
            'phone' => $userData->phone,
            'password' => 'secret',
            'password_confirmation' => 'secret',
            'api_token' => $userData->generateApiToken(),
        ];

        $response = $this->postJson(route('users.store'), $request);
        $response->assertStatus(201);
        $response->assertJson(['data' => ['fullName' => $userData->fullName()]]);

        $this->assertDatabaseHas('users', Arr::except($request, ['password', 'password_confirmation']));
    }

    /**
     *   @test
     *   @throws \Throwable
     *  @endpoint ['GET', '/api/users/{user}']
     */
    public function get_a_user()
    {
        $user = $this->create(User::class);
        $response = $this->getJson(route('users.show', $user));
        $response->assertOk();
        $response->assertJson([
            'data' => [
                'id' => $user->id,
                'fullName' => $user->fullName(),
            ],
        ]);
    }

    /**
     *   @test
     *   @throws \Throwable
     *  @endpoint ['PUT', '/api/users/{user}']
     */
    public function update_a_user()
    {
        $user = $this->create(User::class);
        $userData = $this->make(User::class);
        $request = [
            'first_name' => $userData->first_name,
            'last_name' => $userData->last_name,
            'user_type_id' => $userData->user_type_id,
            'email' => $userData->email,
            'phone' => $userData->phone,
        ];

        $response = $this->putJson(route('users.update', $user), $request);
        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'id' => $user->id,
                'fullName' => $userData->fullName(),
            ],
        ]);

        $this->assertDatabaseHas('users', $request);
    }

    /**
     *   @test
     *   @throws \Throwable
     *  @endpoint ['DELETE', '/api/users/{user}']
     */
    public function soft_delete_a_user()
    {
        $user = $this->create(User::class);

        $this->deleteJson(route('users.destroy', $user))->assertStatus(204);

        $this->assertSoftDeleted('users', $user->toArray());
    }

    /**
     *   @test
     *   @throws \Throwable
     *  @endpoint ['PUT', '/api/users/{user}/toggle-status']
     */
    public function can_toggle_user_status()
    {
        $user = $this->create(User::class);
        $this->assertEquals(true, $user->status);

        $this->putJson(route('users.toggle-status', $user));
        $this->assertEquals(false, $user->fresh()->status);

        $this->putJson(route('users.toggle-status', $user));
        $this->assertEquals(true, $user->status);
    }
}
