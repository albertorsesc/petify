<?php

namespace Tests\Unit\Http\Requests;

use Illuminate\Support\Arr;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRequestTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     *   @test
     *   @throws \Throwable
     */
    public function first_name_is_required()
    {
        $this->postJson(
            route('users.store'),
            $this->make(User::class, ['first_name' => null])->toArray()
        )->assertJsonValidationErrors('first_name');
    
        $this->putJson(
            route('users.update', $this->create(User::class)),
            $this->make(User::class, ['first_name' => null])->toArray()
        )->assertJsonValidationErrors('first_name');
    }
    
    /**
     *   @test
     *   @throws \Throwable
     */
    public function first_name_must_not_exceed_50_characters()
    {
        $this->postJson(
            route('users.store'),
            $this->make(User::class, ['first_name' => Str::random(51)])->toArray()
        )->assertJsonValidationErrors('first_name');
        
        $this->putJson(
            route('users.update', $this->create(User::class)),
            $this->make(User::class, ['first_name' => Str::random(51)])->toArray()
        )->assertJsonValidationErrors('first_name');
    }
    
    /**
     *   @test
     *   @throws \Throwable
     */
    public function last_name_is_required()
    {
        $this->postJson(
            route('users.store'),
            $this->make(User::class, ['last_name' => null])->toArray()
        )->assertJsonValidationErrors('last_name');
    
        $this->putJson(
            route('users.update', $this->create(User::class)),
            $this->make(User::class, ['last_name' => null])->toArray()
        )->assertJsonValidationErrors('last_name');
    }
    
    /**
     *   @test
     *   @throws \Throwable
     */
    public function last_name_must_not_exceed_50_characters()
    {
        $this->postJson(
            route('users.store'),
            $this->make(User::class, ['last_name' => Str::random(51)])->toArray()
        )->assertJsonValidationErrors('last_name');
        
        $this->putJson(
            route('users.update', $this->create(User::class)),
            $this->make(User::class, ['last_name' => Str::random(51)])->toArray()
        )->assertJsonValidationErrors('last_name');
    }
    
    /**
     *   @test
     *   @throws \Throwable
     */
    public function user_type_id_is_required()
    {
        $this->postJson(
            route('users.store'),
            $this->make(User::class, ['user_type_id' => null])->toArray()
        )->assertJsonValidationErrors('user_type_id');
    
        $this->putJson(
            route('users.update', $this->create(User::class)),
            $this->make(User::class, ['user_type_id' => null])->toArray()
        )->assertJsonValidationErrors('user_type_id');
        
    }
    
    /**
     *   @test
     *   @throws \Throwable
     */
    public function user_type_id_must_exists_in_user_types_table()
    {
        $this->postJson(
            route('users.store'),
            $this->make(User::class, ['user_type_id' => 10001])->toArray()
        )->assertJsonValidationErrors('user_type_id');
    
        $this->putJson(
            route('users.update', $this->create(User::class)),
            $this->make(User::class, ['user_type_id' => 10001])->toArray()
        )->assertJsonValidationErrors('user_type_id');
    
    }
    
    /**
     *   @test
     *   @throws \Throwable
     */
    public function email_is_required()
    {
        $this->postJson(
            route('users.store'),
            $this->make(User::class, ['email' => null])->toArray()
        )->assertJsonValidationErrors('email');
    
        $this->putJson(
            route('users.update', $this->create(User::class)),
            $this->make(User::class, ['email' => null])->toArray()
        )->assertJsonValidationErrors('email');
    }
    
    /**
     *   @test
     *   @throws \Throwable
     */
    public function email_must_be_unique()
    {
        $this->create(User::class, ['email' => 'arosas@petify.com']);
        $this->postJson(
            route('users.store'),
            $this->make(User::class, ['email' => 'arosas@petify.com'])->toArray()
        )->assertJsonValidationErrors('email');
        
        $this->putJson(
            route('users.update', $this->create(User::class)),
            $this->make(User::class, ['email' => 'arosas@petify.com'])->toArray()
        )->assertJsonValidationErrors('email');
    }
    
    /**
     *   @test
     *   @throws \Throwable
     */
    public function email_must_not_exceed_100_characters()
    {
        $this->postJson(
            route('users.store'),
            $this->make(User::class, ['email' => Str::random(91) . '@email.com'])->toArray()
        )->assertJsonValidationErrors('email');
        
        $this->putJson(
            route('users.update', $this->create(User::class)),
            $this->make(User::class, ['email' => Str::random(91) . '@email.com'])->toArray()
        )->assertJsonValidationErrors('email');
    }
    
    /**
     *   @test
     *   @throws \Throwable
     */
    public function email_must_have_a_valid_email_format()
    {
        $this->postJson(
            route('users.store'),
            $this->make(User::class, ['email' => 'arosas@'])->toArray()
        )->assertJsonValidationErrors('email');
        
        $this->putJson(
            route('users.update', $this->create(User::class)),
            $this->make(User::class, ['email' => 'arosas@'])->toArray()
        )->assertJsonValidationErrors('email');
    }
    
    /**
     *   @test
     *   @throws \Throwable
     */
    public function phone_must_not_exceed_60_characters()
    {
        $this->postJson(
            route('users.store'),
            $this->make(User::class, ['phone' => Str::random(61)])->toArray()
        )->assertJsonValidationErrors('phone');
        
        $this->putJson(
            route('users.update', $this->create(User::class)),
            $this->make(User::class, ['phone' => Str::random(61)])->toArray()
        )->assertJsonValidationErrors('phone');
    }
    
    /**
     *   @test
     *   @throws \Throwable
     */
    public function password_is_required()
    {
        $this->postJson(
            route('users.store'),
            $this->make(User::class, ['password' => null])->toArray()
        )->assertJsonValidationErrors('password');
    }
    
    /**
     *   @test
     *   @throws \Throwable
     */
    public function password_must_be_at_least_6_characters_long()
    {
        $this->postJson(
            route('users.store'),
            $this->make(User::class, [
                'password' => 'abcde',
                'password' => 'abcde',
            ])->toArray()
        )->assertJsonValidationErrors('password');
        
        $this->putJson(
            route('users.update', $this->create(User::class)),
            [
                'password' => 'abcde',
                'password_confirmation' => 'abcde',
            ]
        )->assertJsonValidationErrors('password');
    }
    
    /**
     *   @test
     *   @throws \Throwable
     */
    public function password_must_be_confirmed()
    {
        $this->postJson(
            route('users.store'),
            [
                'password' => 'secret',
                'password_confirmation' => null,
            ]
        )->assertJsonValidationErrors('password');
        
        $this->putJson(
            route('users.update', $this->create(User::class)),
            [
                'password' => 'secret',
                'password_confirmation' => null,
            ]
        )->assertJsonValidationErrors('password');
    }
}
