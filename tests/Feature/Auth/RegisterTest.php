<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @throws \Throwable
     */
    public function guest_can_register()
    {
        $this->create(UserType::class, ['name' => 'standard-user']);
        $userData = $this->userValidData();

        $this->get('register')->assertSuccessful();
        $this->post('/register', $userData)->assertRedirect('/home');

        $this->assertDatabaseHas('users', Arr::except($userData, ['password', 'password_confirmation']));
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function first_name_is_required()
    {
        $this->post(
            route('register'),
            $this->userValidData(['first_name' => null])
        )->assertSessionHasErrors('first_name');
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function first_name_must_not_exceed_50_characters()
    {
        $this->post(
            'register',
            $this->userValidData(['first_name' => Str::random(51)])
        )->assertSessionHasErrors('first_name');
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function last_name_is_required()
    {
        $this->post(
            route('register'),
            $this->userValidData(['last_name' => null])
        )->assertSessionHasErrors('last_name');
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function last_name_must_not_exceed_50_characters()
    {
        $this->post(
            'register',
            $this->userValidData(['last_name' => Str::random(51)])
        )->assertSessionHasErrors('last_name');
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function email_is_required()
    {
        $this->post(
            route('register'),
            $this->userValidData(['email' => null])
        )->assertSessionHasErrors('email');
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function email_must_not_exceed_100_characters()
    {
        $this->post(
            'register',
            $this->userValidData(['email' => Str::random(91).'@email.com'])
        )->assertSessionHasErrors('email');
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function email_must_be_unique()
    {
        $this->create(User::class, ['email' => 'arosas@houseify.io']);

        $this->post(
            route('register'),
            $this->userValidData([
                'email' => 'arosas@houseify.io',
            ])
        )->assertSessionHasErrors('email');
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function email_must_be_a_valid_email_address()
    {
        $this->post(
            route('register'),
            $this->userValidData([
                'email' => 'arosas@',
            ])
        )->assertSessionHasErrors('email');
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function password_is_required()
    {
        $this->post(
            route('register'),
            $this->userValidData([
                'password' => null,
            ])
        )->assertSessionHasErrors('password');
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function password_must_be_confirmed()
    {
        $this->post(
            route('register'),
            $this->userValidData([
                'password' => 'secret',
                'password_confirmation' => null,
            ]))->assertSessionHasErrors('password');
    }
}
