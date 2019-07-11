<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Species;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SpeciesTest extends TestCase
{
    use RefreshDatabase;

    /**
     *   @test
     *   @throws \Throwable
     *  @endpoint ['GET', '/api/species']
     */
    public function get_all_species()
    {
        $species = $this->create(Species::class);
        $response = $this->getJson(route('species.index'));
        $response->assertOk();
        $response->assertJson([
            'data' => [
                [
                    'id' => $species->id,
                    'name' => $species->name,
                    'status' => $species->status,
                ],
            ],
        ]);
    }

    /**
     *   @test
     *   @throws \Throwable
     *  @endpoint ['POST', '/api/species']
     */
    public function store_a_specie()
    {
        $speciesData = $this->make(Species::class);

        $response = $this->postJson(route('species.store'), $speciesData->toArray());
        $response->assertStatus(201);
        $response->assertJson(['data' => ['name' => $speciesData->name]]);

        $this->assertDatabaseHas('species', $speciesData->toArray());
    }

    /**
     *   @test
     *   @throws \Throwable
     *  @endpoint ['GET', '/api/species/{species}']
     */
    public function get_a_species()
    {
        $species = $this->create(Species::class);

        $response = $this->getJson(route('species.show', $species));
        $response->assertOk();
        $response->assertJson([
            'data' => [
                'id' => $species->id,
                'name' => $species->name,
            ],
        ]);
    }

    /**
     *   @test
     *   @throws \Throwable
     *  @endpoint ['PUT', '/api/species/{species}']
     */
    public function update_a_species()
    {
        $species = $this->create(Species::class);
        $speciesData = $this->make(Species::class);

        $response = $this->putJson(route('species.update', $species), $speciesData->toArray());
        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'id' => $species->id,
                'name' => $speciesData->name,
            ],
        ]);

        $this->assertDatabaseHas('species', $speciesData->toArray());
    }

    /**
     *   @test
     *   @throws \Throwable
     *  @endpoint ['DELETE', '/api/species/{species}']
     */
    public function delete_a_species()
    {
        $species = $this->create(Species::class);

        $this->deleteJson(route('species.destroy', $species))->assertStatus(204);

        $this->assertSoftDeleted('species', $species->toArray());
    }
}
