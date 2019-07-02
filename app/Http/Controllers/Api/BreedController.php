<?php

namespace App\Http\Controllers\Api;

use App\Models\Breed;
use App\Http\Requests\BreedRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\BreedResource;

class BreedController extends Controller
{
    public function index()
    {
        return BreedResource::collection(Breed::orderBy('name')->get());
    }
    
    public function store(BreedRequest $request)
    {
        return new BreedResource(Breed::create($request->all()));
    }
    
    public function show(Breed $breed)
    {
        return new BreedResource($breed);
    }
    
    
}
