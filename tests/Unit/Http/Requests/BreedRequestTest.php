<?php

namespace Tests\Unit\Http\Requests;

use Illuminate\Support\Str;
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
    public function specie_id_is_required()
    {
        $this->postJson(
            route('breeds.store'),
            $this->make(Breed::class, ['specie_id' => null])->toArray()
        )->assertJsonValidationErrors('specie_id');
    
        $this->putJson(
            route('breeds.update', $this->create(Breed::class)),
            $this->make(Breed::class, ['specie_id' => null])->toArray()
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
    
        $this->putJson(
            route('breeds.update', $this->create(Breed::class)),
            $this->make(Breed::class, ['specie_id' => 1001])->toArray()
        )->assertJsonValidationErrors('specie_id');
    }
    
    /**
     *   @test
     *   @throws \Throwable
     */
    public function name_is_required()
    {
        $this->postJson(
            route('breeds.store'),
            $this->make(Breed::class, ['name' => null])->toArray()
        )->assertJsonValidationErrors('name');
    
//        $this->putJson(
//            route('breeds.update', $this->create(Breed::class)),
//            $this->make(Breed::class, ['name' => null])->toArray()
//        )->assertJsonValidationErrors('name');
    
    }
    
    /**
     *   @test
     *   @throws \Throwable
     */
    public function name_must_not_exceed_100_characters()
    {
        $this->postJson(
            route('breeds.store'),
            $this->make(Breed::class, ['name' => Str::random(101)])->toArray()
        )->assertJsonValidationErrors('name');
    
        $this->putJson(
            route('breeds.update', $this->create(Breed::class)),
            $this->make(Breed::class, ['name' => Str::random(101)])->toArray()
        )->assertJsonValidationErrors('name');
    
    }
}
