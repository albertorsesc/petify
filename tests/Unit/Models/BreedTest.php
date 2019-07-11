<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Breed;
use App\Models\Species;
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
