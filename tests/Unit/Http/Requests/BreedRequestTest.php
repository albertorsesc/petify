<?php

namespace Tests\Unit\Http\Requests;

use Tests\TestCase;
use App\Models\Breed;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BreedRequestTest extends TestCase
{
    use RefreshDatabase;
    
    /**
    *   @test
    *   @throws \Throwable
    */
    public function species_id_is_required()
    {
        $this->postJson(
            route('breeds.store'),
            ['specie_id' => null, 'name' => 'perro']
        )->assertJsonValidationErrors('specie_id');
    }
    
    /**
     *   @test
     *   @throws \Throwable
     */
    public function specie_id_must_exits_in_species_table()
    {
        $this->postJson(
            route('breeds.store'),
            $this->make(Breed::class, ['specie_id' => 1001])->toArray()
        )->assertJsonValidationErrors('specie_id');
        
//        $this->putJson(
//            route('species.update', $this->create(Breed::class)),
//            $this->make(Breed::class, ['specie_id' => 1001])->toArray()
//        )->assertJsonValidationErrors('specie_id');
    }
}
