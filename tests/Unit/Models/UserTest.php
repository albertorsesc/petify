<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     *   @test
     *   @throws \Throwable
     */
    public function user_belongs_to_a_user_type()
    {
        $this->assertInstanceOf(UserType::class, $this->create(User::class)->userType);
    }
}
