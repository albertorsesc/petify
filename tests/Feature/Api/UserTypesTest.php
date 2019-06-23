<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\UserType;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTypesTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     *   @test
     *   @throws \Throwable
     *  @endpoint ['GET', '/api/user-types']
     */
    public function get_all_user_types()
    {
        $userType = $this->create(UserType::class);
        $response = $this->getJson(route('user-types.index'));
        $response->assertOk();
        $response->assertJson([
            'data' => [
                [
                    'id' => $userType->id,
                    'name' => $userType->name,
                    'displayName' => $userType->display_name,
                ]
            ]
        ]);
    }
}
