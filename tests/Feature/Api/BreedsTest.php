<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Breed;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BreedsTest extends TestCase
{
    use RefreshDatabase;

    /**
     *   @test
     *   @throws \Throwable
     *  @endpoint ['GET', '/api/breeds']
     */
    public function get_all_breeds()
    {
        $breed = $this->create(Breed::class);

        $response = $this->getJson(route('breeds.index'));
        $response->assertOk();
        $response->assertJson([
            'data' => [
                [
                    'id' => $breed->id,
                    'specie' => [
                        'id' => $breed->specie->id,
                    ],
                    'name' => $breed->name,
                ],
            ],
        ]);
    }

    /**
     *   @test
     *   @throws \Throwable
     *  @endpoint ['POST', '/api/breeds']
     */
    public function store_a_breed()
    {
        $breedData = $this->make(Breed::class);

        $response = $this->postJson(route('breeds.store'), $breedData->toArray());
        $response->assertStatus(201);
        $response->assertJson(['data' => ['name' => $breedData->name]]);

        $this->assertDatabaseHas('breeds', $breedData->toArray());
    }

    /**
     *   @test
     *   @throws \Throwable
     *  @endpoint ['GET', '/api/breeds/{breed}']
     */
    public function get_a_breed()
    {
        $breed = $this->create(Breed::class);

        $response = $this->getJson(route('breeds.show', $breed));
        $response->assertOk();
        $response->assertJson([
            'data' => [
                'id' => $breed->id,
                'specie' => [
                    'id' => $breed->specie->id,
                ],
                'name' => $breed->name,
            ],
        ]);
    }

    /**
     *   @test
     *   @throws \Throwable
     *  @endpoint ['PUT', '/api/breeds/{breed}']
     */
    public function update_a_breed()
    {
        $breed = $this->create(Breed::class);
        $breedData = $this->make(Breed::class);

        $response = $this->putJson(route('breeds.update', $breed), $breedData->toArray());
        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'id' => $breed->id,
                'name' => $breedData->name,
            ],
        ]);

        $this->assertDatabaseHas('breeds', $breedData->toArray());
    }

    /**
     *   @test
     *   @throws \Throwable
     *  @endpoint ['DELETE', '/api/breeds/{breed}']
     */
    public function soft_delete_a_breed()
    {
        $breed = $this->create(Breed::class);

        $this->deleteJson(route('breeds.destroy', $breed))->assertStatus(204);

        $this->assertSoftDeleted('breeds', $breed->toArray());
    }
}
