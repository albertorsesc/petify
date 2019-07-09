<?php

namespace Tests\Feature\Web;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SpeciesTest extends TestCase
{
    use RefreshDatabase;
    
    /**
    *   @test
    *   @throws \Throwable
    */
    public function guest_can_not_visit_species_index() 
    {
        $this->get(route('web.species.index'))
             ->assertRedirect('login')
             ->assertStatus(302);
    }
    
    /**
    *   @test
    *   @throws \Throwable
    */
    public function authenticated_user_can_visit_species_index()
    {
        $this->signIn();
        
        $response = $this->get(route('web.species.index'));
        $response->assertOk();
        $response->assertViewIs('species.index');
    }
}
