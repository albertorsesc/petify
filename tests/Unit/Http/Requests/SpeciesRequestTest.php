<?php

namespace Tests\Unit\Http\Requests;

use Tests\TestCase;
use App\Models\Species;
use Illuminate\Support\Str;
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
        $this->postJson(route('species.store'), ['name' => null])->assertJsonValidationErrors('name');

        $this->putJson(
            route('species.update', $this->create(Species::class)),
            ['name' => null]
        )->assertJsonValidationErrors('name');
    }

    /**
     *   @test
     *   @throws \Throwable
     */
    public function name_must_not_exceed_100_characters()
    {
        $this->postJson(
            route('species.store'),
            $this->make(Species::class, ['name' => Str::random(101)])->toArray()
        )->assertJsonValidationErrors('name');

        $this->putJson(
            route('species.update', $this->create(Species::class)),
            $this->make(Species::class, ['name' => Str::random(101)])->toArray()
        )->assertJsonValidationErrors('name');
    }
}
