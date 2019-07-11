<?php

namespace Tests\Feature\Web;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BreedsTest extends TestCase
{
    use RefreshDatabase;

    /**
     *   @test
     *   @throws \Throwable
     */
    public function guest_can_not_visit_breeds_index()
    {
        $this->get(route('web.breeds.index'))
             ->assertRedirect('login')
             ->assertStatus(302);
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function authenticated_user_can_visit_breeds_index()
    {
        $this->signIn();

        $response = $this->get(route('web.breeds.index'));
        $response->assertOk();
        $response->assertViewIs('breeds.index');
    }
}
