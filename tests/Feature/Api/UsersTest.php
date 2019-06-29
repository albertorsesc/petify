<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Tests\TestCase;
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
                ]
            ]
        ]);
    }
}
