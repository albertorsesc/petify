<?php

namespace Tests\Unit\Http\Requests;

use Tests\TestCase;
use App\Models\Species;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SpeciesRequestTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     *   @test
     *   @throws \Throwable
     */
    public function name_is_required()
    {
        $this->postJson(
            route('species.store'),
            $this->make(Species::class, ['name' => null])->toArray()
        )->assertJsonValidationErrors('name');
        
        $this->putJson(
            route('species.update', $this->create(Species::class)),
            $this->make(Species::class, ['name' => null])->toArray()
        )->assertJsonValidationErrors('name');
    }
    
    /**
     *   @test
     *   @throws \Throwable
     */
    public function display_name_is_required()
    {
        $this->postJson(
            route('species.store'),
            $this->make(Species::class, ['display_name' => null])->toArray()
        )->assertJsonValidationErrors('display_name');
    
        $this->putJson(
            route('species.update', $this->create(Species::class)),
            $this->make(Species::class, ['display_name' => null])->toArray()
        )->assertJsonValidationErrors('display_name');
    }
}
