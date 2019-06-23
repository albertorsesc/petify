<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    
    public function signIn($attributes = [], $user = null)
    {
        $user = $user ?? $this->create(User::class, $attributes);
        return $this->actingAs($user);
    }
    
    /**
     * factory(Model::class, $amount)->create($attributes);
     *
     * @param $class
     * @param array $attributes
     * @param null $times
     * @return mixed
     */
    public function create($class, $attributes = [], $times = null) {
        return factory($class, $times)->create($attributes);
    }
    
    /**
     * factory()->make();
     *
     * @param $class
     * @param array $attributes
     * @param null $times
     * @return mixed
     */
    public function make($class, $attributes = [], $times = null) {
        return factory($class, $times)->make($attributes);
    }
    
    /**
     * @param array $overrides
     * @return array
     */
    public function userValidData($overrides = []): array
    {
        return array_merge([
            'first_name' => 'Alberto',
            'last_name' => 'Rosas',
            'email' => 'arosas@houseify.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ], $overrides);
    }
}
