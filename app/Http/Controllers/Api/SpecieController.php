<?php

namespace App\Http\Controllers\Api;

use App\Models\Species;
use App\Http\Controllers\Controller;
use App\Http\Requests\SpeciesRequest;
use App\Http\Resources\SpeciesResource;

class SpecieController extends Controller
{
    public function index()
    {
        return SpeciesResource::collection(Species::orderBy('name')->orderBy('status', 'desc')->get());
    }

    public function store(SpeciesRequest $request)
    {
        return new SpeciesResource(Species::create($request->all()));
    }

    public function show(Species $species)
    {
        return new SpeciesResource($species);
    }

    public function update(SpeciesRequest $request, Species $species)
    {
        $species->update($request->all());

        return new SpeciesResource($species);
    }

    public function destroy(Species $species)
    {
        $species->delete();

        return response([], 204);
    }
}
