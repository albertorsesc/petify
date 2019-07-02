<?php

namespace Tests\Unit\Models;

use App\Models\Breed;
use App\Models\Species;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BreedTest extends TestCase
{
    use RefreshDatabase;
    
    /**
    *   @test
    *   @throws \Throwable
    */
    public function breed_belongs_to_a_specie()
    {
        $this->assertInstanceOf(Species::class, $this->create(Breed::class)->specie);
    }
}
